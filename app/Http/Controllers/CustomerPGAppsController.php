<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePWSAppRequest;
use App\Http\Requests\UpdateApiOauthUserRequest;
use App\Models\Customer;
use App\Models\CustomerPwspgapp;
use App\Models\CustomerTotalPayApp;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\DataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class CustomerPGAppsController extends Controller
{
    const ITEMS_PER_PAGE = 15;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $pwspgapp = CustomerPwspgapp::withUserData()
            ->searchByKeyword($searchValue)
            ->paginate(15)
            ->appends(['searchvalue' => $searchValue]);

        return view('customerpwspgapp.index', compact('pwspgapp', 'searchValue'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->dataService->fetchCustomers(request());

        return view('customer_pwspg_apps.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePWSAppRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePWSAppRequest $request)
    {
        $apioauthscope = null;
//        $apioauthscope = UserDetail::selectRaw("group_concat(description SEPARATOR ' ') as scope")
//                                        ->where("client_id", "PWSPGAPP")->first();

        $apioauthuser = $this->createApiOauthUser($request, $apioauthscope);

        $arr_post = $this->createCustomerPwspgapps($request, $apioauthuser);

        $this->submitCompApp($arr_post);

        return redirect('/customer-pwspg-app')->with('success', 'New PWS PG App Service has been created!');
    }

    protected function createApiOauthUser(Request $request, $apioauthscope)
    {
        $apioauthuser = new UserDetail($request->only([
            'username',
            'password',
            'mob_pho',
            'first_name',
            'idle_tim',
            'access_pdf',
            'email',
        ]));

        $apioauthuser->scope = $apioauthscope->scope ?? null;
        $apioauthuser->client_id = "PWSPGAPP";
        $apioauthuser->save();

        return $apioauthuser;
    }

    protected function createCustomerPwspgapps(Request $request, $apioauthuser)
    {
        foreach ($request->input("cust") as $ckey => $custid) {
            $pwspgapp = new CustomerPwspgapp([
                'customerid' => $custid,
                'userid' => $apioauthuser->id,
                'apiurl' => $request->input('apiurl')[$ckey],
                'client_id' => "PGAPP",
                'client_secret' => "H2WeWtqBFjWRCAFyvD30",
                'username' => "USER",
                'password' => "2WtAJxo2fP9sLX81j4GE",
                'active' => "Y",
            ]);
            $pwspgapp->save();

            $customersinfo = Customer::find($custid);
            $arr_post["cid"][$ckey]             = $pwspgapp->id;
            $arr_post["customerid"][$ckey]      = $custid;
            $arr_post["companyname"][$ckey]     = $customersinfo->companyname;
            $arr_post["apiurl"][$ckey]          = $request->input('apiurl')[$ckey];
            $arr_post["sclient_id"][$ckey]      = "PGAPP";
            $arr_post["sclient_secret"][$ckey]  = "H2WeWtqBFjWRCAFyvD30";
            $arr_post["susername"][$ckey]       = "USER";
            $arr_post["spassword"][$ckey]       = "2WtAJxo2fP9sLX81j4GE";
            $arr_post["active"][$ckey]          = "Y";
        }

        return $arr_post;
    }

    public function edit(Request $request, $id)
    {
        $customers = $this->dataService->fetchCustomers($request);
        $customerpwspgapp = CustomerPwspgapp::fetchEditData($id);
        $input = $request->all();

        return view('customer_pwspg_apps.edit', compact('customerpwspgapp', 'id', 'input', 'customers'));
    }

    public function update(UpdateApiOauthUserRequest $request, CustomerPwspgapp $apioauthuser)
    {
        $data = $request->validated();
        //$apioauthscope = UserDetail::selectRaw("group_concat(description SEPARATOR ' ') as scope")
        //->where("client_id", "PWSPGAPP")->first();

        $apioauthuser->fill([
            'username' => $data['username'],
            'password' => $data['password'],
            'mob_pho' => $data['mob_pho'],
            'first_name' => $data['first_name'],
            'idle_tim' => isset($data['idle_tim']) ?? $request->get('idle_tim'),
            'access_pdf' => $data['access_pdf'] ?? $request->get('access_pdf'),
            'email' => $data['email'] ?? $request->get('email'),
            'scope' => isset($apioauthscope) && $apioauthscope->scope ?? null,
        ])->save();

        $this->updateAssociatedModels($request, $apioauthuser);

        return redirect('/customer-pwspg-app')->with('success', 'PWS PG App Service Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr_post["id"] = $id;
        $arr_post["mode"] = "delete";

        $customer_pwspg_app = CustomerPwspgapp::find($id);
        dd($customer_pwspg_app->id, $customer_pwspg_app->delete());

        $this->submitCompApp($arr_post);

        return redirect('/customer-pwspg-app')->with('success', 'PWS PG App Service deleted!!');
    }


    private function updateAssociatedModels($request, $apioauthuser)
    {
        $arr_post["mode"] = "edit";
        $arr_post["id"] = $apioauthuser->id;
        $arr_post["username"] = $apioauthuser->username;
        $arr_post["password"] = $apioauthuser->password;
        $arr_post["mob_pho"] = $apioauthuser->mob_pho;
        $arr_post["first_name"] = $apioauthuser->first_name;
        $arr_post["idle_tim"] = $apioauthuser->idle_tim;
        $arr_post["access_pdf"] = $apioauthuser->access_pdf;
        $arr_post["email"] = $apioauthuser->email;
        $arr_post["client_id"] = "PWSPGAPP";
        $arr_post["scope"] = $apioauthuser->scope;

        // Update CustomerPwspgapp models
        $this->updateCustomerPwspgappModels($request, $arr_post, $apioauthuser->id);
    }

    private function updateCustomerPwspgappModels($request, &$arr_post, $userId)
    {
        $pgappIds = $request->input('pgappid') ?? [];

        // Delete existing entries if needed
        if (empty($pgappIds)) {
            CustomerPwspgapp::where('users_id', $userId)->delete();
        } else {
            CustomerPwspgapp::where('users_id', $userId)->whereNotIn('id', $pgappIds)->delete();
        }

        foreach ($request->input("cust") as $ckey => $custid) {
            if (!isset($pgappIds[$ckey]) || empty($pgappIds[$ckey])) {
                // Create new CustomerPwspgapp
                $pwspgapp = new CustomerPwspgapp();
                $pwspgapp->customerid = $custid;
                $pwspgapp->userid = $userId;
                // Set other attributes
                $pwspgapp->save();
                $arr_post["cid"][$ckey] = $pwspgapp->id;
            } else {
                $arr_post["cid"][$ckey] = $pgappIds[$ckey];
            }

            // Update other attributes in $arr_post
            $customersinfo = Customer::find($custid);
            $arr_post["customerid"][$ckey] = $custid;
            $arr_post["companyname"][$ckey] = $customersinfo->companyname;
            $arr_post["apiurl"][$ckey] = $request->input('apiurl')[$ckey];
            $arr_post["sclient_id"][$ckey] = "PGAPP";
            $arr_post["sclient_secret"][$ckey] = "H2WeWtqBFjWRCAFyvD30";
            $arr_post["susername"][$ckey] = "USER";
            $arr_post["spassword"][$ckey] = "2WtAJxo2fP9sLX81j4GE";
            $arr_post["active"][$ckey] = "Y";

            $this->submitCompApp($arr_post);
        }
    }

    private function submitCompApp($arr_post) {
        $tokenUrl = "https://pawnlive.my/pawnapp/TOKEN";
        $appUrl = "https://pawnlive.my/pawnapp/COMPANYPGAPP";

        $tokenData = [
            "username" => "bwerp",
            "password" => "4gfdG45HT4vbf4Gh1",
            "client_id" => "BWERP",
            "client_secret" => "RFDe5441GgHweYb88",
            "grant_type" => "password"
        ];

        $tokenResponse = $this->makeCurlRequest($tokenUrl, $tokenData);

        if ($tokenResponse !== false) {
            $accessToken = $tokenResponse["access_token"];
            $arr_post["access_token"] = $accessToken;

            $appResponse = $this->makeCurlRequest($appUrl, $arr_post);
        }
    }

    private function makeCurlRequest($url, $data) {
        $curl = curl_init();

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CONNECTTIMEOUT => 3600,
            CURLOPT_TIMEOUT => 3600,
            CURLOPT_SSL_VERIFYHOST => 0
        ];

        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);

        if ($response === false) {
            // Handle error here
        } else {
            $responseData = json_decode($response, true);
            curl_close($curl);
            return $responseData;
        }
    }
}
