<?php

namespace App\Http\Controllers;

use App\Models\CustomerCategory;
use App\Models\EvaluationDetail;
use App\Models\EvaluationForm;
use Illuminate\Http\Request;

class EvaluationFormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $evaluation = EvaluationForm::search($searchValue)->paginate(15);
        $evaluation->withPath('?searchvalue=' . ($searchValue ?: ''));

        return view('evaluation_forms.index', compact('evaluation', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('evaluation_forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EvaluationForm $evaluationform)
    {
        $data['customercategory'] = CustomerCategory::where('stockcatgid', 1)->get();

        return view('evaluation_forms.show', compact('evaluationform', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function evaluationformpdf($id,Request $request){
        $condsql=""; $arrfilter=array(); $acust=array();

        $evaluationform = EvaluationForm::find($id);

        $data['systemsetting'] = SystemSetting::first();

        if($evaluationform->exists()){
            $arr_data=$evaluationform->get();
            $evaluationform_row = EvaluationFormDetail::where('evaluation_id',$id)->orderBy("evaluationdetail.seq","ASC")->get();
            //  $detailextra = TrainingForm::trainingdetailextralist()->select('trainingdetail_extra.id','trainingdetail_extra.detail_id','trainingdetail_extra.particular','trainingdetail_extra.special','trainingdetail_extra.space_lvl','trainingdetail_extra.seq','trainingdetail_extra.input_flag')->where('trainingformdetail.trainingid',$id)->orderBy("trainingdetail_extra.seq","ASC")->get();
            $companysetting = CompanySetting::where("b_default","Y")->get()->first();
            $companyid=$companysetting->id;

            view()->share('data',$arr_data);
            view()->share('evaluationform',$evaluationform);
            view()->share('evaluationform_row',$evaluationform_row);
            view()->share('compid',$companyid);
            view()->share('request',$request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('evaluationform.evaluationformpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);


            return $pdf->stream();
        } else {
            return view('report.norecord');
            //abort('404');
        }
    }

    public function evaluationformList(Request $request){
        $evaluation_id = $request['id'];
        $evaluationdetailseq = EvaluationFormDetail::where('evaluationdetail.evaluation_id',$evaluation_id)
            ->orderBy("evaluationdetail.seq","ASC");
        $arr_return["datalist"]=$evaluationdetailseq->get();
        //  $detailextra = TrainingForm::trainingdetailextralist()->select('trainingdetail_extra.id','trainingdetail_extra.detail_id','trainingdetail_extra.particular','trainingdetail_extra.special','trainingdetail_extra.space_lvl','trainingdetail_extra.seq','trainingdetail_extra.input_flag')->where('trainingformdetail.trainingid',$training_id)->get();
        //  $arr_return["sublist"] = $detailextra;
        $arr_return["msg"] = "success";

        return $arr_return;
    }
}
