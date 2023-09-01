<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTotalPayAppRequest;
use App\Http\Requests\UpdateTotalpayAppRequest;
use App\Models\customerGroupsCustomer;
use App\Models\Customer;
use App\Models\CustomerTotalPayApp;
use App\Models\CustomerService;
use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TotalpayAppsController extends Controller
{
    const ITEM_PER_PAGE = 15;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * Display a listing of the CustomerTotalPayApp resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $total_pay_app = CustomerTotalPayApp::searchByCodeOrName($searchValue)
                                            ->paginate(self::ITEM_PER_PAGE);
        $total_pay_app->appends(['searchvalue' => $searchValue]);

        return view('total_pay_apps.index', compact('total_pay_app', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customers = $this->dataService->fetchCustomers($request);

        return view('total_pay_apps.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTotalPayAppRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTotalPayAppRequest $request)
    {
        $data = $request->validated();
        $customer = Customer::findOrFail((int)$data['customers_id']);
        $customerservice = $customer->customerServices()->latest()->first();

        if(isset($customerservice)){
            $this->storeCustomerService($customerservice, $request);

            $totalpayapp = $this->createTotalpayApp($request, $customerservice);
            $arr_compreturn = $this->submitCompApp($totalpayapp, $customerservice->id);

            if ($arr_compreturn->status == "Success") {
                $totalpayapp->qrpdfurl = $arr_compreturn->shoppdf;
                $totalpayapp->save();
            }

            $this->handleCompanyLogoUpload($request, $customerservice->id);

            return redirect('/totalpayapp')->with('success', 'New PWS Totalpay App Service has been created!');
        }

        return redirect('/totalpayapp/create')->with('error', 'Customerservice not found!');
    }

    /**
     * Update the customer service details.
     *
     * @param CustomerService $customerservice
     * @param array $data
     * @return void
     */
    private function storeCustomerService(CustomerService $customerservice, $request)
    {
        $customerservice->vpnaddress = $request->get('vpnaddress');

        $customerservice->save();
    }

    /**
     * Create a new TotalpayApp instance.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing form data.
     * @param \App\Services\CustomerService $customerservice An instance of the CustomerService class for customer-related operations.
     * @return \App\Models\TotalpayApp The newly created TotalpayApp instance.
     */
    private function createTotalpayApp(Request $request, CustomerService $customerservice)
    {
        $totalpayapp = new CustomerTotalPayApp();
        $totalpayapp->fill([
            'customers_id' => $request->get('customers_id'),
            //'customer_services_id' => $request->get('serviceid'),
            'customer_services_id' => $customerservice->id,
            'shopname' => $request->get('shopname'),
            'contactno' => $request->get('contactno'),
            'email' => $request->get('email'),
            'slogan' => $request->get('slogan'),
            'tapiurl' => $request->get('tapiurl'),
            'apiurl' => "http://" . $customerservice->vpnaddress . "/" . $request->get('tapiurl') . "/totalpay",
            'client_id' => "TOTALPAYAPP",
            'client_secret' => "VlA0j6xGWTW5Fui3WPB5",
            'username' => $customerservice->serial_no,
            'password' => md5($customerservice->cfgpassword),
            'active' => request()->has("active") ? "1" : "0",
            'b_acpt_op' => (request()->has("b_acpt_op")) ? "1" : "0",
            'b_dealforyou' => (request()->has("b_dealforyou")) ? "1" : "0",
            'b_locate' => (request()->has("b_locate")) ? "1" : "0",
            'b_getgprc' => (request()->has("b_getgprc")) ? "1" : "0",
            'b_refer' => (request()->has("b_refer")) ? "1" : "0",
            'merchant_code' => (!empty(request()->input('merchant_code'))) ? request()->input('merchant_code') : "",
            'merchant_key' => (!empty(request()->input('merchant_key'))) ? request()->input('merchant_key') : "",
            'chrg_amt' => (!empty(request()->input('chrg_amt'))) ? request()->input('chrg_amt') : "",
            'cust_chrg_amt' => (!empty(request()->input('cust_chrg_amt'))) ? request()->input('cust_chrg_amt') : "",
            'renew_red' =>  (request()->has('renew_red') && !empty(request()->input('renew_red'))) ? request()->input('renew_red') : 0,
            'b_reduce_principle' => (request()->has("b_reduce_principle")) ? "1" : "0",
            'b_floating' => (request()->has("b_floating")) ? "1" : "0",
            'b_payslip' => (request()->has("b_payslip")) ? "1" : "0",
            'b_productimage' => request()->has("b_productimage") ? "1" : "0",
            'map_address' => request()->input("map_address"),
            'latitude' => (request()->has("latitude") && request()->input("latitude") != "") ? request()->input("latitude") : "",
            'longitude' => (request()->has("longitude") && request()->input("longitude") != "") ? request()->input("longitude") : "",
        ]);

        $totalpayapp->active = $data['active'] ?? 0;
        $totalpayapp->b_acpt_op = $data['b_acpt_op'] ?? 0;
        $totalpayapp->save();

        return $totalpayapp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  TotalpayApp  $totalpayapp
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CustomerTotalPayApp $totalpayapp)
    {
        $input = $request->all();
        $customers = $this->dataService->fetchCustomers($request);

        return view('total_pay_apps.edit', compact('totalpayapp', 'input','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTotalpayAppRequest  $request
     * @param  App\Models\CustomerTotalPayApp $totalpayapp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTotalpayAppRequest $request, CustomerTotalPayApp $totalpayapp)
    {
        $customerservice = $this->updateCustomerService($totalpayapp, $request);
        if(isset($customerservice)) {
            $totalpayapp = $this->updateTotalpayApp($totalpayapp, $request, $customerservice);
            $arr_post = $this->updateCompApp($totalpayapp, $customerservice);
            $this->handleCompanyLogoUpload($request, $customerservice->id);

            return redirect('/totalpayapp')->with('success', 'PWS Totalpay App Service Updated!!');
        }

        return redirect()->back()->with('error', 'Customerservice not found!');
    }

    private function updateCustomerService(CustomerTotalPayApp $totalpayapp, Request $request)
    {
        $customerservice = $totalpayapp->service;
        $customerservice->vpnaddress = $request->input('vpnaddress') ?? $totalpayapp->vp;
        $customerservice->save();

        return $customerservice;
    }

    private function updateTotalpayApp(CustomerTotalPayApp $totalpayapp, Request $request, $customerservice)
    {
        $totalpayapp->update([
            'customers_id' => $request->input('customers_id'),
            //'customer_services_id' => $request->input('serviceid'),
            'customer_services_id' => $customerservice->id,
            'shopname' => $request->input('shopname'),
            'contactno' => $request->input('contactno'),
            'email' => $request->input('email'),
            'slogan' => $request->input('slogan'),
            'apiurl' => "http://".$totalpayapp->service->vpnaddress."/".$request->input('tapiurl')."/totalpay",
            'tapiurl' => $request->input('tapiurl'),
            'client_id' => "TOTALPAYAPP",
            'client_secret' => "VlA0j6xGWTW5Fui3WPB5",
            'username' => $customerservice->serial_no,
            'password' => md5($customerservice->cfgpassword),
            'active' => ($request->has("active")) ? "1" : "0",
            'b_acpt_op' => ($request->has("b_acpt_op")) ? "1" : "0",
            'b_dealforyou' => ($request->has("b_dealforyou")) ? "1" : "0",
            'b_locate' => ($request->has("b_locate")) ? "1" : "0",
            'b_getgprc' => ($request->has("b_getgprc")) ? "1" : "0",
            'b_refer' => ($request->has("b_refer")) ? "1" : "0",
            'merchant_code' => (!empty($request->input('merchant_code'))) ? $request->input('merchant_code') : "",
            'merchant_key' => (!empty($request->input('merchant_key'))) ? $request->input('merchant_key') : "",
            'chrg_amt' => (!empty($request->input('chrg_amt'))) ? $request->input('chrg_amt') : "",
            'cust_chrg_amt' => (!empty($request->input('cust_chrg_amt'))) ? $request->input('cust_chrg_amt') : "",
            'renew_red' => ($request->has('renew_red') && !empty($request->input('renew_red'))) ? $request->input('renew_red') : 0,
            'b_reduce_principle' => ($request->has("b_reduce_principle")) ? "1" : "0",
            'b_floating' => ($request->has("b_floating")) ? "1" : "0",
            'b_payslip' => ($request->has("b_payslip")) ? "1" : "0",
            'b_productimage' => ($request->has("b_productimage")) ? "1" : "0",
            'map_address' => $request->input("map_address"),
            'latitude' => ($request->has("latitude") && $request->input("latitude")!="") ? $request->input("latitude") : "",
            'longitude' => ($request->has("longitude") && $request->input("longitude")!="")?$request->input("longitude"): ""
        ]);

        return $totalpayapp;
    }

    private function updateCompApp(CustomerTotalPayApp $totalpayapp, $customerservice)
    {
        $arr_post = [
            'id' => $totalpayapp->customers_id,
            'serviceid' => $customerservice->id,
            'client_id' => $totalpayapp->client_id,
            'client_secret' => $totalpayapp->client_secret,
            'username' => $totalpayapp->username,
            'password' => $totalpayapp->password,
            'shopname' => $totalpayapp->shopname,
            'showcontactnumber' => $totalpayapp->showcontactnumber,
            'contactnumber' => $totalpayapp->contactnumber,
            'shopemail' => $totalpayapp->shopemail,
            'slogan' => $totalpayapp->slogan,
            'shopcode' => $totalpayapp->shopcode,
            'shopurl' => $totalpayapp->shopurl,
            'address' => $totalpayapp->address,
            'latitude' => $totalpayapp->latitude,
            'longitude' => $totalpayapp->longitude,
            'active_status' => $totalpayapp->active_status,
            'dealsforyou' => $totalpayapp->dealsforyou,
            'onlinepayment' => $totalpayapp->b_acpt_op,
            'abletolocate' => $totalpayapp->b_locate,
            'getgoldprice' => $totalpayapp->b_getgprc,
            'referprogram' => $totalpayapp->b_refer,
            'merchant_code' => $totalpayapp->merchant_code,
            'merchant_key' => $totalpayapp->merchant_key,
            'chrg_amt' => $totalpayapp->chrg_amt,
            'cust_chrg_amt' => $totalpayapp->cust_chrg_amt,
            'interestorredeem' => $totalpayapp->renew_red,
            'reduce_principle' => $totalpayapp->b_reduce_principle,
            'floating_principle' => $totalpayapp->b_floating,
            'payslip' => $totalpayapp->b_payslip,
            'productimage   ' => $totalpayapp->b_productimage,
            'increase_principle' => 0,
            'cdd_takepic' => 0,
            'edd_takepic' => 0,
            'mode' => 'edit'
        ];

        $arr_compreturn = $this->submitCompApp($arr_post, $customerservice->id);

        if (isset($arr_compreturn->status) && $arr_compreturn->status == "Success") {
            $totalpayapp->qrpdfurl = $arr_compreturn->shoppdf;

            $totalpayapp->save();
        }

        return $arr_post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TotalpayApp  $pwstotalpayapp
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerTotalPayApp $totalpayapp)
    {
        $customerId = $totalpayapp->customers_id;
        $serviceId = $totalpayapp->serviceid;

        $totalpayapp->delete();

        $this->submitCompApp([
            'id' => $customerId,
            'mode' => 'delete',
            'serviceid' => $serviceId,
        ]);

        return redirect('/totalpayapp')->with('success', 'PWS Totalpay App Service deleted!!');
    }

    /**
     * Submit data to the Comp App API.
     *
     * @param array $arr_post
     * @return stdClass
     */
    private function submitCompApp($arr_post, $serviceId)
    {
        $response = $this->sendShopData($arr_post);
        $this->logShopData($arr_post, $response);

        if (isset($arr_post["mode"]) && $arr_post["mode"] !== "delete") {
            $this->uploadLogoToApi($arr_post, $serviceId);
        }

        return json_decode($response);
    }

    /**
     * Send shop data to the specified API endpoint.
     *
     * @param array $arr_post
     * @return string
     */
    private function sendShopData($arr_post)
    {
        $url = "https://totalpay.com.my/live/app/public/api/shops";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => http_build_query($arr_post),
            CURLOPT_CONNECTTIMEOUT => 3600,
            CURLOPT_TIMEOUT => 3600,
            CURLOPT_SSL_VERIFYHOST => 0,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * Log shop data and API response.
     *
     * @param array $arr_post
     * @param string $response
     * @return void
     */
    private function logShopData($arr_post, $response)
    {
        $url = "https://totalpay.com.my/live/app/public/api/shops";
        Log::channel('daily')->info(date("d/m/Y H:i:s") . " Shop Data Sent to: " . $url);
        Log::channel('daily')->info(date("d/m/Y H:i:s") . " Data Sent: " . print_r($arr_post, true));
        Log::channel('daily')->info(date("d/m/Y H:i:s") . " Response: " . $response);
    }

    private function uploadLogoToApi($arr_post, $serviceId)
    {
        $url = "https://totalpay.com.my/live/app/public/api/addlogo";
        $logoPath = public_path("totalpay/{$serviceId}/comp_logo.jpg");

        if (!file_exists($logoPath)) {
            Log::error("Logo file not found at path: " . $logoPath);
            return null;
        }

        $postFields = array(
            'logo' => new \CURLFILE($logoPath),
            'username' => $arr_post["username"],
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        Log::info("Logo Upload Data: " . print_r($postFields, true));
        Log::info("Logo Upload Response: " . $response);

        // Decode the response JSON
        $responseData = json_decode($response, true);

        if ($responseData && isset($responseData['status']) && $responseData['status'] === 'success') {
            Log::info("Logo upload successful. New logo URL: " . $responseData['url']);
            return $responseData['url'];
        } else {
            Log::error("Logo upload failed.");
            return null;
        }
    }

    /**
     * Handle the upload of the company logo.
     *
     * @param Request $request
     * @param int $serviceId
     * @return void
     */
    private function handleCompanyLogoUpload($request, $serviceId)
    {
        if ($request->hasFile('comp_logo')) {
            $file = $request->file('comp_logo');

            $destinationPath = public_path("totalpay/");
            if(isset($serviceId)){
                $destinationPath = public_path("totalpay/{$serviceId}");
            }

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $mimeToExtension = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/tiff' => 'tiff',
            ];

            $extension = $mimeToExtension[$file->getMimeType()] ?? 'jpg';

            $file->move($destinationPath, "comp_logo.{$extension}");
        }
    }

}
