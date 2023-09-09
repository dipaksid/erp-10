<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluationFormRequest;
use App\Http\Requests\UpdateEvaluationFormRequest;
use App\Models\CustomerCategory;
use App\Models\EvaluationDetail;
use App\Models\EvaluationForm;
use App\Models\SystemSetting;
use App\Models\CompanySetting;
use App\Models\TrainingForm;
use App\Models\TrainingFormDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use TCPDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use File;
use Storage;
use App\Bwlibs\FileDocManage;
use App\Bwlibs\Printfile;

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
    public function store(StoreEvaluationFormRequest $request)
    {
        // Create a new EvaluationForm instance and populate it with validated data
        $evaluationform = new EvaluationForm([
            'form_title' => $request->input('form_title'),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        // Save the EvaluationForm instance
        $evaluationform->save();

        $evaluation_id = $evaluationform->id;

        // Process and save EvaluationDetail records
        if ($request->has('d_description')) {
            $maxSeq = EvaluationDetail::where('evaluation_id', $evaluation_id)
                ->max('seq') ?? 0;

            foreach ($request->input('d_description') as $key => $par) {
                $data2 = [
                    'evaluation_id' => $evaluation_id,
                    'form_title' => $request->input('d_subject_title')[$key],
                    'form_detail' => $par,
                    'max_rating' => $request->input('d_max_rating')[$key],
                    'seq' => ++$maxSeq,
                ];

                // Create and save EvaluationDetail instance
                $evaluation_detail = EvaluationDetail::create($data2);
                $detail_id = $evaluation_detail->id;
            }
        }

        return redirect('/evaluation-forms')->with('success', 'New Evaluation form (' . $request->input('form_title') . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\EvaluationForm $evaluationform
     * @return \Illuminate\Contracts\View\View
     */
    public function show(EvaluationForm $evaluation_form)
    {
        $data = $this->getData($evaluation_form->id);

        return view('evaluation_forms.show', compact('evaluation_form', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\EvaluationForm $evaluationform
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EvaluationForm $evaluation_form)
    {
        $data = $this->getData($evaluation_form->id);

        return view('evaluation_forms.edit', compact('evaluation_form','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateEvaluationFormRequest $request
     * @param App\Models\EvaluationForm $evaluation_form
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEvaluationFormRequest $request, EvaluationForm $evaluation_form)
    {
        // Update EvaluationForm data
        $evaluation_form->form_title = $request->input('form_title');
        $evaluation_form->status = $request->has('status') ? 1 : 0;
        $evaluation_form->save();

        $details = array();
        foreach($request['d_id'] as $ikey => $pid){
            if($pid != 0){
                $details[] = $pid;
            }
        }

        TrainingFormDetail::where('trainingid', $evaluation_form->id)
                                    ->whereNotIn('id', $details)
                                    ->delete();

        foreach ($request->input('d_id') as $key => $detailId) {
            $data2 = [
                'evaluation_id' => $evaluation_form->id,
                'form_title' => $request->input('d_subject_title')[$key],
                'form_detail' => $request->input('d_description')[$key],
                'max_rating' => $request->input('d_max_rating')[$key],
                'seq' => $key + 1,
            ];

            if ($detailId) {
                $evaluationDetail = EvaluationDetail::find($detailId);

                if ($evaluationDetail) {
                    $evaluationDetail->updateEvaluationDetail($data2);
                }
            } else {
                $evaluationDetail = new EvaluationDetail();
                $evaluationDetail->saveEvaluationDetail($data2);
            }
        }

        return redirect('/evaluation-forms')->with('success', 'Evaluation Form (' . $evaluation_form->form_title . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\EvaluationForm $evaluation_form
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EvaluationForm $evaluation_form)
    {
        $evaluation_title = $evaluation_form->form_title;
        $evaluation_form->delete();

        return redirect('/evaluation-forms')->with('success', 'Evaluation Form ('.$evaluation_title.') has been deleted!!');
    }
    public function getData($evaluation_id){
        $data['customercategory'] = CustomerCategory::where('stockcatgid', 1)->get();
        $data['evaluationdetail'] = EvaluationDetail::where('evaluation_details.evaluation_id',$evaluation_id)->orderBy("evaluation_details.seq","ASC")->get();

        return $data;
    }

    public function sort(Request $request, $id)
    {
        $trainingForm = TrainingForm::findOrFail($id);

        $trainingForm->load(['trainingformdetaillist', 'trainingdetailextralist']);

        $data['customercategory'] = CustomerCategory::where('stockcatgid', 1)->get();

        return view('trainingform.sort', [
            'trainingForm' => $trainingForm,
            'data' => $data,
        ]);
    }

    public function evaluationformList(Request $request){
        $evaluation_id = $request['id'];
        $evaluationdetailseq = EvaluationDetail::where('evaluation_details.evaluation_id',$evaluation_id)
                                        ->orderBy("evaluation_details.seq","ASC");

        $arr_return["datalist"] = $evaluationdetailseq->get();
        $arr_return["msg"] = "success";

        return $arr_return;
    }
    public function evaluationformpdf($id, Request $request)
    {
        $cellspacingx = 10;
        $evaluationform = EvaluationForm::find($id);

        if (!$evaluationform) {
            return view('report.norecord');
        }

        $systemsetting = SystemSetting::first();

        $evaluationform_row = EvaluationDetail::where('evaluation_id', $id)
            ->orderBy("seq", "ASC")
            ->get();

        $companysetting = CompanySetting::where("b_default", "Y")->first();
        $companyid = $companysetting->id;

        // Share data with the view
        View::share('data', $evaluationform);
        View::share('evaluationform', $evaluationform);
        View::share('evaluationform_row', $evaluationform_row);
        View::share('compid', $companyid);
        View::share('request', $request);
        View::share('systemsetting', $systemsetting);

        // Load the view into a variable
        $html = View::make('evaluation_forms.evaluationformpdf', ['cellspacingx' => $cellspacingx])->render();

        // Generate the PDF using Dompdf
        $pdf = PDF::loadHTML($html);

        // Stream the PDF to the browser
        return $pdf->stream('evaluationform.pdf');
    }

    public function updseq(Request $request)
    {
        $arr_return = [];

        if ($request->has(["fromseq", "toseq"])) {
            $training_id = $request->input("id");
            $fromSeq = $request->input("fromseq");
            $toSeq = $request->input("toseq");
            if ($fromSeq != $toSeq) {
                DB::transaction(function () use ($training_id, $fromSeq, $toSeq, &$arr_return) {
                    // Handle the case when fromSeq is greater than toSeq
                    if ($fromSeq > $toSeq) {
                        $seqDirection = -1;
                    } else {
                        $seqDirection = 1;
                    }
                    $trainingDetails = TrainingFormDetail::where('trainingid', $training_id)
                        ->whereBetween("seq", [$fromSeq, $toSeq])
                        ->orderBy("seq")
                        ->get();

                    foreach ($trainingDetails as $trainingDetail) {
                        $newSeq = $trainingDetail->seq + $seqDirection;

                        if ($trainingDetail->seq == $fromSeq) {
                            $newSeq = $toSeq;
                        }

                        $trainingDetail->update(['seq' => $newSeq]);
                    }
                });
                $trainingDetailSeq = TrainingForm::trainingformdetaillist()
                    ->select('trainingformdetail.id', 'trainingformdetail.trainingid', 'trainingformdetail.no', 'trainingformdetail.particular', 'trainingformdetail.special', 'trainingformdetail.space_lvl', 'trainingformdetail.seq')
                    ->where('trainingformdetail.trainingid', $training_id)
                    ->orderBy("trainingformdetail.seq", "ASC")
                    ->get();
                $detailextra = TrainingForm::trainingdetailextralist()
                    ->select('trainingdetail_extra.id', 'trainingdetail_extra.detail_id', 'trainingdetail_extra.particular', 'trainingdetail_extra.special', 'trainingdetail_extra.space_lvl', 'trainingdetail_extra.seq')
                    ->where('trainingformdetail.trainingid', $training_id)
                    ->get();
                $arr_return["datalist"] = $trainingDetailSeq;
                $arr_return["sublist"] = $detailextra;
                $arr_return["msg"] = "success";
            } else {
                $arr_return["msg"] = "FromSeq and ToSeq must be different.";
            }
        } else {
            $arr_return["msg"] = "fromseq and toseq are required.";
        }
        return $arr_return;
    }
}
