<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Customer;
use App\Models\CustomerCategory;
use App\Models\Term;
use App\Models\CustomerGroup;
use App\Models\CustomerPwspgapp;
use App\Models\customerGroupsCustomer;
use App\Models\CustomerService;
use App\Models\CustomerTotalpayapp;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use TCPDF;
use Carbon\Carbon;

class CustomersController extends Controller
{
    const CUSTOMERS_PER_PAGE = 15;
    /**
     * Display a listing of customers.
     *
     * This method is responsible for displaying a list of resources, usually fetched from a database,
     * and returning a response to the client.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing user input, headers, etc.
     * @return \Illuminate\Http\Response A response object representing the rendered output.
     */
    public function index(Request $request)
    {
        $filters['searchvalue'] = $request->input('searchvalue');
        $filters['srch_area'] = $request->input('srch_area');
        $customers = Customer::searchCustomer($filters);
        $pdffile = null;
        if ($request->has('btnpdf') && $request->input('btnpdf') !== "" && $request->get('btnpdf') !== null) {
            $pdffile = url("/pdf/".$this->generatePdf($customers));
            session()->flash('success', 'Filtered PDF generated successfully created!');
        }
        $input = $request->all();
        $area = Area::get();
        $customers = $customers->paginate(self::CUSTOMERS_PER_PAGE);
        if(isset($filters['searchvalue'])) {
            $customers = $customers->appends(['searchvalue' => $filters['searchvalue']]);
        }
        if(isset($filters['srch_area'])) {
            $customers = $customers->appends(['srch_area' => $filters['srch_area']]);
        }

        return view('customers.index', compact('customers', 'input', 'area', 'pdffile'));
    }

    protected function generatePdf($customers) {
        $pdfdata = clone $customers;
        $arr_data = $pdfdata->get();
        view()->share('data', $arr_data);
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetMargins(10, 10, 10, true);
        $pdf->AddPage();
        $html = \Illuminate\Support\Facades\View::make('customers.customer')->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdfFilename = 'customerlist_' . Str::random(15) . '.pdf';
        $pdf->Output(public_path('pdf/' . $pdfFilename), 'F');

        return $pdfFilename;
    }

