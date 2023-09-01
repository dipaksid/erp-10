<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Agent;
use App\Models\Area;
use Illuminate\Http\Request;

class AgentsController extends Controller
{
    const ITEMS_PER_PAGE = 15;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue');
        $agents = Agent::searchAgents($searchValue)->paginate(self::ITEMS_PER_PAGE);
        $agents->appends(['searchvalue' => $searchValue]);

        return view('agents.index', compact('agents', 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data["area"] = $this->getData();

        return view('agents.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAgentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAgentRequest $request)
    {
        $input = array_filter($request->all(), 'strlen');

        Agent::create($input);

        return redirect('/agents')->with('success', 'New Agent Code (' . $request->agentcode . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\Agent $agent
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Agent $agent)
    {
        $data["area"] = $this->getData();

        return view('agents.show',compact('agent','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\Agent $agent
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Agent $agent)
    {
        $data["area"] = $this->getData();

        return view('agents.edit',compact('agent','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateAgentRequest $request
     * @param App\Models\Agent $agent
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $data = $request->validated();
        $data['areas_id'] = $request->get('areas_id');
        $data['commrate'] = $request->get('commrate');

        $agent->update($data);

        return redirect('/agents')->with('success', 'Agent Code (' . $agent->agentcode . ') has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Agent $agent
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();

        return redirect('/agents')->with('success', 'Agent Code ('.$agent->agentcode.') has been deleted!!');
    }

    protected function getData(){

        return Area::where('isactive', 1)->pluck('description', 'id');
    }
}
