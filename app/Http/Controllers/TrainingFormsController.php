<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\TrainingForm;
use App\Models\TrainingFormDetail;
use App\Models\TrainingFormDetailExtra;
use App\Models\SoftwareService;
use App\Models\SalesInvoice;
use App\Models\SalesInvoicesDetail;
use App\Models\Customer;
use App\Models\CustomerCategory;
use App\Models\CustomerGroup;
use App\Models\customerGroupsCustomer;
use App\Models\CompanySetting;
use App\Models\CustomerService;
use App\Models\SolutionProfile;
use App\Models\SystemSetting;
use App\Models\Armatch;
use App\Models\Stock;
use App\Models\Term;
use App\Models\Agent;
use App\Models\Area;
use App\Models\Uom;
use App\Models\User;
use App\Models\Supplier;
use App\Bwlibs\FileDocManage;
use App\Bwlibs\Printfile;
use PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use Illuminate\Support\Facades\DB;
use File;
use Storage;
class TrainingFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('searchvalue')){
            $training = TrainingForm::trainingformtablelist()->select('training_forms.id','training_forms.systemcod','training_forms.form_title','customer_categories.description')->where('training_forms.systemcod','like','%'.$request->input('searchvalue').'%')->orwhere('training_forms.form_title','like','%'.$request->input('searchvalue').'%')
                ->paginate(15);
            $training->withPath('?searchvalue='.(($request->has('searchvalue'))?$request->input('searchvalue'):"") );
        } else {
            $training = TrainingForm::trainingformtablelist()->select('training_forms.id','training_forms.systemcod','training_forms.form_title','customer_categories.description')->paginate(15);
        }
        $gettrain = TrainingForm::get();

        $input=$request->all();
        return view('trainingform.index',compact('training','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = array();
        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();
        //
        return view('trainingform.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trainingform = new TrainingForm();
        $data = $this->validate($request, [
            'systemcod'=>'required|unique:trainingform',
        ]);
        $data['systemcod'] = $request['systemcod'];
        $data['form_title'] = $request['form_title'];
        $trainingform->saveTrainingForm($data);

        $training_form_id = $trainingform->id;
        if(isset($request['d_description'])){
            foreach($request['d_description'] as $key => $par){

                $training_detail = new TrainingFormDetail();
                $data2['trainingid'] = $training_form_id;
                $data2['no'] = $request['no'][$key];
                $data2['particular'] = $par;
                $data2['special'] = $request['d_specialfield'][$key];
                $data2['space_lvl'] = $request['d_spacefield'][$key];
                $data2['input_flag'] = $request['d_input_flag'][$key];
                $getmax = TrainingForm::trainingformdetaillist()->select('training_form_details.seq')->where('training_form_details.trainingid',$training_form_id)->orderBy('training_form_details.seq',"DESC")->first();
                if($getmax){
                    $getseq = $getmax->seq + 1;
                } else {
                    $getseq = 1;
                }
                $data2['seq'] = $getseq;
                $training_detail->saveTrainingFormDetail($data2);
                $detail_id = $training_detail->id;
                if(!empty($request['d_description_detail'][$key])){
                    foreach($request['d_description_detail'][$key] as $dkey => $detail){
                        $training_detail_extra = new TrainingFormDetailExtra();
                        $data3['detail_id'] = $detail_id;
                        $data3['particular'] = $detail;
                        $data3['special'] = $request['d_special_field_details'][$key][$dkey];
                        $data3['space_lvl'] = $request['d_space_field_details'][$key][$dkey];
                        $data3['input_flag'] = $request['d_input_flags'][$key][$dkey];
                        $getmax2 = TrainingFormDetailExtra::where('trainingdetail_extra.detail_id',$detail_id)->orderBy('trainingdetail_extra.seq',"DESC")->first();
                        if($getmax2){
                            $getseq2 = $getmax2->seq + 1;
                        } else {
                            $getseq2 = 1;
                        }
                        $data3['seq'] = $getseq2;
                        $training_detail_extra->saveTrainingDetailExtra($data3);
                    }
                }
            }
        }
        return redirect('/trainingform')->with('success', 'New Training form for system ('.$request['systemcod'].') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $trainingform = TrainingForm::find($id);
        $training_id = $trainingform->id;
        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();
        $trainingdetail = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq','training_form_details.input_flag')->where('training_form_details.trainingid',$training_id)->orderBy("training_form_details.seq","ASC")->get();
        $detailextra = TrainingForm::trainingdetailextralist()->select('trainingdetail_extra.id','trainingdetail_extra.detail_id','trainingdetail_extra.particular','trainingdetail_extra.special','trainingdetail_extra.space_lvl','trainingdetail_extra.seq','trainingdetail_extra.input_flag')->where('training_form_details.trainingid',$training_id)->orderBy("trainingdetail_extra.seq","ASC")->get();
        return view('trainingform.show', compact('trainingform','trainingdetail','data','detailextra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $trainingform = TrainingForm::find($id);
        $training_id = $trainingform->id;
        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();
        $trainingdetail = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq','training_form_details.input_flag')->where('training_form_details.trainingid',$training_id)->orderBy("training_form_details.seq","ASC")->get();
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq','training_detail_extras	.input_flag')->where('training_form_details.trainingid',$training_id)->orderBy("training_detail_extras	.seq","ASC")->get();
        return view('trainingform.edit', compact('trainingform','trainingdetail','data','detailextra','id'));
    }

    public function sort(Request $request,$id)
    {
        $trainingform = TrainingForm::find($id);
        $training_id = $trainingform->id;

        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();
        $trainingdetail = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq')->where('training_form_details.trainingid',$training_id)->orderBy("training_form_details.seq","ASC")->get();
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq')->where('training_form_details.trainingid',$training_id)->get();
        return view('trainingform.sort', compact('trainingform','trainingdetail','data','detailextra','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'systemcod'=>'required|unique:trainingform,systemcod,'.$id.''
        ]);
        $trainingform = TrainingForm::find($id);

        $data['id'] = $id;
        $data['systemcod'] = $request['systemcod'];
        $data['form_title'] = $request['form_title'];
        $trainingform->updateTrainingForm($data);
        $training_form_id = $id;

        $details = array();
        $details2 = array();
        foreach($request['d_id'] as $ikey => $pid){
            if($pid != 0){
                $details[] = $pid;

                if(isset($request['d_detail_id'][$ikey]) && !empty($request['d_detail_id'][$ikey])){
                    foreach($request['d_detail_id'][$ikey] as $ikey2 => $pid2){
                        if($pid2 != 0){
                            $details2[] = $pid2;

                        }
                    }

                }
            }
        }
        $check = TrainingFormDetail::where('trainingid',$training_form_id)->whereNotIn('id', $details)->delete();



        if(isset($details2) && !empty($details2)){
            $check2 = TrainingFormDetailExtra::trainingdetaillist()->select('training_detail_extras	.id')->where('trainingformdetail.trainingid',$training_form_id)->whereNotIn('training_detail_extras	.id',$details2)->delete();
        }

        $seq =0;
        foreach($request['d_description'] as $key => $par){
            $seq++;
            $detailid = $request['d_id'][$key];
            $special_main = (isset($request["d_specialfields"][$key]))?"1":"0";
            $space_main = (isset($request["d_spacefields"][$key]))?"1":"0";
            $input_main = (isset($request["d_input_flags"][$key]))?"1":"0";
            $data2['id'] = $detailid;
            $data2['trainingid'] = $training_form_id;
            $data2['no'] = $request['no'][$key];
            $data2['particular'] = $par;
            $data2['special'] = $special_main;
            $data2['space_lvl'] = $space_main;
            $data2['seq'] = $seq;
            $data2['input_flag'] = $input_main;
            if($detailid != 0){
                $training_detail = TrainingFormDetail::where('id',$detailid)->first();
                $training_detail->updateTrainingFormDetail($data2);
                $detail_id = $training_detail->id;
            } else {
                $training_detail = new TrainingFormDetail();
                $training_detail->saveTrainingFormDetail($data2);
                $detail_id = $training_detail->id;
            }

            $subseq=0;
            if(!empty($request['d_description_detail'][$key])){
                foreach($request['d_description_detail'][$key] as $dkey => $detail){
                    $subseq++;
                    $special_sub = (isset($request["d_detail_specialfield"][$key][$dkey]))?"1":"0";
                    $space_sub = (isset($request["d_detail_spacefield"][$key][$dkey]))?"1":"0";
                    $input_sub = (isset($request["d_detail_input_flags"][$key][$dkey]))?"1":"0";
                    $extraid = $request['d_detail_id'][$key][$dkey];
                    $data3['detail_id'] = $detail_id;
                    $data3['id'] = $extraid;
                    $data3['particular'] = $detail;
                    $data3['special'] = $special_sub;
                    $data3['space_lvl'] = $space_sub;
                    $data3['seq'] = $subseq;
                    $data3['input_flag'] = $input_sub;
                    if($extraid != 0){
                        $training_detail_extra = TrainingFormDetailExtra::where('id',$extraid)->first();
                        $training_detail_extra->updateTrainingDetailExtra($data3);
                    } else {
                        $training_detail_extra = new TrainingFormDetailExtra();
                        $training_detail_extra->saveTrainingDetailExtra($data3);
                    }

                }
            }
        }
        return redirect('/trainingform')->with('success', 'Training form for system ('.$trainingform->systemcod.') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainingform = TrainingForm::find($id);

        $trainingdetailExtra = TrainingFormDetailExtra::trainingdetaillist()->select('training_detail_extras	.id')->where('trainingformdetail.trainingid',$id)->delete();
        $trainingdetail = TrainingFormDetail::where('trainingid',$id)->delete();

        $trainingcode = $trainingform->systemcod;
        $trainingform->delete();

        return redirect('/trainingform')->with('success', 'Training form for System ('.$trainingcode.') has been deleted!!');
    }

    public function detailList(Request $request){
        $detail_id = $request['id'];
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq','training_detail_extras	.input_flag')->where('training_detail_extras	.detail_id',$detail_id)->orderBy("seq")->get();

        $arr_return["datalist"] = $detailextra;
        $arr_return["msg"] = "success";

        return $arr_return;
    }
    public function trainingformList(Request $request){
        $training_id = $request['id'];
        $trainingdetailseq = TrainingForm::trainingformdetaillist()->select('trainingformdetail.id','trainingformdetail.trainingid','trainingformdetail.no','trainingformdetail.particular','trainingformdetail.special','trainingformdetail.space_lvl','trainingformdetail.seq','trainingformdetail.input_flag')->where('trainingformdetail.trainingid',$training_id)
            ->orderBy("trainingformdetail.seq","ASC");
        $arr_return["datalist"]=$trainingdetailseq->get();
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq','training_detail_extras	.input_flag')->where('trainingformdetail.trainingid',$training_id)->get();
        $arr_return["sublist"] = $detailextra;
        $arr_return["msg"] = "success";

        return $arr_return;
    }
    public function updseq(Request $request){
        $training_id = $request['id'];
        if($request->has("fromseq") && $request->has("toseq")){
            if($request->input("fromseq")>$request->input("toseq")) {
                $trainingdetail = TrainingForm::trainingformdetaillist()->select('trainingformdetail.id','trainingformdetail.trainingid','trainingformdetail.no','trainingformdetail.particular','trainingformdetail.special','trainingformdetail.space_lvl','trainingformdetail.seq')->where('trainingformdetail.trainingid',$training_id)->where("seq",">=",$request->input("toseq"))->where("seq","<=",$request->input("fromseq"))->orderBy("seq");
                if($trainingdetail->count()>0){
                    foreach($trainingdetail->get() as $row_training){
                        if($row_training->seq==$request->input("fromseq")){
                            $updstock = TrainingFormDetail::find($row_training->id);
                            $updstock->seq=$request->input("toseq");
                            $updstock->save();
                        } else {
                            $updstock = TrainingFormDetail::find($row_training->id);
                            $updstock->seq=$updstock->seq+1;
                            $updstock->save();
                        }
                    }
                }
            } elseif($request->input("fromseq")<$request->input("toseq")) {
                $trainingdetail = TrainingFormDetail::where('trainingid',$training_id)->where("seq",">=",$request->input("fromseq"))->where("seq","<=",$request->input("toseq"))->orderBy("seq");
                if($trainingdetail->count()>0){
                    foreach($trainingdetail->get() as $row_training){
                        if($row_training->seq==$request->input("fromseq")){
                            $updstock = TrainingFormDetail::find($row_training->id);
                            $updstock->seq=$request->input("toseq");
                            $updstock->save();
                        } else {
                            $updstock = TrainingFormDetail::find($row_training->id);
                            $updstock->seq=$updstock->seq-1;
                            $updstock->save();
                        }
                    }
                }
            }
            $trainingdetailseq = TrainingForm::trainingformdetaillist()->select('trainingformdetail.id','trainingformdetail.trainingid','trainingformdetail.no','trainingformdetail.particular','trainingformdetail.special','trainingformdetail.space_lvl','trainingformdetail.seq')->where('trainingformdetail.trainingid',$training_id)
                ->orderBy("trainingformdetail.seq","ASC");
            $arr_return["datalist"]=$trainingdetailseq->get();
            $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq')->where('trainingformdetail.trainingid',$training_id)->get();
            $arr_return["sublist"] = $detailextra;
            $arr_return["msg"] = "success";
        } else {
            $arr_return["msg"] = "error";
        }
        return $arr_return;
    }

    public function updseq2(Request $request){
        $training_id = $request['id'];
        if($request->has("fromseq") && $request->has("toseq")){
            if($request->input("fromseq")>$request->input("toseq")) {
                $trainingdetail = TrainingFormDetailExtra::where('detail_id',$training_id)->where("seq",">=",$request->input("toseq"))->where("seq","<=",$request->input("fromseq"))->orderBy("seq");
                if($trainingdetail->count()>0){
                    foreach($trainingdetail->get() as $row_training){
                        if($row_training->seq==$request->input("fromseq")){
                            $updstock = TrainingFormDetailExtra::find($row_training->id);
                            $updstock->seq=$request->input("toseq");
                            $updstock->save();
                        } else {
                            $updstock = TrainingFormDetailExtra::find($row_training->id);
                            $updstock->seq=$updstock->seq+1;
                            $updstock->save();
                        }
                    }
                }
            } elseif($request->input("fromseq")<$request->input("toseq")) {
                $trainingdetail = TrainingFormDetailExtra::where('detail_id',$training_id)->where("seq",">=",$request->input("fromseq"))->where("seq","<=",$request->input("toseq"))->orderBy("seq");
                if($trainingdetail->count()>0){
                    foreach($trainingdetail->get() as $row_training){
                        if($row_training->seq==$request->input("fromseq")){
                            $updstock = TrainingFormDetailExtra::find($row_training->id);
                            $updstock->seq=$request->input("toseq");
                            $updstock->save();
                        } else {
                            $updstock = TrainingFormDetailExtra::find($row_training->id);
                            $updstock->seq=$updstock->seq-1;
                            $updstock->save();
                        }
                    }
                }
            }

            $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq')->where('training_detail_extras	.detail_id',$training_id)->orderBy("training_detail_extras	.seq","ASC")->get();
            $arr_return["datalist"] = $detailextra;
            $arr_return["msg"] = "success";
        } else {
            $arr_return["msg"] = "error";
        }
        return $arr_return;
    }

    public function trainingformpdf($id,Request $request){
        $condsql=""; $arrfilter=array(); $acust=array();

        $trainingform = TrainingForm::find($id);

        $data['systemsetting'] = SystemSetting::first();

        if($trainingform->exists()){
            $arr_data=$trainingform->get();
            $trainingform_row = TrainingFormDetail::where('trainingid',$id)->orderBy("trainingformdetail.seq","ASC")->get();
            $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras	.id','training_detail_extras	.detail_id','training_detail_extras	.particular','training_detail_extras	.special','training_detail_extras	.space_lvl','training_detail_extras	.seq','training_detail_extras	.input_flag')->where('training_form_details.trainingid',$id)->orderBy("training_detail_extras.seq","ASC")->get();
            $companysetting = CompanySetting::where("b_default","Y")->get()->first();
            $companyid=$companysetting->id;

            view()->share('data',$arr_data);
            view()->share('training_forms',$trainingform);
            view()->share('trainingform_row',$trainingform_row);
            view()->share('detailextra',$detailextra);
            view()->share('compid',$companyid);
            view()->share('request',$request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('training_forms.trainingformpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);


            return $pdf->stream();
        } else {
            return view('report.norecord');
            //abort('404');
        }
    }
}
