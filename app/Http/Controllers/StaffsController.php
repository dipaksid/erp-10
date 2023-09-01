<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');

        $staffs = Staff::query()->search($searchValue)->paginate(15);
        $staffs->appends(['searchvalue' => $searchValue]);

        $input = $request->all();

        return view('staffs.index', compact('staffs', 'input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $comp_setting = $this->getData();

        return view('staffs.create',compact('comp_setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStaffRequest $request
     * @param App\Models\Staff $staff
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStaffRequest $request,Staff $staff)
    {
        $data = $request->validated();
        $data['designation'] = $request->get('designation');
        $data['department'] = $request->get('department');
        $data['date_join'] = $request->get('date_join');

        Staff::create($data);

        return redirect('/staffs')->with('success', 'New Staff Code (' . $data['staffcode'] . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Staff $staff
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Staff $staff)
    {
        $comp_setting = $this->getData();

        return view('staffs.show', compact('staff','comp_setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Staff $staff
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Staff $staff)
    {
        $comp_setting = $this->getData();

        return view('staffs.edit', compact('staff','comp_setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateStaffRequest $request
     * @param App\Models\Staff
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $data = $request->validated();
        $data['designation'] = $request->get('designation');
        $data['department'] = $request->get('department');
        $data['date_join'] = $request->get('date_join');
        $data['comp_id'] = $request->get('comp_id');

        $staff->update($data);

        return redirect('/staffs')->with('success', 'Staff Code (' . $staff->staffcode . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Staff $staff
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect('/staffs')->with('success', 'Staff Code ('.$staff->staffcode.') has been deleted!!');
    }

    protected function getData(){

        return CompanySetting::select('id', 'companyname', 'companycode')->get();
    }
}
