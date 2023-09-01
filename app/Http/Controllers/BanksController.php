<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;

class BanksController extends Controller
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

        $banks = Bank::search($searchValue)->paginate(self::ITEMS_PER_PAGE);

        if ($searchValue) {
            $banks->appends(['searchvalue' => $searchValue])->links();
        }

        return view('banks.index', compact('banks', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankRequest $request)
    {
        $data = $request->validated();

        $bank = Bank::create([
            'code' => $data['code'],
            'name' => $data['name'],
        ]);

        return redirect('/banks')->with('success', 'New Bank Code (' . $data['code'] . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Bank $bank
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }

    /**
     * Display the form to edit specified resource.
     *
     * @param  App\Models\Bank $bank
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBankRequest  $request
     * @param  Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankRequest $request, Bank $bank)
    {
        $data = $request->validated();

        $bank->update($data);

        return redirect('/banks')->with('success', 'Bank Code (' . $data['code'] . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect('/banks')->with('success', 'Bank Code (' . $bank->code . ') has been deleted!!');
    }
}
