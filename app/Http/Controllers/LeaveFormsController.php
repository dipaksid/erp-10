<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\LeaveForm;
use App\Models\User;
use App\Models\Staff;
use App\Models\SystemSetting;
use App\Http\Requests\StoreLeaveFormRequest;
use App\Http\Requests\UpdateLeaveFormRequest;
use App\Bwlibs\FileDocManage;
use App\Bwlibs\Printfile;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use TCPDF;
class LeaveFormsController extends Controller
{
    const ITEMS_PER_PAGE = 15;
    public function index(Request $request)
    {
        $getUsername = Auth::user()->name;
        $isAdmin = Auth::user()->hasRole('ADMINISTRATOR');
        $query = LeaveForm::query();

        if ($request->has('searchvalue')) {
            $searchValue = $request->input('searchvalue');
            if ($isAdmin) {
                $query->forAdmin($searchValue);
            } else {
                $query->forUser($getUsername, $searchValue);
            }
        } elseif (!$isAdmin) {
            $query->forUser($getUsername, '');
        }

        $leaveform = $query->paginate(self::ITEMS_PER_PAGE);
        $input = $request->all();

        return view('leave_forms.index', compact('leaveform', 'input'));
    }

    public function leaveformpdf($id,Request $request){
        $condsql=""; $arrfilter=array(); $acust=array();

        $leaveform = LeaveForm::find($id);

        $data['systemsetting'] = SystemSetting::first();

        if($leaveform->exists()){
            $arr_data=$leaveform->get();
            //  $evaluationform_row = EvaluationFormDetail::where('evaluation_id',$id)->orderBy("evaluationdetail.seq","ASC")->get();
            //  $detailextra = TrainingForm::trainingdetailextralist()->select('trainingdetail_extra.id','trainingdetail_extra.detail_id','trainingdetail_extra.particular','trainingdetail_extra.special','trainingdetail_extra.space_lvl','trainingdetail_extra.seq','trainingdetail_extra.input_flag')->where('trainingformdetail.trainingid',$id)->orderBy("trainingdetail_extra.seq","ASC")->get();
            $companysetting = CompanySetting::where("b_default","Y")->get()->first();
            $getapply_user = Staff::where('name',$leaveform->staff_name)->first();
            if($getapply_user){
                $companyid=$getapply_user->comp_id;
            } else {
                $companyid=$companysetting->id;
            }

            $date_now = $request->session()->get('login_date');
            view()->share('data',$arr_data);
            view()->share('leaveform',$leaveform);
            view()->share('compid',$companyid);
            view()->share('date_now',$date_now);
            view()->share('request',$request);

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('leave_forms.leaveformpdf');
            $pdf->getDomPDF()->set_option("enable_php", true);


            return $pdf->stream();
        } else {
            return view('report.norecord');
            //abort('404');
        }
    }

    /**
     * Display the form to create a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $viewData = [
            'userStaffInfo' => User::userStaffInfo(Auth::user()->id)->first(),
            'loggedInUserName' => Auth::user()->name,
            'systemSetting' => SystemSetting::first(),
        ];

        return view('leave_forms.create', compact('viewData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreLeaveFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaveFormRequest $request)
    {
        $doc_no = $this->generateDocumentNumber();

        $user = User::userStaffInfo(Auth::user()->id)->first();

        $carbonDate = Carbon::parse($request->session()->get('login_date'));

        $data = [
            'doc_no' => $doc_no,
            'staffid' => $user->id,
            'staff_name' => $user->name,
            'designation' => $request->input('designation'),
            'leave_typ' => $request->input('leave_typ'),
            'leave_duration' => $request->input('leave_duration'),
            'leave_dat_frm' => $request->input('leave_dat_frm'),
            'leave_dat_to' => $request->input('leave_dat_to'),
            'leave_reason' => $request->input('leave_reason'),
            'applied_dat' => $carbonDate->format('d/m/Y'),
            'status' => 2,
            'approved_by' => '',
            'approved_dat' => '',
            'applied_by' => Auth::user()->name,
        ];

        $leaveform = LeaveForm::create($data);

        if ($request->hasFile('upload_file')) {

            $this->uploadFiles($request->file('upload_file'), $doc_no);
        }

        return redirect('/leaveform')->with('success', 'New Leave Form ' . $leaveform->doc_no . ' For (' . $leaveform->staff_name . ') has been created!');
    }

    /**
     * Generate a unique document number for LeaveForm.
     *
     * @return string
     */
    private function generateDocumentNumber()
    {
        $latestDoc = LeaveForm::max('doc_no');
        $sequence = intval(substr($latestDoc, 2)) + 1;

        return 'LF' . sprintf("%08d", $sequence);
    }

