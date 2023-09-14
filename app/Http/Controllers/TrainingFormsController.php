<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingFormRequest;
use App\Http\Requests\UpdateTrainingFormRequest;
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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use File;
use Ramsey\Uuid\Type\Integer;
use Storage;

class TrainingFormsController extends Controller
{
    const  ITEM_PER_PAGES = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');
        $training = TrainingForm::searchBySystemcodOrTitle($searchValue)->paginate(self::ITEM_PER_PAGES);
        $training->appends(['searchvalue' => $searchValue]);

        return view('trainingform.index', compact('training', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();

        return view('trainingform.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingFormRequest $request)
    {
        $data = $request->validated();

        $trainingForm = TrainingForm::create([
            'systemcod' => $data['systemcod'],
            'form_title' => $request->input('form_title'),
        ]);
        $trainingFormId = $trainingForm->id;

        if ($request->has('d_description')) {
            foreach ($request->input('d_description') as $key => $par) {
                $trainingDetail = new TrainingFormDetail();
                $data2 = [
                    'trainingid' => $trainingFormId,
                    'no' => $request->input('no')[$key],
                    'particular' => $par,
                    'special' => $request->input('d_specialfield')[$key],
                    'space_lvl' => $request->input('d_spacefield')[$key],
                    'input_flag' => $request->input('d_input_flag')[$key],
                ];
                $getMax = TrainingForm::trainingformdetaillist()->select('training_form_details.seq')->where('training_form_details.trainingid', $trainingFormId)->orderBy('training_form_details.seq', 'DESC')->first();
                $getSeq = $getMax ? $getMax->seq + 1 : 1;
                $data2['seq'] = $getSeq;
                $trainingDetail->saveTrainingFormDetail($data2);
                $detailId = $trainingDetail->id;

                if (!empty($request->input('d_description_detail')[$key])) {
                    foreach ($request->input('d_description_detail')[$key] as $dKey => $detail) {
                        $trainingDetailExtra = new TrainingFormDetailExtra();
                        $data3 = [
                            'detail_id' => $detailId,
                            'particular' => $detail,
                            'special' => $request->input('d_special_field_details')[$key][$dKey],
                            'space_lvl' => $request->input('d_space_field_details')[$key][$dKey],
                            'input_flag' => $request->input('d_input_flags')[$key][$dKey],
                        ];
                        $getMax2 = TrainingFormDetailExtra::where('trainingdetail_extra.detail_id', $detailId)->orderBy('trainingdetail_extra.seq', 'DESC')->first();
                        $getSeq2 = $getMax2 ? $getMax2->seq + 1 : 1;
                        $data3['seq'] = $getSeq2;
                        $trainingDetailExtra->saveTrainingDetailExtra($data3);
                    }
                }
            }
        }

        return redirect('/trainingform')->with('success', 'New Training form for system ('.$data['systemcod'].') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingForm  $trainingForm
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingForm $trainingform)
    {
        $data['customercategory'] = CustomerCategory::where('stockcatgid', 1)->get();

        $trainingdetail = $trainingform->trainingDetails()
            ->select('id', 'trainingid', 'no', 'particular', 'special', 'space_lvl', 'seq', 'input_flag')
            ->orderBy("seq", "ASC")
            ->get();

        $detailextra = $trainingform->trainingDetailExtras()
            ->select('training_detail_extras.id', 'training_detail_extras.detail_id', 'training_detail_extras.particular', 'training_detail_extras.special', 'training_detail_extras.space_lvl', 'training_detail_extras.seq', 'training_detail_extras.input_flag')
            ->orderBy("training_detail_extras.seq", "ASC")
            ->get();

        return view('trainingform.show', compact('trainingform', 'trainingdetail', 'data', 'detailextra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TrainingForm $trainingform
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TrainingForm $trainingform)
    {
        $data['customercategory'] = CustomerCategory::where('stockcatgid', 1)->get();
        $trainingdetail = $trainingform
            ->trainingformdetaillist()
            ->select('training_form_details.id', 'training_form_details.trainingid', 'training_form_details.no', 'training_form_details.particular', 'training_form_details.special', 'training_form_details.space_lvl', 'training_form_details.seq', 'training_form_details.input_flag')
            ->orderBy("training_form_details.seq", "ASC")
            ->get();

        $detailextra = $trainingform
            ->trainingdetailextralist()
            ->select('training_detail_extras.id', 'training_detail_extras.detail_id', 'training_detail_extras.particular', 'training_detail_extras.special', 'training_detail_extras.space_lvl', 'training_detail_extras.seq', 'training_detail_extras.input_flag')
            ->orderBy("training_detail_extras.seq", "ASC")
            ->get();

        return view('trainingform.edit', compact('trainingform', 'trainingdetail', 'data', 'detailextra'));
    }


    /**
     * Show the form for sorted the specified resource.
     *
     * @param Request $request
     * @param  App\Models\TrainingForm $trainingform
     * @return \Illuminate\Contracts\View\View
     */
    public function sort(Request $request, TrainingForm $trainingform)
    {
        $training_id = $trainingform->id;

        $data['customercategory'] = CustomerCategory::where('stockcatgid',1)->get();
        $trainingdetail = TrainingForm::trainingformdetaillist()
                        ->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq')
                        ->where('training_form_details.trainingid',$training_id)
                        ->orderBy("training_form_details.seq","ASC")->get();

        $detailextra = TrainingForm::trainingdetailextralist()
                    ->select('training_detail_extras.id','training_detail_extras.detail_id','training_detail_extras.particular','training_detail_extras.special','training_detail_extras.space_lvl','training_detail_extras.seq')
                    ->where('training_form_details.trainingid',$training_id)->get();

        return view('trainingform.sort', compact('trainingform','trainingdetail','data','detailextra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateTrainingFormRequest $request
     * @param App\Models\TrainingForm $trainingform
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainingFormRequest $request, TrainingForm $trainingform)
    {
        $data = $request->validated();

        $data['id'] = $trainingform->id;
        $data['systemcod'] = $request->input('systemcod');
        $data['form_title'] = $request->input('form_title');

        $trainingform->updateTrainingForm($data);
        $training_form_id = $trainingform->id;

        $details = $request->input('d_id');
        $details2 = [];

        foreach ($details as $ikey => $pid) {
            if ($pid != 0) {
                $details2 = array_merge($details2, $request->input("d_detail_id.$ikey", []));
            }
        }

        TrainingFormDetail::where('trainingid', $training_form_id)->whereNotIn('id', $details)->delete();

        if (!empty($details2)) {
            TrainingFormDetailExtra::trainingdetaillist()
                ->where('trainingformdetail.trainingid', $training_form_id)
                ->whereNotIn('trainingdetail_extra.id', $details2)
                ->delete();
        }

        $seq = 0;

        foreach ($request->input('d_description') as $key => $par) {
            $seq++;
            $detailid = $request->input("d_id.$key");
            $special_main = $request->boolean("d_specialfields.$key") ? "1" : "0";
            $space_main = $request->boolean("d_spacefields.$key") ? "1" : "0";
            $input_main = $request->boolean("d_input_flags.$key") ? "1" : "0";

            $data2 = [
                'id' => $detailid,
                'trainingid' => $training_form_id,
                'no' => $request->input("no.$key"),
                'particular' => $par,
                'special' => $special_main,
                'space_lvl' => $space_main,
                'seq' => $seq,
                'input_flag' => $input_main,
            ];

            $training_detail = $trainingform->updateOrInsertTrainingDetail($detailid, $data2);
            $detail_id = $training_detail->id;

            $subseq = 0;

            if (!empty($request->input("d_description_detail.$key"))) {
                foreach ($request->input("d_description_detail.$key") as $dkey => $detail) {
                    $subseq++;
                    $special_sub = $request->boolean("d_detail_specialfield.$key.$dkey") ? "1" : "0";
                    $space_sub = $request->boolean("d_detail_spacefield.$key.$dkey") ? "1" : "0";
                    $input_sub = $request->boolean("d_detail_input_flags.$key.$dkey") ? "1" : "0";
                    $extraid = $request->input("d_detail_id.$key.$dkey");

                    $data3 = [
                        'detail_id' => $detail_id,
                        'id' => $extraid,
                        'particular' => $detail,
                        'special' => $special_sub,
                        'space_lvl' => $space_sub,
                        'seq' => $subseq,
                        'input_flag' => $input_sub,
                    ];

                    $training_detail_extra = $trainingform->updateOrInsertTrainingDetailExtra($extraid, $data3);
                }
            }
        }

        return redirect('/trainingform')->with('success', 'Training form for system (' . $trainingform->systemcod . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingForm $trainingform
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(TrainingForm $trainingform)
    {
        $trainingcode = $trainingform->systemcod;
        $trainingform->trainingDetails()->delete();
        $trainingform->delete();

        return redirect('/trainingform')->with('success', 'Training form for System (' . $trainingcode . ') has been deleted!');
    }

    public function detailList(Request $request){
        $detail_id = $request['id'];
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras.id','training_detail_extras.detail_id','training_detail_extras.particular','training_detail_extras.special','training_detail_extras.space_lvl','training_detail_extras.seq','training_detail_extras.input_flag')->where('training_detail_extras.detail_id',$detail_id)->orderBy("seq")->get();

        $arr_return["datalist"] = $detailextra;
        $arr_return["msg"] = "success";

        return $arr_return;
    }
    public function trainingformList(Request $request){
        $training_id = $request['id'];
        $trainingdetailseq = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq','training_form_details.input_flag')->where('training_form_details.trainingid',$training_id)
            ->orderBy("training_form_details.seq","ASC");
        $arr_return["datalist"]=$trainingdetailseq->get();
        $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras.id','training_detail_extras.detail_id','training_detail_extras.particular','training_detail_extras.special','training_detail_extras.space_lvl','training_detail_extras.seq','training_detail_extras.input_flag')->where('training_form_details.trainingid',$training_id)->get();
        $arr_return["sublist"] = $detailextra;
        $arr_return["msg"] = "success";

        return $arr_return;
    }
    public function updseq(Request $request){
        $training_id = $request['id'];
        if($request->has("fromseq") && $request->has("toseq")){
            if($request->input("fromseq")>$request->input("toseq")) {
                $trainingdetail = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq')->where('training_form_details.trainingid',$training_id)->where("seq",">=",$request->input("toseq"))->where("seq","<=",$request->input("fromseq"))->orderBy("seq");
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
            $trainingdetailseq = TrainingForm::trainingformdetaillist()->select('training_form_details.id','training_form_details.trainingid','training_form_details.no','training_form_details.particular','training_form_details.special','training_form_details.space_lvl','training_form_details.seq')->where('training_form_details.trainingid',$training_id)
                ->orderBy("training_form_details.seq","ASC");
            $arr_return["datalist"]=$trainingdetailseq->get();
            $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras.id','training_detail_extras.detail_id','training_detail_extras.particular','training_detail_extras.special','training_detail_extras.space_lvl','training_detail_extras.seq')->where('training_form_details.trainingid',$training_id)->get();
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

            $detailextra = TrainingForm::trainingdetailextralist()->select('training_detail_extras.id','training_detail_extras.detail_id','training_detail_extras.particular','training_detail_extras.special','training_detail_extras.space_lvl','training_detail_extras.seq')->where('training_detail_extras.detail_id',$training_id)->orderBy("training_detail_extras.seq","ASC")->get();
            $arr_return["datalist"] = $detailextra;
            $arr_return["msg"] = "success";
        } else {
            $arr_return["msg"] = "error";
        }
        return $arr_return;
    }

    /**
     * Generate and display the PDF for a training form.
     *
     * @param  Integer $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trainingformpdf($id, Request $request)
    {
        $data['systemsetting'] = SystemSetting::first();
        $trainingform = TrainingForm::findOrFail($id);

        if ($trainingform->exists()) {
            $trainingform_row = $trainingform->trainingDetails()
                ->orderBy("seq", "ASC")
                ->get();

            $detailextra = TrainingFormDetailExtra::trainingdetaillist()
                ->select('training_detail_extras.id', 'training_detail_extras.detail_id', 'training_detail_extras.particular', 'training_detail_extras.special', 'training_detail_extras.space_lvl', 'training_detail_extras.seq', 'training_detail_extras.input_flag')
                ->where('training_form_details.trainingid', $trainingform->id)
                ->orderBy("training_detail_extras.seq", "ASC")
                ->get();

            $companysetting = CompanySetting::where("b_default", "Y")->first();
            $companyid = $companysetting->id;

            view()->share('trainingform', $trainingform);
            view()->share('data', $trainingform);
            view()->share('training_forms', $trainingform);
            view()->share('trainingform_row', $trainingform_row);
            view()->share('detailextra', $detailextra);
            view()->share('compid', $companyid);
            view()->share('request', $request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

            // Load the view and render it to a variable
            $pdf = PDF::loadView('trainingform.trainingformpdf');

            return $pdf->stream();
        } else {
            return view('report.norecord');
            // Or you can return a 404 response here if desired.
            // return abort(404);
        }
    }
}
