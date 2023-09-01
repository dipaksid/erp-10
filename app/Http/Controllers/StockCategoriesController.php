<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockCategoryRequest;
use App\Http\Requests\UpdateStockCategoryRequest;
use App\Models\StockCategory;
use Illuminate\Http\Request;

class StockCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $stockcategories = StockCategory::search($searchValue)->paginate(15);

        if ($searchValue) {
            $stockcategories->appends(['searchvalue' => $searchValue]);
        }

        return view('stockcategories.index', compact('stockcategories','searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('stockcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StoreStockCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStockCategoryRequest $request)
    {
        $data = $request->validated();

        $stockcategory = new StockCategory($data);
        $stockcategory->isactive = $request->has('isactive');
        $stockcategory->isshowdb = $request->has('isshowdb');

        $stockcategory->save();

        return redirect()->route('stockcategories.index')->with('success', 'New Stock Category (' . $stockcategory->categorycode . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\StockCategory $stockcategory
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(StockCategory $stockcategory)
    {
        return view('stockcategories.show', compact('stockcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param App\Models\StockCategory $stockcategory
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(StockCategory $stockcategory)
    {
        return view('stockcategories.edit', compact('stockcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateStockCategoryRequest $request
     * @param App\Models\StockCategory $stockcategory
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStockCategoryRequest $request, StockCategory $stockcategory)
    {
        $data = $request->only(['categorycode', 'description', 'isactive', 'isshowdb']);
        $data['isactive'] = $request->has('isactive') ? 1 : 0;
        $data['isshowdb'] = $request->has('isshowdb') ? 1 : 0;

        $stockcategory->update($data);

        return redirect()->route('stockcategories.index')->with('success', 'Stock Category (' . $stockcategory->categorycode . ') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\StockCategory $stockcategory
     */
    public function destroy(StockCategory $stockcategory)
    {
        $stockcategory->delete();

        return redirect()->route('stockcategories.index')->with('success', 'Stock Category ('.$stockcategory->categorycode.') has been deleted!!');
    }
}
