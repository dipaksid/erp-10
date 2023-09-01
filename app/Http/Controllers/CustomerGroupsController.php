<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerGroupRequest;
use App\Http\Requests\UpdateCustomerGroupRequest;
use App\Models\CustomerGroup;
use App\Models\CustomerCategory;
use App\Models\CompanySetting;
use App\Models\CustomerService;
use App\Models\Customer;
use App\Models\customerGroupsCustomer;
use App\Serialization;
use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;


class CustomerGroupsController extends Controller
{

    const ITEM_PER_PAGES = 15;

    /**
     * Constructor for the class.
     *
     * @param App\Services\DataService $dataService An instance of the DataService class used for data operations.
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->all();
        $customerGroups = CustomerGroup::searchCustomerGroupsWithFilters($filters);
        if(isset($filters['searchvalue'])){
            $customerGroups->withPath('?searchvalue='.($filters['searchvalue']) ? $filters['searchvalue'] : '');
        }

        return view('customer_groups.index', compact('customerGroups','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categorylist' => CustomerCategory::get(),
            'companylist' => CompanySetting::get()
        ];

        $customers = $this->dataService->fetchCustomers(request());

        return view('customer_groups.create', compact('data', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerGroupRequest $request)
    {
        $hidAction = $request->input("hidAction");

        if ($hidAction === "uploadcfg") {
            return $this->handleUploadCfgAction($request);
        } elseif ($hidAction === "savecfg") {
            return $this->handleSaveCfgAction($request);
        } elseif ($hidAction === "deletecfg") {
            return $this->handleDeleteCfgAction($request);
        }

        return $this->createNewCustomerGroup($request);
    }

    private function handleUploadCfgAction($request)
    {
        if ($_FILES["cfg_file"] && is_uploaded_file($_FILES["cfg_file"]['tmp_name'])) {
            if(!file_exists(public_path()."/cfg/consolidate/".$request->input("id"))){
                @mkdir(public_path()."/cfg/consolidate/".$request->input("id"));
            }
            $temfile_path=public_path()."/cfg/consolidate/".$request->input("id")."/".$request->input("catg")."_TEMP.CFG";
            @unlink($temfile_path);
            move_uploaded_file($_FILES["cfg_file"]['tmp_name'], $temfile_path);

            $obj_serial = new Serialization();
            $arr_ret = $obj_serial->New_DecP($temfile_path, "", "", "", "", "", "", "", "", "", "");
            if(!$arr_ret){
                $arr_return["msg"]="Invalid CFG File";
            } else if($arr_ret["M_Comp"]!=$request->input("compnam")){
                $arr_return["msg"]="Invalid Group Name! This CFG file is for Customer Group ".$arr_ret["M_Comp"];
            } else if($arr_ret["M_Sys_Nam"]!=$request->input("catg")){
                $arr_return["msg"]="Invalid System ID! This CFG file is for System ID ".$arr_ret["M_Sys_Nam"];
            } else {
                $arr_return["exp_dat"] = $arr_ret["M_Exp_Dat"];
                $arr_return["serial_no"] = $arr_ret["M_Chk_Ser"];
                $arr_return["curpassword"] = trim($arr_ret["M_Act_Pass"]);
            }
        } else {
            $arr_return["msg"]="No file been uploaded";
        }

        return $arr_return;
    }

    private function handleSaveCfgAction($request)
    {
        $soft_license = ($request->input('soft_lic')=="")?0:$request->input('soft_lic');
        $category_id = $request->input("category_id");
        $companycode = $request->input("companycode");
        $companyname = $request->input("companyname");
        $system_id = $request->input("system_id");
        $serial_no = $request->input("serial_no");
        $exp_dat = $request->input("exp_dat");
        $curpassword = $request->input("curpassword");
        $newpassword = trim($request->input("newpassword"));

        $temfile_path=public_path()."/cfg/consolidate/".$companycode."/".$system_id."_TEMP.CFG";
        $file_path=public_path()."/cfg/consolidate/".$companycode."/".$system_id.".CFG";
        $bchangepassword=false;
        $a_return["msg"]="Update Serialization Successful";
        $obj_serial = new Serialization();
        if(file_exists($temfile_path)){
            $arr_ret = $obj_serial->New_DecP($temfile_path, "", "", "", "", "", "", "", "", "", "");
            if(!$arr_ret){
                $a_return["msg"]="Invalid CFG File";
            } else if($arr_ret["M_Comp"]!=$companyname){
                $a_return["msg"]="Invalid Group Name! This CFG file is for Customer Group ".$arr_ret["M_Comp"];
            } else if($arr_ret["M_Sys_Nam"]!=$system_id){
                $a_return["msg"]="Invalid System ID! This CFG file is for System ID ".$arr_ret["M_Sys_Nam"];
            } else {
                if($curpassword!=$newpassword){
                    $bchangepassword=true;
                    $cpwfile_path = $temfile_path;
                }
            }
        } else if(file_exists($file_path)){
            $arr_ret = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
            if(!$arr_ret){
                $a_return["msg"]="Invalid CFG File";
            } else if($arr_ret["M_Comp"]!=$companyname){
                $a_return["msg"]="Invalid Group Name! This CFG file is for Customer Group ".$arr_ret["M_Comp"];
            } else if($arr_ret["M_Sys_Nam"]!=$system_id){
                $a_return["msg"]="Invalid System ID! This CFG file is for System ID ".$arr_ret["M_Sys_Nam"];
            } else {
                if($curpassword!=$newpassword){
                    $bchangepassword=true;
                    $cpwfile_path = $file_path;
                }
            }
        } else {
            if(!file_exists(public_path()."/cfg/consolidate/".$companycode)){
                @mkdir(public_path()."/cfg/consolidate/".$companycode);
            }
            $Ra1 = trim($obj_serial->Irand(10,99));
            $Rb1 = trim($obj_serial->Irand(10,99));
            $Rc1 = trim($obj_serial->Irand(10,99));
            $m_fac = "0000000000"; # not in use
            $m_pas = "          "; # System Administrator Password
            $mpas = "0"; # only 2 not for new serialization
            $arr_return = $obj_serial->New_EncP($companyname, $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $m_pas, $temfile_path, $Ra1, $Rb1, $Rc1, $soft_license);
            $newpassword = trim($arr_return["M_Pasw"]);
            $a_return["msg"]="Update Serialization Successful!! New CFG File Created";
            $category = CustomerCategory::find($category_id);
            $category->lastrunno=$serial_no;
            $category->save();
            $a_return["newpassword"] = $newpassword;
        }

        if($bchangepassword){
            $obj_serial = new Serialization();
            $Ra1 = trim($obj_serial->Irand(10,99));
            $Rb1 = trim($obj_serial->Irand(10,99));
            $Rc1 = trim($obj_serial->Irand(10,99));
            $m_fac = "0000000000"; # not in use
            $mpas = "2"; # only 2 not for new serialization
            $arr_return = $obj_serial->New_DecP($cpwfile_path, "", "", "", "", "", "", "", "", "", "");
            $arr_return = $obj_serial->New_EncP($arr_return["M_Pri"].$arr_return["M_Sec"].$arr_return["M_Tet"].$arr_return["M_Frt"].$arr_return["M_Sth"], $system_id, $exp_dat, $serial_no, $mpas, $m_fac, $newpassword, $cpwfile_path, $Ra1, $Rb1, $Rc1, $soft_license);

            $a_return["msg"]="Update Serialization Successful!! CFG Password Changed";
        }

        $group = CustomerGroup::find($request->input("groupid"));
        $group->serial_no = $serial_no;
        $group->exp_dat = $exp_dat;
        $group->cfgpassword = $newpassword;
        $group->cfgfile = "/cfg/consolidate/".$companycode."/".$system_id.".CFG";
        $group->soft_lic = $soft_license;
        $group->save();

        return $a_return;
    }

    private function handleDeleteCfgAction($request)
    {
        $group_id = $request->input("group_id");
        $group = CustomerGroup::find($group_id);
        $category = CustomerCategory::find($group->categoryid);
        $file_path= public_path()."/cfg/consolidate/".$group->groupcode."/".$category->categorycode.".CFG";
        @unlink($file_path);
        $group->serial_no = " ";
        $group->exp_dat = " ";
        $group->cfgpassword = " ";
        $group->agentid = null;
        $group->cfgfile = " ";
        $group->save();
        $a_return["msg"] = "Removed Serialization File Successful!";

        return $a_return;
    }

    private function createNewCustomerGroup($request)
    {
        $companycode = $request->input('groupcode');
        $system_id = $request->input('categorycode');
        $temfile_path = public_path()."/cfg/consolidate/".$companycode."/".$system_id."_TEMP.CFG";
        $file_path = public_path()."/cfg/consolidate/".$companycode."/".$system_id.".CFG";
        if(file_exists($temfile_path)){
            if(file_exists($file_path)){
                @unlink($file_path);
            }
            @rename($temfile_path, $file_path);
        }

        $group = new CustomerGroup();
        $group->groupcode = $request->input('groupcode');
        $group->description = $request->input('description');
        $group->foldername = $request->input('foldername');
        $group->customer_categories_id = $request->input("category_id");
        $group->companyid = $request->input("companyid");
        $group->save();

        $groupid = $group->id;
        if($request->input('cust')){
            foreach($request->input('cust') as $rcust){
                $groupdetail = new customerGroupsCustomer();
                $groupdetail->customer_groups_id = $groupid;
                $groupdetail->customers_id = $rcust;

                $groupdetail->save();
            }
        }

        return redirect('/customer-groups')->with('success', 'New Customer Group ('.$request->input('groupcode').') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = CustomerGroup::find($id);
        if (!$group) {
            abort(404);
        }

        $groupdetail = DB::table('customer_groups_customers')
            ->leftJoin('customers', 'customers.id', '=', 'customer_groups_customers.customers_id')
            ->leftJoin('customer_services AS cs', function ($join) use ($group) {
                $join->on('customers.id', '=', 'cs.customers_id')
                    ->where('cs.customer_categories_id', '=', $group->customer_categories_id);
            })
            ->selectRaw('customer_groups_customers.id AS id')
            ->selectRaw('customer_groups_customers.customers_id AS customerid')
            ->selectRaw('customers.companyname AS companyname')
            ->selectRaw('customers.companycode AS companycode')
            ->selectRaw('cs.contract_typ AS contract_typ')
            ->selectRaw('cs.amount AS amount')
            ->selectRaw('cs.inc_hw AS inc_hw')
            ->selectRaw('cs.pay_before AS pay_before')
            ->selectRaw('cs.start_date AS start_date')
            ->selectRaw('cs.end_date AS end_date')
            ->selectRaw('cs.service_date AS service_date')
            ->selectRaw('cs.soft_license AS soft_license')
            ->selectRaw('cs.active AS active')
            ->where('customer_groups_customers.customer_groups_id', $id)
            ->orderBy('customers.companycode', 'ASC')
            ->get();

        $categorylist = CustomerCategory::get();
        $companylist = CompanySetting::get();

        return view('customer_groups.show', compact('group', 'groupdetail', 'id', 'categorylist', 'companylist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerGroup  $customer_group
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CustomerGroup $customer_group)
    {
        $groupdetail = customerGroupsCustomer::where('customer_groups_id', $customer_group->id);
        if ($customer_group->category) {
            $tempFilePath = public_path("cfg/consolidate/{$customer_group->groupcode}/{$customer_group->category->categorycode}_TEMP.CFG");
            if (file_exists($tempFilePath)) {
                @unlink($tempFilePath);
            }
        }
        $customer_group->load(['category', 'category.companySetting']);
        $categorylist = CustomerCategory::get();
        $companylist = CompanySetting::get();
        $input = $request->all();
        $customers = $this->dataService->fetchCustomers(request());

        return view('customer_groups.edit', compact('customer_group', 'groupdetail' , 'categorylist', 'input', 'companylist', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerGroupRequest  $request
     * @param  \App\Models\CustomerGroup  $customer_group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerGroupRequest $request, CustomerGroup $customer_group)
    {
        // Fetch the CustomerGroup by its ID
        if (!$customer_group->exists()) {
            return redirect('/customer_groups')->with('error', 'Customer Group not found!');
        }
        // Handle file operations if needed
        $companycode = $request->input('groupcode');
        $system_id = $request->input('categorycode');
        $file_path = public_path("/cfg/consolidate/{$companycode}/{$system_id}.CFG");
        $temfile_path=public_path()."/cfg/consolidate/".$companycode."/".$system_id."_TEMP.CFG";
        if(file_exists($temfile_path)){
            if(file_exists($file_path)){
                @unlink($file_path);
            }
            @rename($temfile_path, $file_path);
        }
        if (file_exists($file_path)) {
            $obj_serial = new Serialization();
            $arr_ret = $obj_serial->New_DecP($file_path, "", "", "", "", "", "", "", "", "", "");
            $customer_group->serial_no = $arr_ret["M_Chk_Ser"];
            $customer_group->exp_dat = $arr_ret["M_Exp_Dat"];
            $customer_group->cfgpassword = trim($arr_ret["M_Act_Pass"]);
            $customer_group->cfgfile = "/cfg/consolidate/{$companycode}/{$system_id}.CFG";
        }
        // Update the CustomerGroup attributes
        $customer_group->groupcode = $request->input('groupcode');
        $customer_group->description = $request->input('description');
        $customer_group->foldername = $request->input('foldername');
        $customer_group->categoryid = $request->input('category_id');
        $customer_group->agentid = $request->input('agentid');
        $customer_group->companyid = $request->input('companyid');
        $customer_group->save();

        // Update or create CustomerGroupsCustomer records
        $this->updateOrCreateGroupCustomers($customer_group, $request->input('cust'));

        return redirect('/customer-groups')->with('success', 'Customer Group ('.$request->input('groupcode').') has been updated!!');
    }

    /**
     * Update or create CustomerGroupsCustomer records.
     *
     * @param  \App\Models\CustomerGroup  $customer_group
     * @param array $customers
     * @return void
     */
    private function updateOrCreateGroupCustomers($customer_group, array $customers)
    {
        customerGroupsCustomer::where('customergroupid', $customer_group->id)
            ->whereNotIn('id', request()->input('detid', []))
            ->delete();

        foreach ($customers as $key => $customerId) {
            $detId = request()->input('detid.'.$key);
            $groupDetail = customerGroupsCustomer::updateOrCreate(
                ['id' => $detId], // Update if ID exists, or create if it doesn't
                [
                    'customergroupid' => $customer_group->id,
                    'customerid' => $customerId,
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,CustomerGroup $customer_group)
    {
        if (!empty($customer_group->cfgfile)) {
            $cfgDirectory = public_path("cfg/consolidate/{$customer_group->groupcode}");

            if (File::exists($cfgDirectory)) {
                File::deleteDirectory($cfgDirectory);
            }
        }
        $customer_group->delete();
        customerGroupsCustomer::where("customer_groups_id", $customer_group->id)->delete();

        return redirect('/customer-groups')->with('success', "Customer Group ({$customer_group->groupcode}) has been deleted!!");
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');

        $suggestions = Customer::where('name', 'LIKE', '%' . $term . '%')
            ->select('name') // Modify this based on your model and column names
            ->limit(10)
            ->get();

        return response()->json($suggestions);
    }

    public function customerList(Request $request)
    {
        $searchTerm = $request->input("term");
        $query = Customer::select('id', 'companycode', 'companyname', 'contactperson', 'terms_id')
            ->orderBy('companycode', 'asc');

        if (strlen($searchTerm) > 5) {
            $query->where('companyname', 'like', '%' . $searchTerm . '%');
        } else {
            $query->where('companycode', 'like', '%' . $searchTerm . '%');
        }

        $data = $query->get();

        $arr_return = $data->map(function ($customer) {
            return [
                "value" => $customer->id,
                "text" => "{$customer->companycode} - {$customer->companyname}",
            ];
        })->toArray();

        return $arr_return;
    }

    public function categoryList(Request $request)
    {
        return CustomerCategory::select('id','categorycode','description','lastrunno')
                                ->where('id', $request->input("categoryid"))
                                ->first();
    }

    public function agentList(Request $request)
    {
        //$data = Customer::select('id','companycode','companyname','contactperson','termid')->where('companyname', 'like', '%'.$request->input("q").'%')->orWhere('companycode', 'like', '%'.$request->input("q").'%')->get();
        if(strlen($request->input("q"))>5){
            $data = Agent::select('id','agentcode','name')->where('name', 'like', '%'.$request->input("q").'%')->orderBy('name','asc')->get();
        } else {
            $data = Agent::select('id','agentcode','name')->where('agentcode', 'like', '%'.$request->input("q").'%')->orderBy('agentcode','asc')->get();
        }
        $arr_return=array();
        foreach($data as $rdt){
            array_push($arr_return,array("value"=>$rdt["id"],"text"=>$rdt["agentcode"]."-".$rdt["name"]));
        }
        return $arr_return;
    }

    public function custservice(Request $request)
    {
        $serviceId = $request->input("serviceid");
        $customerId = $request->input("customerid");
        $categoryId = $request->input("categoryid");
        if ($serviceId) {
            $data = CustomerService::find($serviceId);
        } else {
            $data = CustomerService::where("customers_id", $customerId)
                                    ->where('customer_categories_id', $categoryId)
                                    ->first();
        }
        if (!$data) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        return $data;
    }

    public function savecustservice(Request $request)
    {
        $serviceId = $request->input("serviceid");
        $attributes = $request->only([
            'contract_typ',
            'amount',
            'inc_hw',
            'pay_before',
            'start_date',
            'end_date',
            'service_date',
            'soft_license',
            'vpnaddress',
            'active',
        ]);
        $customerservice = CustomerService::find($serviceId);
        if (!$customerservice) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        $customerservice->update($attributes);

        return array("msg" => "Updated Customer Services!");
    }

    public function savegroupcustservice(Request $request) {
        $customergroupdetail = CustomerGroupDetail::where("customergroupid",$request->input("groupid"));
        if($customergroupdetail->count()>0) {
            foreach($customergroupdetail->get() as $rcustgrpdetail){
                if($rcustgrpdetail->customerservices($request->input("categoryid"))->exists()){
                    $customerservice = CustomerService::find($rcustgrpdetail->customerservices($request->input("categoryid"))->first()->id);
                    $customerservice->contract_typ = $request->input("contract_typ");
                    if($request->input("amount")!=""){
                        $customerservice->amount = $request->input("amount");
                    }
                    $customerservice->inc_hw = $request->input("inc_hw");
                    $customerservice->pay_before = $request->input("pay_before");
                    $customerservice->save();
                }
            }
        }
        return array("msg"=>"Updated Customer Services!");
    }

}