    /**
     * Show the form for creating a new customer.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data = [
            'area' => Area::where('isactive', 1)->get(),
            'category' => CustomerCategory::all(),
            'term' => Term::get(),
            'customer_group' => CustomerGroup::all(),
        ];
        $default["logindate"] = $request->session()->get('login_date');

        return view('customers.create', compact('data', 'default'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $request['companycode'] = $this->generateCompanyCode($request);
        $postedData = $this->preparePostData($request, $request->validated());
        $customer = Customer::create($postedData);
        if ($request->filled('customergroupid')) {
            $customerGroupDetail = new customerGroupsCustomer([
                'customers_id' => $customer->id,
                'customer_groups_id' => $request->input('customergroupid'),
            ]);
            $customer->customerGroupsCustomer()->save($customerGroupDetail);
        }
        $redirectPath = Auth::user()->hasPermissionTo('CUSTOMER LIST') ? '/customers' : '/customers/create';

        return redirect($redirectPath)->with('success', 'New Customer Code (' . $customer->companycode . ') has been created!');
    }

    protected function preparePostData($request, $validatedData){
        $carbonDate = Carbon::createFromTimestamp(strtotime($request->input('startdate')));

        return [
            'companyname' => $validatedData['companyname'],
            'companycode' => $validatedData['companycode'],
            'areas_id' => $validatedData['areaid'],
            'email' => $validatedData['email'],
            'shortname' => $request->get('shortname'),
            'status' => $request->has('status') ? 1 : 0,
            'registrationno' => $request->get('registrationno'),
            'registrationno2' => $request->get('registrationno2'),
            'categories_id' => $request->get('categoryid'),
            'startdate' => $carbonDate->format('Y-m-d'),
            'homepage' => $validatedData['homepage'],
            'customergroupid' => $request->get('customergroupid'),
            'foldername' => $request->get('foldername'),
            'terms_id' => $request->get('termid'),
            'address1' => $request->get('address1'),
            'address2' => $request->get('address2'),
            'address3' => $request->get('address3'),
            'address4' => $request->get('address4'),
            'areas_id' => $request->get('areaid'),
            'bandar' => $request->get('bandar'),
            'zipcode' => $request->get('zipcode'),
            'contactperson' => $request->get('contactperson'),
            'phoneno1' => $request->get('phoneno1'),
            'phoneno2' => $request->get('phoneno2'),
            'faxno1' => $request->get('faxno1'),
            'faxno2' => $request->get('faxno2'),
            'email2' => $request->get('email2'),
            'email3' => $request->get('email3'),
            'remarks' => $request->get('remarks'),
            'b_aiservice' => $request->has('b_aiservice') ? 'Y' : 'N',
            'currencies_id' => 1,
        ];
    }

    private function generateCompanyCode($request)
    {
        if (empty($request->input('companycode'))) {
            $area = Area::find($request->input('areaid'));
            $category = $request->input('categoryid');

            $lastCodeQuery = Customer::where('categoryid', '>', 2)
                ->whereRaw('companycode like "' . substr($request->input('companyname'), 0, 1) . '0%"')
                ->max('companycode');

            $lastCode = intval(substr($lastCodeQuery, -3));
            $lastCode++;

            if ($category > 2) {
                return substr($request->input('companyname'), 0, 1) . sprintf("%04d", $lastCode);
            } else {
                return $area->areacode . sprintf("%03d", $lastCode);
            }
        }

        return $request->input('companycode');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        $data = [
            'start_date' => $customer->start_date_formatted,
            "area" => Area::where('isactive', 1)->get(),
            "category" => CustomerCategory::get(),
            "term" => Term::get(),
            "customer_group" => CustomerGroup::get(),
            "group_detail" => customerGroupsCustomer::where('customers_id', $customer->id)->get(),
        ];
        $input = $request->all();

        return view('customers.show', compact('data', 'customer', 'input'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customer->startdate = Carbon::createFromTimestamp(Carbon::parse($customer->startdate)->timestamp)->format('d/m/Y');

        //dd($customer->customerGroupsCustomer()->first()->toArray());

        $data = [
            'area' => Area::where('isactive', 1)->get(),
            'category' => CustomerCategory::get(),
            'term' => Term::get(),
            'customer_group' => CustomerGroup::get(),
            'group_detail' => $customer->customerGroupsCustomer()->first(),
        ];

        return view('customers.edit', compact('data', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     *         The HTTP request object containing the validated form data.
     * @param  \App\Models\Customer  $customer
     *         The Customer model instance representing the customer to be updated.
     * @return \Illuminate\Http\Response
     *         A response object that redirects to the customer list page with a success message
     *         if the customer update is successful.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $postedData = $this->preparePostData($request, $request->validated());
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $customer->update($postedData);
        // Handling CustomerGroupDetail
        if ($request->has('customergroupid') && $request->get('customergroupid') != null) {
            $relationExists = $customer->customerGroupsCustomer();

            if ($relationExists->count()) {
                $relationExists->update([
                    'customer_groups_id' => $request->customergroupid,
                    'customers_id' => $customer->id
                ]);
            } else {
                $customer->customerGroupsCustomer()->create([
                    'customer_groups_id' => $request->customergroupid,
                    'customers_id' => $customer->id
                ]);
            }
        } else {
            if ($customer->customerGroupsCustomer) {
                $customer->customerGroupsCustomer()->delete();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return redirect('/customers')->with('success', 'Customer Code (' . $customer->companycode . ') has been updated!!');
    }

    /**
     * Remove the specified customer resource from storage.
     *
     * This method is responsible for deleting a customer and any related records associated with it.
     *
     * @param  \App\Models\Customer  $customer  The Customer model instance representing the customer to be deleted.
     * @return \Illuminate\Http\RedirectResponse  A redirect response back to the customer listing page.
     */
    public function destroy(Customer $customer)
    {
        if (!$customer) {
            return redirect('/customer')->with('error', 'Customer not found.');
        }
        $customerId = $customer->id;
        $customer->delete();

        customerGroupsCustomer::where("customers_id",$customerId)->delete();
        CustomerPwspgapp::where("customers_id",$customerId)->delete();
        CustomerTotalpayapp::where("customers_id",$customerId)->delete();
        CustomerService::where("customers_id",$customerId)->delete();

        return redirect('/customers')->with('success', 'Customer Code ('.$customer->companycode.') has been deleted!!');
    }
}
