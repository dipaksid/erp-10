<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Models\Gstrate as GstModel;
use App\Http\Requests\StoreSystemSettingRequest;
use Carbon\Carbon;

class SystemSettingsController extends Controller
{
    /**
     * Index method for the SystemSettingsController.
     *
     * This method retrieves all system settings and GST (Goods and Services Tax) data from the database
     * and passes them to the 'system_settings.index' view for rendering.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $systemSettings = SystemSetting::first();
        $gst = GstModel::get();

        return view('system_settings.index',compact('systemSettings','gst'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(StoreSystemSettingRequest $request, SystemSetting $systemSetting)
    {
        $validatedData = $request->validated();
        $postData      = $this->preparePostData($validatedData, $request);
        //dd($postData, $request->all());
        if(isset($systemSetting) && $systemSetting->exists()) {
            $systemSetting->update($postData);
        }else {
            SystemSetting::create($postData);
        }
        GstModel::truncate();
        if(isset($request['d_effectivedate_from'])){
            foreach($request['d_effectivedate_from'] as $key => $value){
                $gstrate = new GstModel();
                $effective_from1 = $value;
                $effective_from = Carbon::createFromFormat('d/m/Y', $effective_from1)->format('Y-m-d');
                $effective_to1 = $request['d_effectivedate_to'][$key];
                $effective_to = Carbon::createFromFormat('d/m/Y', $effective_to1)->format('Y-m-d');
                $rate = $request['d_rate'][$key];
                $gstrate->rate = $rate;
                $gstrate->effectivedate_from = $effective_from;
                $gstrate->effectivedate_to = $effective_to;
                $gstrate->status = 1;
                $gstrate->save();
            }
        }

        return redirect('/system_settings')->with('success', 'System setting updated!');
    }
    protected function preparePostData($validatedData, $request)
    {
        return array(
            'jobrefreshtime' => $validatedData['jobrefreshtime'] ?? '',
            'softwareservicerefreshtime' => $validatedData['softwareservicerefreshtime'] ?? 0,
            'jobnotifyday' => $validatedData['jobnotifyday'] ?? '',
            'srvchgsendnotify' => $validatedData['srvchgsendnotify'] ?? '',
            'allinvdvylh' => $validatedData['allinvdvylh'] ?? '',
            'allcnlh' => $validatedData['allcnlh'] ?? '',
            'emailsender' => $validatedData['emailsender'] ?? '',
            'invoiceprinter' => $validatedData['invoiceprinter'] ?? '',
            'poprinter' => $validatedData['poprinter'] ?? '',
            'receiptprinter' => $validatedData['receiptprinter'] ?? '',
            'paymentprinter' => $validatedData['paymentprinter'] ?? '',
            'creditnoteprinter' => $validatedData['creditnoteprinter'] ?? '',
            'stickerprinter' => $validatedData['stickerprinter'] ?? '',
            'reportprinter' => $validatedData['reportprinter'] ?? '',
            'uploadfilelimit' => $validatedData['uploadfilelimit'] ?? $request->get('uploadfilelimit'),
            'sms_username' => $request->get('sms_username') ?? '',
            'sms_password' => $request->get('sms_password') ?? '',
            'sms_company_name' => $request->get('sms_company_name') ?? '',
            'sms_active' => $request->get('sms_actives') ?? '',
            'sms_content' => $request->get('sms_content') ?? '',
            'opening_year' => $validatedData['opening_year'] ?? $request->get('opening_year'),
            'upload_photo_limit' => $validatedData['upload_photo_limit'] ?? $request->get('upload_photo_limit'),
            'allow_gst' => $validatedData['allow_gst'] ?? '',
            'gst_calculate_total' => $validatedData['gst_calculate_total'] ?? '',
            'paginate_page' => $validatedData['paginate_page'] ?? 1,
        );
    }
}
