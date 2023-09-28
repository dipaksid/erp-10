<?php

namespace App\Models;

use App\Models\Agent;
use App\Serialization;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use PDF;

class CustomerService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customercategory()
    {
        return $this->belongsTo('App\Models\CustomerCategory', 'customer_categories_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customers_id', 'id');
    }

    public static function getModule($request){
        if($request->segment(2)=="create"){
            $result='ADD CUSTOMER SERVICE';
        } elseif($request->segment(3)=="edit" || $request->input('_method')=="PUT"){
            $result='EDIT CUSTOMER SERVICE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')!="DELETE" ){
            $result='VIEW CUSTOMER SERVICE';
        } elseif(is_numeric($request->segment(2)) && $request->input('_method')=="DELETE" ){
            $result='DELETE CUSTOMER SERVICE';
        } elseif($request->segment(2)=="liveupdate"){
            $result='CUSTOMER SERVICE LIVE UPDATE';
        } else {
            $result='CUSTOMER SERVICE LIST';
        }
        return $result;
    }

    public static function searchAndPaginate($searchValue)
    {
        $isEditPermission = Auth::user()->hasPermissionTo("EDIT CUSTOMER SERVICE");
        $sfld = strlen($searchValue) > 3 ? 'customers.companyname' : 'customers.companycode';

        $query = self::customerservicetablelist()
            ->select('customers.id as id', 'customers.companycode as companycode', 'customers.companyname as companyname')
            ->selectRaw("
                GROUP_CONCAT(
                    CONCAT(
                        customer_categories.categorycode,
                        IF(customer_services.version != '', CONCAT('(', customer_services.version, ')'), ''),
                        IF(
                            customer_services.cfgpassword = '',
                            '',
                            IF(
                                customer_services.active = 'Y',
                                CONCAT(
                                    '-<a href=\"javascript:void(0);\" onclick=\"js_openfile(\'" . url('/') . "', customer_services.cfgfile, '\')\">',
                                    customer_services.cfgpassword,
                                    '</a>'
                                ),
                                CONCAT(
                                    '-<a href=\"javascript:void(0);\" style=\"color:red;\" onclick=\"js_openfile(\'" . url('/') . "', customer_services.cfgfile, '\')\">',
                                    customer_services.cfgpassword,
                                    '</a>'
                                )
                            )
                        )
                    )
                    ORDER BY customer_categories.id ASC
                ) as services")
            ->groupBy('customers.id')
            ->orderBy('customers.companycode');

        if (!$isEditPermission) {
            $query->whereRaw('customer_services.categoryid is not null');
        }

        if (!empty($searchValue)) {
            $query->where(function ($subQuery) use ($sfld, $searchValue) {
                $subQuery->where($sfld, 'like', '%' . $searchValue . '%');
            });
        }

        return $query->paginate(15)->appends(['searchvalue' => $searchValue]);
    }

    public static function customerservicetablelist()
    {
        return DB::table('customers')
            ->leftJoin('customer_services', 'customers.id', '=', 'customer_services.customers_id')
            ->leftJoin('customer_categories', 'customer_services.customer_categories_id', '=', 'customer_categories.id')
            ->leftJoin('agents', 'customer_services.agents_id', '=', 'agents.id');
    }

    /**
     * Store a newly created customer service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function storeService(Request $request)
    {
        $soft_license = ($request->input('soft_license') == '') ? 0 : $request->input('soft_license');
        $arr_return = [];

        if ($request->has('hidAction')) {
            $action = $request->input('hidAction');

            switch ($action) {
                case 'uploadcfg':
                    $arr_return = $this->processUploadCfg($request);
                    break;
                case 'savecfg':
                    $arr_return = $this->processSaveCfg($request, $soft_license);
                    break;
                case 'deletecfg':
                    $arr_return = $this->processDeleteCfg($request);
                    break;
                case 'dwpkpbqr':
                    $arr_return = $this->processDwpkpbqr($request);
                    break;
            }
        } else {
            $arr_return = $this->storeNewService($request);
        }

        return $arr_return;
    }

    private function processUploadCfg(Request $request)
    {
        $arr_return = [];
        if ($request->hasFile('cfg_file')) {
            $cfgFile = $request->file('cfg_file');
            if ($cfgFile->isValid()) {
                $file_path = public_path() . "/cfg/" . $request->input("id") . "/" . $request->input("catg") . "_TEMP.CFG";
                @unlink($file_path);
                $cfgFile->move(public_path() . "/cfg/" . $request->input("id"), $request->input("catg") . "_TEMP.CFG");

                $obj_serial = new Serialization();
                $arr_ret = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
                if (!$arr_ret) {
                    $arr_return["msg"] = "Invalid CFG File";
                } else if ($arr_ret["M_Comp"] != $request->input("compnam")) {
                    $arr_return["msg"] = "Invalid Customer Name! This CFG file is for Customer " . $arr_ret["M_Comp"];
                } else if ($arr_ret["M_Sys_Nam"] != $request->input("catg")) {
                    $arr_return["msg"] = "Invalid Customer Category! This CFG file is for Category " . $arr_ret["M_Sys_Nam"];
                } else {
                    $arr_return["exp_dat"] = $arr_ret["M_Exp_Dat"];
                    $arr_return["serial_no"] = $arr_ret["M_Chk_Ser"];
                    $arr_return["curpassword"] = trim($arr_ret["M_Act_Pass"]);
                }
            } else {
                $arr_return["msg"] = "Invalid file upload";
            }
        } else {
            $arr_return["msg"] = "No file has been uploaded";
        }

        return $arr_return;
    }

    private function processSaveCfg(Request $request, $soft_license)
    {
        // Logic for saving CFG data and related processing
        $service_id = $request->input("service_id");
        $category_id = $request->input("category_id");
        $companycode = $request->input("companycode");
        $companyname = $request->input("companyname");
        $system_id = $request->input("system_id");
        $serial_no = $request->input("serial_no");
        $exp_dat = $request->input("exp_dat");
        $agentid = $request->input("agentid");
        $curpassword = $request->input("curpassword");
        $newpassword = trim($request->input("newpassword"));

        $temfile_path=public_path()."/cfg/".$companycode."/".$system_id."_TEMP.CFG";
        $file_path=public_path()."/cfg/".$companycode."/".$system_id.".CFG";
        $bchangepassword=false;
        $a_return["msg"]="Update Serialization Successful";
        if(file_exists($temfile_path)){
            if(file_exists($file_path)){
                @unlink($file_path);
            }
            @rename($temfile_path, $file_path);
            if($curpassword!=$newpassword){
                $bchangepassword=true;
            }
            $a_return["cfgfile"] = "/cfg/".$companycode."/".$system_id.".CFG";
        } else {
            if(file_exists($file_path)){
                if($curpassword!=$newpassword){
                    $bchangepassword=true;
                }
                $obj_serial = new Serialization();
                //$arr_return = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
                //var_dump($arr_return);
                //echo "<br><br><br><br>";
            } else {
                $apiliveuser = ApiLiveOauthUser::where("username",$serial_no)->first();
                if($apiliveuser!==null){
                    $lastcode = ApiLiveOauthUser::where("client_id",$system_id."LIVEUPDATE")->max('username');
                    if($lastcode!=""){
                        $serial_no = $lastcode;
                    }
                }
                $obj_serial = new Serialization();
                $Ra1 = trim($obj_serial->Irand(10,99));
                $Rb1 = trim($obj_serial->Irand(10,99));
                $Rc1 = trim($obj_serial->Irand(10,99));
                $m_fac = "0000000000"; # not in use
                $m_pas = "          "; # System Administrator Password
                $mpas = "0"; # only 2 not for new serialization
                $arr_return = $obj_serial->New_EncP($companyname, $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $m_pas, $file_path, $Ra1, $Rb1, $Rc1,$soft_license);
                $newpassword = trim($arr_return["M_Pasw"]);
                $a_return["msg"]="Update Serialization Successful!! New CFG File Created";
                $category = CustomerCategory::find($category_id);
                $category->lastrunno=$serial_no;
                $category->save();
                //$arr_return = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
                //var_dump($arr_return);
                //echo "<br><br><br><br>";
            }
        }

        if($bchangepassword){
            $obj_serial = new Serialization();
            $Ra1 = trim($obj_serial->Irand(10,99));
            $Rb1 = trim($obj_serial->Irand(10,99));
            $Rc1 = trim($obj_serial->Irand(10,99));
            $m_fac = "0000000000"; # not in use
            $m_pas = "          "; # System Administrator Password
            $mpas = "2"; # only 2 not for new serialization
            $arr_return = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
            if($arr_return["M_Comp"]!=$companyname){
                @unlink($file_path);
                $mpas = "0"; # only 2 not for new serialization
                $arr_return = $obj_serial->New_EncP($companyname, $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $m_pas, $file_path, $Ra1, $Rb1, $Rc1,$soft_license);
                $arr_return = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
                $mpas = "2"; # only 2 not for new serialization
                $arr_return = $obj_serial->New_EncP($arr_return["M_Pri"].$arr_return["M_Sec"].$arr_return["M_Tet"].$arr_return["M_Frt"].$arr_return["M_Sth"], $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $newpassword, $file_path, $Ra1, $Rb1, $Rc1,$soft_license);
            } else {
                //var_dump($arr_return);
                //echo "<br><br><br><br>";
                $arr_return = $obj_serial->New_EncP($arr_return["M_Pri"].$arr_return["M_Sec"].$arr_return["M_Tet"].$arr_return["M_Frt"].$arr_return["M_Sth"], $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $newpassword, $file_path, $Ra1, $Rb1, $Rc1,$soft_license);
            }
            $a_return["msg"]="Update Serialization Successful!! CFG Password Changed";
            $a_return["cfgfile"] = "/cfg/".$companycode."/".$system_id.".CFG";
        }
        $service = CustomerService::find($service_id);
        $service->serial_no = $serial_no;
        $service->exp_dat = $exp_dat;
        $service->cfgpassword = $newpassword;
        $service->agentid = $agentid;
        $service->cfgfile = "/cfg/".$companycode."/".$system_id.".CFG";
        $service->save();
        $apiliveuser = ApiLiveOauthUser::where("first_name",$companycode)->where("client_id",$system_id."LIVEUPDATE")->first();
        if($apiliveuser===null){
            $apiliveuser = new ApiLiveOauthUser();
            $checkcustomer = CustomerService::where("categoryid",$category_id)->orderBy('serial_no', 'desc')->select('serial_no')->first();
            if($checkcustomer->serial_no<$serial_no) {
                $serial_no=$checkcustomer->serial_no+1;
                $updcat = CustomerCategory::find($category_id);
                $updcat->lastrunno=$serial_no;
                $updcat->save();
                $service->serial_no = $serial_no;
                $service->save();
            }
        } else {
            $apiliveuser = ApiLiveOauthUser::find($apiliveuser->id);
        }
        $scope=ApiOauthScope::selectRaw("group_concat(`description` SEPARATOR ' ') as 'scope'")->where("client_id",$system_id."LIVEUPDATE")->first();
        $apiliveuser->serviceid=$service_id;
        $apiliveuser->username=$serial_no;
        $apiliveuser->password=md5($newpassword);
        $apiliveuser->first_name=$companycode;
        $apiliveuser->last_name=$companyname;
        $apiliveuser->scope=$scope->scope;
        $apiliveuser->client_id=$system_id."LIVEUPDATE";
        $apiliveuser->save();
        $this->create_pkpbqr($companycode,$service_id);
        $a_return["newpassword"] = $newpassword;
        $a_return["category_id"] = $category_id;
        $a_return["lastrunno"] = $serial_no;
        $arr_post["mode"] = "add";
        $arr_post["categoryid"] = $category_id;
        $arr_post["active"] = $service->active;
        $arr_post["companycode"] = $companycode;
        $arr_post["type"] = "customer";
        $arr_post["id"] = $apiliveuser->id;
        $arr_post["serviceid"] = $service_id;
        $arr_post["username"] = $serial_no;
        $arr_post["password"] = md5($newpassword);
        $arr_post["first_name"] = $companycode;
        $arr_post["last_name"] = $companyname;
        $arr_post["scope"] = $scope->scope;
        $arr_post["client_id"] = $system_id."LIVEUPDATE";
        $arr_post["created_at"] = $apiliveuser->created_at;
        $arr_post["updated_at"] = $apiliveuser->updated_at;
        $this->submitCompUser($arr_post);

        return $a_return;
    }

    private function processDeleteCfg(Request $request)
    {
        // Logic for deleting CFG file and related data
        $service_id = $request->input("service_id");
        $service = CustomerService::find($service_id);
        $customer = Customer::find($service->customerid);
        $category = CustomerCategory::find($service->categoryid);
        $apiliveuser=ApiLiveOauthUser::selectRaw("id")->where("serviceid",$service_id)->first();
        $file_path=public_path()."/cfg/".$customer->companycode."/".$category->categorycode.".CFG";
        @unlink($file_path);
        $service->serial_no = " ";
        $service->exp_dat = " ";
        $service->cfgpassword = " ";
        $service->agentid = null;
        $service->cfgfile = " ";
        $service->save();
        if($apiliveuser!==null) {
            $arr_post["mode"] = "delete";
            $arr_post["type"] = "customer";
            $arr_post["id"] = $apiliveuser->id;
            $this->submitCompUser($arr_post);
            $apiliveuser->delete();
        }
        $a_return["msg"] = "Removed Serialization File Successful!";

        return $a_return;
    }

    private function processDwpkpbqr(Request $request)
    {
        // Logic for generating PK/PB/QR data
        $service_id = $request->input("service_id");
        $service = CustomerService::find($service_id);
        $customer = Customer::find($service->customerid);
        $a_return = $this->create_pkpbqr($customer->companycode,$service->id);

        return $a_return;
    }

    private function storeNewService(Request $request)
    {
        $service = new CustomerService();
        $service->customerid = $request->input('customerid');
        $service->categoryid = $request->input('categoryid');
        if($request->has('amount')){
            $service->amount = ($request->input('amount')=="" || $request->input('amount')==null)?0.00:$request->input('amount');
        }
        $service->contract_typ = ($request->input('contract_typ')=="")?" ":$request->input('contract_typ');
        $service->inc_hw = ($request->input('inc_hw')=="")?"N":$request->input('inc_hw');
        $service->pay_before = ($request->input('pay_before')=="")?"N":$request->input('pay_before');
        $service->start_date = ($request->input('start_date')=="")?" ":$request->input('start_date');
        $service->end_date = ($request->input('end_date')=="")?" ":$request->input('end_date');
        $service->service_date = ($request->input('service_date')=="")?" ":$request->input('service_date');
        $service->soft_license = ($request->input('soft_license')=="")?0:$request->input('soft_license');
        $service->pos_license = ($request->input('pos_license')=="")?0:$request->input('pos_license');
        $service->vpnaddress = $request->input('vpnaddress');
        $service->active = $request->input('active');
        $service->rmk = $request->input('rmk');
        $service->save();

        return array("msg"=>"Customer Services Saved!","id"=>$service->id);
    }

    private function create_pkpbqr($companycode,$service_id){
        // Create a basic QR code
        $qrCode = new QrCode("https://www.brightwin.com/pkpb/index.php?cmcd=".$companycode."&svsid=".$service_id);
        $qrCode->setSize(400);
        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setValidateResult(false);

        $qrCode->setMargin(10);

        // Save it to a file
        if(!file_exists(public_path()."/pkpb/".$service_id)){
            @mkdir(public_path()."/pkpb/".$service_id);
        }
        $qrCode->writeFile(public_path()."/pkpb/".$service_id."/qrcode.png");
        $dataUri = $qrCode->writeDataUri();

        view()->share('qrcode',$dataUri);

        PDF::setOptions(['dpi' => 250, 'defaultFont' => 'sans-serif']);
        // pass view file
        $pdf = PDF::loadView('customerservice.pkpbqrpdf');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->save(public_path()."/pkpb/".$service_id."/notice.pdf");

        $a_return["qrcode"] = "/pkpb/".$service_id."/qrcode.png";
        return $a_return;
    }

    private function submitCompUser($arr_post){
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        $data["username"] = "bwerp";
        $data["password"] = "TgG234hgbJH54HB344gbHfWgv";
        $data["client_id"] = "BWERP";
        $data["client_secret"] = "EojnU33J2J90MOJ9o340";
        $data["grant_type"] = "password";
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => "https://liveupdate.brightwin.com/liveapi/TOKEN",
            CURLOPT_POSTFIELDS =>http_build_query($data),
            CURLOPT_CONNECTTIMEOUT => 3600,
            CURLOPT_TIMEOUT => 3600,
            CURLOPT_SSL_VERIFYHOST=>0
        ));
        $resp="";
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        unset($data);
        if (FALSE === $resp) {
        } else {
            $rdata = json_decode($resp, true);
            $curl = curl_init();
            $arr_post["access_token"]=$rdata["access_token"];
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => 1,
                CURLOPT_HEADER => 0,
                CURLOPT_URL => "https://liveupdate.brightwin.com/liveapi/UPDATECOMP",
                CURLOPT_POSTFIELDS =>http_build_query($arr_post),
                CURLOPT_CONNECTTIMEOUT => 3600,
                CURLOPT_TIMEOUT => 3600,
                CURLOPT_SSL_VERIFYHOST=>0
            ));
            $resp="";
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);
            unset($arr_post);
        }
    }

    public static function customerservicereportlist(){
        return DB::table('customer_services')
            ->leftjoin('customers',  'customer_services.customers_id', '=','customers.id')
            ->leftjoin('customer_categories', 'customer_services.customer_categories_id', '=', 'customer_categories.id')
            ->leftjoin('areas', 'customers.areas_id', '=', 'areas.id');
    }
}
