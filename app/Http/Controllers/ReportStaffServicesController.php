<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\SystemSetting;
use App\Models\Report;
use App\Models\SalesInvoice;
use App\Models\Receipt;
use App\Models\SoftwareService;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF as RPTPDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;

class ReportStaffServicesController extends Controller
{
    public function index(Request $request)
    {
        $user = User::get();
        $default["logindate"] = $request->session()->get('login_date');

        return view('reports.staffservice',compact('default','user'));
    }

    public function reportpdf(Request $request){
        $datefr = Carbon::createFromFormat('d/m/Y', $request->input("datfr"))->format('Y-m-d');
        $dateto = Carbon::createFromFormat('d/m/Y', $request->input("datto"))->format('Y-m-d');
        $stafffrom = $request->input("stafffrom");
        $staffto = $request->input("staffto");
        $type = $request->input("details");
        $systemsetting = SystemSetting::first();
        $condsql=""; $arrfilter=array(); $acust=array();
        $a = array();
        $statement = "";
        //  $query= SoftwareService::query();
        $num = 0;
        if(!empty($request->input('staff'))){
            foreach($request->input('staff') as $s => $staff){
                $num++;
                if($num <= 1){
                    //$statement .= " assigned_user LIKE '%$staff%' ";
                    $statement .= " closed_by LIKE '%$staff%' ";
                } else {
                    //$statement .= " OR assigned_user LIKE '%$staff%' ";
                    $statement .= " OR closed_by LIKE '%$staff%' ";
                }
                //  $statement .= "->where('assigned_user', 'like', $staff)";
                //  $query->orwhere('assigned_user','like', '%'.$staff.'%');

                //  $query->whereRaw("assigned_user LIKE %$staff% ");
            }
            if($request->input('servicetype')>0){
                $services_query = SoftwareService::whereRaw(" ($statement)")->where("servicetype",$request->input('servicetype'))->where("servicedate",">=",$datefr)->where("servicedate","<=",$dateto)->orderBy('servicedate','asc')->orderBy('job_no','asc')->get();
            } else {
                $services_query = SoftwareService::whereRaw(" ($statement)")->where("servicedate",">=",$datefr)->where("servicedate","<=",$dateto)->orderBy('servicedate','asc')->orderBy('job_no','asc')->get();
            }
        } else {
            $services_query = '';
        }
        //  $services = SoftwareService::where('status','!=',0)->whereDate("servicedate",">=",$datefr)->whereDate("servicedate","<=",$dateto)->whereRaw('JSON_CONTAINS(`assigned_user`, \'{"name":'.$get_staff.'}\')')->get();

        $services = $services_query;

        if($services){
            $arr_data=$services;
            RPTPDF::SetTitle('Staff Service Report');
            $data=array();
            $data2=array();
            $npage=1;
            $keepdate="";$nrow=0; $arrpage=array(); $arrcomp=array();
            $sum=array(); $sum2=array();
            $totsum["sal_amt"]=0;
            $totsum["sal_qty"]=0;
            $recpage=32;
            $recpage2=32;
            $npage2=1;
            $keepdate2="";$nrow2=0; $arrpage2=array(); $arrcomp2=array();
            $keepcomp = "";
            $keepcomp2 = "";
            $save_usr = array();
            $total_usr = array();
            if($type == 1){

                foreach($request->input('staff') as $s => $staff_nam){
                    $stotal = 0;
                    foreach($arr_data as $skey => $row_data){
                        //$assigned1 = json_decode($row_data->assigned_user);

                        //$assigned = json_decode($row_data->assigned_user,true);
                        //  var_dump(array_column($assigned, 'name'));
                        //foreach($assigned as $kassigned => $assigned_users){

                        //if($staff_nam == $assigned_users['name'] ){
                        if($staff_nam == $row_data->closed_by ){
                            $stotal++;
                            $nrow++;
                            $keepdate=$row_data->servicedate;
                            //  echo $row_data->job_no.' , '.$row_data['assigned_user'].'</br>';

                            array_push($data,$row_data);
                            if($nrow==$recpage){

                                $last_staff_data = array(
                                    'name'=>$staff_nam,
                                    'num' => $stotal
                                );
                                array_push($save_usr,$last_staff_data);
                                array_push($arrpage,$data);
                                array_push($arrcomp,false);
                                $nrow=0; unset($data); $data=array(); unset($last_staff_data); $last_staff_data=array();

                            }

                        }

                        //}

                        //  echo $nrow.' '.$recpage.' </br>';
                    }
                    if($stotal != 0){
                        $total_usr[] = array(
                            'name' => $staff_nam,
                            'total' => $stotal
                        );
                    }

                }


            } else {
                foreach($request->input('staff') as $s => $staff_nam){
                    $stotal = 0;
                    foreach($arr_data as $skey => $row_data){
                        //$assigned = json_decode($row_data->assigned_user,true);
                        //foreach($assigned as $kassigned => $assigned_users){
                        //if($staff_nam == $assigned_users['name'] ){
                        if($staff_nam == $row_data->closed_by ){
                            $stotal++;
                        }
                        //}
                    }
                    if($stotal != 0){
                        $total_usr[] = array(
                            'name' => $staff_nam,
                            'total' => $stotal
                        );
                    }
                }
                foreach($arr_data as $row_data){

                    $nrow=1;
                    $keepdate=$row_data->servicedate;

                    array_push($data,$row_data);
                    if($nrow==$recpage){
                        array_push($arrpage,$data);
                        array_push($arrcomp,false);
                        $nrow=0; unset($data); $data=array();
                    }

                    $keepcomp = $row_data->id;
                }
            }

            if($nrow<$recpage && $nrow>0){
                array_push($arrpage,$data);
                array_push($arrcomp,false);
                $nrow=0; unset($data); $data=array();
            }

            $totpage=count($arrpage);
            $company=array();
            $companylist = CompanySetting::get();
            if($companylist){
                foreach($companylist as $rcomplist){
                    $company[$rcomplist->id] = $rcomplist;
                }
            }
            //var_dump($save_usr);
            if($arrpage) foreach($arrpage as $npg=> $rowpage){
                $data=$rowpage;
                $last_usr = $save_usr;
                $gettotal = $total_usr;

                $finalpage = ($totpage==$npage)?true:false;
                RPTPDF::SetMargins(10, 10, 10, true);
                RPTPDF::SetAutoPageBreak(false, 10);
                RPTPDF::AddPage();
                //RPTPDF::writeHTML(view('report.staffservicepdf',compact('data','last_usr','gettotal','request','npage','totpage','company','finalpage','type','get_staff','systemsetting')), true, false, true, false, '');
                RPTPDF::writeHTML(view('reports.staffservicepdf',compact('data','last_usr','gettotal','request','npage','totpage','company','finalpage','type','systemsetting')), true, false, true, false, '');
                $npage++;
            }
            if($type == 1){

                $totpage2=1;
                $company2=array();
                $last_usr = '';
                $gettotal = $total_usr;
                $type = 2;
                //if($arrpage2) foreach($arrpage2 as $npg2=> $rowpage2){
                //$rowpage2
                //  $data2=$rowpage2;
                $data =  $services;
                $finalpage2 = true;
                RPTPDF::SetMargins(10, 10, 10, true);
                RPTPDF::SetAutoPageBreak(false, 10);
                RPTPDF::AddPage();
                //RPTPDF::writeHTML(view('report.staffservicepdf',compact('data','last_usr','gettotal','request','npage','npage2','totpage2','company2','finalpage2','type','get_staff','systemsetting')), true, false, true, false, '');
                RPTPDF::writeHTML(view('reports.staffservicepdf',compact('data','last_usr','gettotal','request','npage','npage2','totpage2','company2','finalpage2','type', 'systemsetting')), true, false, true, false, '');
                $npage2++;
                //}
            }
            return RPTPDF::Output(storage_path("staffservice_report.pdf"));

            view()->share('data',$arr_data);
            view()->share('request',$request);
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('reports.staffservicepdf');
            $pdf->getDomPDF()->set_option("enable_php", true);
            return $pdf->stream();
        } else {
            return view('reports.norecord');
            //abort('404');
        }

    }
}
