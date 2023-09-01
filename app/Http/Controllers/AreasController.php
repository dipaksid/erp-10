<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    const ITEMS_PER_PAGE = 15;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $areaQuery = Area::searchByValue($searchValue);

        $area = $searchValue ? $areaQuery->paginate(self::ITEMS_PER_PAGE) : $areaQuery->orderBy('seq')->paginate(self::ITEMS_PER_PAGE);

        return view('areas.index', compact('area', 'searchValue'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created area resource in storage.
     *
     * @param  \App\Http\Requests\StoreAreaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        $data = $request->validated();

        $lastSeq = Area::max('seq');

        $area = new Area([
            'areacode' => $data['areacode'],
            'description' => $data['description'],
            'isactive' => $request->has('isactive') ? 1 : 0,
            'seq' => $lastSeq + 1,
        ]);

        $area->save();

        return redirect('/areas')->with('success', 'New Area Code (' . $data['areacode'] . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Area $area
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Area $area)
    {
        return view('areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Area
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    /**
     * Update the specified area resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAreaRequest  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $data = $request->validated();
        $area->update([
            'areacode' => $data['areacode'],
            'description' => $data['description'],
            'isactive' => $request->has('isactive') ? 1 : 0,
        ]);

        return redirect('/areas')->with('success', 'Area Code (' . $request['areacode'] . ') has been updated!');
    }

    /**
     * Remove the specified area resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        $areacode = $area->areacode;
        $area->delete();

        return redirect('/areas')->with('success', 'Area Code ('.$areacode.') has been deleted!!');
    }
}