    /**
     * Upload files associated with the leave form.
     *
     * @param  array|null  $files
     * @param  string  $doc_no
     * @return void
     */
    private function uploadFiles($files, $doc_no)
    {
        $destinationPath = public_path("/leave_form/$doc_no");
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  LeaveForm $leaveform The LeaveForm model instance resolved by model binding.
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveForm $leaveform)
    {
        $data['systemsetting'] = SystemSetting::first();

        return view('leave_forms.show', compact('leaveform', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LeaveForm  $leaveform
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveForm $leaveform)
    {
        $systemSetting = SystemSetting::first();

        return view('leave_forms.edit', compact('leaveform', 'systemSetting'));
    }

    public function update(UpdateLeaveFormRequest $request, $id)
    {
        $leaveform = LeaveForm::findOrFail($id);
        $data = $this->prepareData($leaveform, $request);
        $carbonDate = Carbon::parse($request->session()->get('approved_dat'));
        $data['approved_dat'] = $carbonDate->format('d/m/Y');
        $leaveform->fill($data)->save();

        if ($request->hasFile('upload_file')) {
            $this->handleFileUploads($request->file('upload_file'), $leaveform->doc_no);
        }

        $status = $request['status'];
        if ($status == 1) {
            $this->handleStatusOne($leaveform, $request);
        } elseif ($status == 2 || $status == 0) {
            $this->handleStatusTwoOrZero($leaveform);
        }

        return redirect('/leaveform')->with('success', 'Leave Form '. $leaveform->doc_no.' for ('. $leaveform->staff_name .') has been updated!!');
    }

    protected function prepareData($leaveform, $request)
    {
        $status = $request['status'];

        $data = [
            'leave_typ' => $request['leave_typ'],
            'staff_name' => $request['staff_name'],
            'designation' => $request['designation'],
            'leave_duration' => $request['leave_duration'],
            'leave_dat_frm' => $request['leave_dat_frm'],
            'leave_dat_to' => $request['leave_dat_to'],
            'leave_reason' => $request['leave_reason'],
            'status' => $status,
        ];

        if ($status != 2) {
            $data['approved_by'] = Auth::user()->name;
            $data['approved_dat'] = $request->session()->get('login_date');
        } else {
            $data['approved_by'] = '';
            $data['approved_dat'] = '';
        }
        $data['systemsetting'] = SystemSetting::first();

        return $data;
    }

    protected function handleStatusOne(LeaveForm $leaveform, $request)
    {
        $companysetting = CompanySetting::where("b_default", "Y")->first();
        $getapply_user = Staff::where('name', $leaveform->staff_name)->first();
        $companyid = $getapply_user ? $getapply_user->comp_id : $companysetting->id;
        $date_now = $request->session()->get('login_date');
        $doc_no = $leaveform->doc_no;
        $imageDir = public_path('leave_form/' . $doc_no);
        $images = [];
        $pdffile = [];

        if (is_dir($imageDir)) {
            foreach (scandir($imageDir) as $path) {
                $pathexts = pathinfo($path);
                $ext = $pathexts["extension"];
                if (!is_dir($imageDir . '/' . $path)) {
                    if (in_array($ext, array("jpg", "jpeg", "png", "gif"))) {
                        $images[] = $path;
                    } elseif (in_array($ext, array("pdf"))) {
                        $pdffile[] = $imageDir . '/' . $path;
                    }
                }
            }
        }

        $pdfOptions = new Options();
        $pdfOptions->set('dpi', 150);
        $pdfOptions->set('defaultFont', 'sans-serif');
        $dompdf = new Dompdf($pdfOptions);

        // Render the Blade template into HTML content
        $viewHtml = View::make('leave_forms.leaveformpdf2', [
            'data' => $leaveform->toArray(),
            'leaveform' => $leaveform,
            'compid' => $companyid,
            'date_now' => $date_now,
            'request' => $request
        ])->render();

        $dompdf->loadHtml($viewHtml);
        $dompdf->set_option("isHtml5ParserEnabled", true);
        $dompdf->set_option("isPhpEnabled", true);
        $dompdf->render();
        $pdfContent = $dompdf->output();

        $pdfPath = public_path() . '/pdf/lf_' . $leaveform->id . '_2.pdf';
        file_put_contents($pdfPath, $pdfContent);

        // Rest of your code...
        if (count($images) > 0 || count($pdffile) > 0) {
            $mergepdfs = PDFMerger::init();
            $pdfFile1Paths = public_path() . '/pdf/lf_' . $leaveform->id . '.pdf';
            $mergepdfs->addPDF($pdfFile1Paths, 'all');

            if (count($pdffile) > 0) {
                foreach ($pdffile as $rpdffl) {
                    $mergepdfs->addPDF($rpdffl, 'all');
                }
            }

            if (count($images) > 0) {
                $dompdf2 = new Dompdf($pdfOptions);
                $viewHtml2 = View::make('leave_forms.leaveformpdf2', [
                    'leaveform' => $leaveform,
                    'compid' => $companyid,
                    'imgs' => $images
                ])->render();

                $dompdf2->loadHtml($viewHtml2);
                $dompdf2->set_option("isHtml5ParserEnabled", true);
                $dompdf2->set_option("isPhpEnabled", true);
                $dompdf2->render();

                $pdfFile2Path = public_path() . '/pdf/lf_' . $leaveform->id . '_2.pdf';
                file_put_contents($pdfFile2Path, $dompdf2->output());

                $mergepdfs->addPDF($pdfFile2Path, 'all');
            }

            $pathForTheMergedPdfs = public_path() . '/pdf/lf_' . $leaveform->id . '.pdf';
            $mergepdfs->merge();
            $mergepdfs->save($pathForTheMergedPdfs);
        }

        $filedocmanage = new FileDocManage();
        $filedocmanage->savefile("LF", $leaveform->id, false, false, "", "", url("pdf/lf_" . $leaveform->id . ".pdf"));
    }

    protected function handleStatusTwoOrZero($leaveform)
    {
        $storagepath = storage_path('app/acct'); // Using 'local' disk path
        $staff = Staff::find($leaveform->staffid);
        $companysetting = CompanySetting::find($staff->comp_id);
        $year = substr($leaveform->leave_dat_frm, 6, 4);
        $yearmonth = substr($leaveform->leave_dat_frm, 6, 4) . substr($leaveform->leave_dat_frm, 3, 2);
        $storagepath1 = "";
        $filedocmanage = new FileDocManage();

        if (!$filedocmanage->getreadypath("LF", $storagepath, $storagepath1, $year, $yearmonth, "", $leaveform->staff_name)) {
            // Handle the case when getreadypath fails
        }

        $filename = "LF" . substr($leaveform->leave_dat_frm, 6, 4) . substr($leaveform->leave_dat_frm, 3, 2) . substr($leaveform->leave_dat_frm, 0, 2);
        $leaveformpdffile = $storagepath . "/" . $companysetting->companycode . $filename . ".pdf";

        @unlink($leaveformpdffile);
    }

    protected function handleFileUploads($files, $doc_no)
    {
        $destinationPath = public_path("leave_form/{$doc_no}");

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move($destinationPath, $name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LeaveForm  $leaveform
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveForm $leaveform)
    {
        $docNo = $leaveform->doc_no;
        $leaveform->delete();

        return redirect('/leaveform')->with('success', "Leave Form ($docNo) has been deleted!!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  use Illuminate\Http\Request $request
     * @return Array
     */
    public function docdelete(Request $request)
    {
        $docname = $request->input('docname');
        $docno = $request->input('docno');
        $docFolderPath = public_path("leave_form/{$docno}");
        if (file_exists($docFolderPath)) {
            $docFilePath = "{$docFolderPath}/{$docname}";
            if (file_exists($docFilePath)) {
                unlink($docFilePath);
            }
            $remainingFiles = [];
            foreach (scandir($docFolderPath) as $file) {
                if (is_file("{$docFolderPath}/{$file}")) {
                    $remainingFiles[] = $file;
                }
            }
            $fileData = [];
            foreach ($remainingFiles as $index => $filename) {
                $fileData[] = [
                    'id' => $index + 1,
                    'docno' => $docno,
                    'filename' => $filename,
                ];
            }
            return ['filedata' => $fileData];
        }
        return ['filedata' => []];
    }
}
