<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Models\Area;
use App\Models\Term;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class SuppliersController extends Controller
{
    const ITEMS_PER_PAGE = 15;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');
        $page = $request->input('page') ?? 1;

        $suppliers = Supplier::with('areas')
            ->search($searchValue)
            ->paginate(self::ITEMS_PER_PAGE);

        $suppliers->withPath('?searchvalue=' . ($searchValue ?: ''));

        return view('suppliers.index', compact('suppliers', 'searchValue', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getData();

        return view('suppliers.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $validatedData = $request->validated();

        $supplier = new Supplier();

        if (empty($validatedData['companycode'])) {
            $prefixName = substr($validatedData['companyname'], 0, 1);
            $lastCode = Supplier::whereRaw('substr(companyname, 1, 1) = ?', $prefixName)->max('companycode');
            $lastCode = $lastCode !== null ? (int) substr($lastCode, -4) + 1 : 1;
            $validatedData['companycode'] = $prefixName . sprintf("%04d", $lastCode);
        }

        $extraFields = [
            'currencies_id', 'registrationno', 'registrationno2', 'startdate','status',
            'homepage', 'terms_id', 'address1', 'address2', 'address3', 'address4',
             'zipcode', 'contactperson', 'email', 'phoneno1', 'phoneno2', 'faxno1', 'faxno2', 'email2'
        ];

        foreach ($extraFields as $field) {
            $validatedData[$field] = $request->get($field);
        }

        $supplier->fill(array_filter($validatedData, 'strlen'))->save();

        return redirect('/supplier')->with('success', 'New Supplier Code (' . $supplier->companycode . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $supplier->formatStartDate();

        $data = $this->getData();

        return view('suppliers.show', compact('data', 'supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $supplier->formatStartDate();

        $data = $this->getData();

        return view('suppliers.edit', compact('data', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupplierRequest  $request
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $data = $request->validated();
        $extraFields = [
            'currencies_id', 'registrationno', 'registrationno2', 'startdate', 'status',
            'homepage', 'terms_id', 'address1', 'address2', 'address3', 'address4',
            'zipcode', 'contactperson', 'email', 'phoneno1', 'phoneno2', 'faxno1', 'faxno2', 'email2'
        ];
        foreach ($extraFields as $field) {
            $data[$field] = $request->get($field);
        }
        $data["currencies_id"] = 1;

        $fillableAttributes = $supplier->getFillable();

        foreach ($fillableAttributes as $key) {
            if (isset($data[$key]) && $data[$key] != '') {
                $supplier->$key = $data[$key];
            } else {
                $supplier->$key = null;
            }
        }
        $supplier->save();

        return redirect('/supplier')->with('success', 'Supplier Code (' . $supplier->companycode . ') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/supplier')->with('success', 'Supplier Code ('.$supplier->companycode.') has been deleted!!');
    }

    /**
     * Get the Area and Term data
     *
     * @return array
     */
    private  function getData(){
        $data["area"] = Area::where('isactive', 1)->get();
        $data["term"] = Term::get();

        return $data;
    }
}
