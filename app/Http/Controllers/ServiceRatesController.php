<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRateRequest;
use App\Models\ServiceRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $servicerate = ServiceRate::search($searchValue)->paginate(15);

        $input = compact('searchValue');

        return view('services_rates.index', compact('servicerate', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Illuminate\Http\Request $request
     * @param string $data
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request, $data="")
    {
        return view('services_rates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $effectivedate = Carbon::createFromFormat('d/m/Y', $request->input('effectivedate'))->format('Y-m-d');

        $check_dup = ServiceRate::where('effectivedate', $effectivedate)->first();

        if ($check_dup) {
            return redirect('/services_rates/create')->with('danger', 'Effective Date already exists!');
        }

        $d_description = $request->get('d_description');
        $d_rate = $request->get('d_rate');

        // Check if both arrays exist and have the same count
        if(count($d_description) == 1) {
            $description = [
                'rate' => $request->get('d_rate')[0],
                'description' => $request->get('d_description')[0]
            ];
        } else if ($d_description && $d_rate && count($d_description) === count($d_rate)) {
            $description = array_combine($d_description, $d_rate);
        } else {
            $description = [];
        }

        ServiceRate::create([
            'effectivedate' => $effectivedate,
            'description' => json_encode($description, JSON_PRETTY_PRINT),
            'rate' => null,
        ]);

        return redirect('/services_rates')->with('success', 'New Profile has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\ServiceRate $serviceRate
     * @return \Illuminate\Contracts\View\View
     */
    public function show(ServiceRate $services_rate)
    {

        return view('services_rates.show', compact('services_rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\ServiceRate $services_rate
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(ServiceRate $services_rate)
    {
        return view('services_rates.edit', compact('services_rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\StoreServiceRateRequest $request
     * @param App\Models\ServiceRate $services_rate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreServiceRateRequest $request, ServiceRate $services_rate)
    {
        $descriptions = $request->input('d_description', []);
        $rates = $request->input('d_rate', []);
        $rateData = [];
        foreach ($descriptions as $key => $description) {
            $rate = $rates[$key] ?? null;

            if ($description && $rate !== null) {
                $rateData[] = [
                    'description' => $description,
                    'rate' => $rate,
                ];
            }
        }
        $data = [
            'description' => json_encode($rateData),
            'effectivedate' => Carbon::createFromFormat('d/m/Y', $request->input('effectivedate'))->format('Y-m-d'),
            'rate' => null, // You can adjust this as needed.
        ];
        $services_rate->update($data);

        return redirect('/services_rates')->with('success', 'Service Rate Profile has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\ServiceRate $services_rate
     */
    public function destroy(ServiceRate $services_rate)
    {
        $services_rate->delete();

        return redirect('/services_rates')->with('success', 'Service rate Profiles has been deleted!!');
    }
}
