<?php

namespace App\Http\Controllers;

use App\Models\Uom;
use App\Models\Stock;
use App\Http\Requests\StoreUomsRequest;
use App\Http\Requests\UpdateUomsRequest;
use Illuminate\Http\Request;
use App\Services\DataService;

class UomsController extends Controller
{
    /**
     * Constructor for the class.
     *
     * @param App\Services\DataService $dataService An instance of the DataService class used for data operations.
     */
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    const ITEM_PER_PAGES = 15;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchValue = request()->input('searchvalue');

        $uoms = Uom::search($searchValue)->paginate(self::ITEM_PER_PAGES)
                                         ->appends(['searchvalue' => $searchValue]);

        return view('uoms.index', compact('uoms', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $stocks = $this->dataService->fetchStocks(request());

        return view('uoms.create', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUomsRequest $request
     * @param App\Models\Uom $uom
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUomsRequest $request, Uom $uom)
    {
        $data = $request->validated();

        $uom->create([
            'stocks_id' => $data['stocks_id'],
            'uomcode' => $data['uomcode'],
            'description' => $data['description'],
            'isactive' => $request->has('isactive') ? true : false,
        ]);

        return redirect()->route('uoms.index')->with('success', 'New UOMs (' . $uom->uomcode . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Uom $uom
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Uom $uom)
    {
        return view('uoms.show', compact('uom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Uom $uom
     */
    public function edit(Uom $uom)
    {
        $stocks = $this->dataService->fetchStocks(request());

        return view('uoms.edit', compact('uom', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateUomsRequest $request
     * @param App\Models\Uom $uom
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUomsRequest $request, Uom $uom)
    {
        $data = $request->validated();

        $uom->update([
            'stocks_id' => $data['stocks_id'],
            'uomcode' => $data['uomcode'],
            'description' => $data['description'],
            'isactive' => $request->has('isactive'),
        ]);

        return redirect()->route('uoms.index')->with('success', 'UOMs (' . $uom->uomcode . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Uom $uom
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Uom $uom)
    {
        $uom->delete();

        return redirect()->route('uoms.index')->with('success', 'UOMs ('.$uom->uomcode.') has been deleted!!');
    }
}
