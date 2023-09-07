<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSolutionProfileRequest;
use App\Http\Requests\UpdateSolutionProfileRequest;
use App\Models\SolutionProfile;
use App\Models\SystemSetting;
use App\Models\SoftwareService;
use Illuminate\Http\Request;
use Spatie\Ignition\Contracts\Solution;

class SolutionProfilesController extends Controller
{
    const ITEM_PER_PAGES = 15;
    /**
     * Display a listing of the resource.
     *
     * @param Illuminate\Http\Request $request
     * @return @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchValue = $request->input('searchvalue', '');
        $tab = $request->input('tab', 'solutionprofile');
        $solutionprofile = SolutionProfile::search($searchValue, 1)->orderBy('solutioncode')->paginate(self::ITEM_PER_PAGES);
        $solutionpending = SolutionProfile::search($searchValue, 2)->orderBy('solutioncode')->paginate($this->getPaginatePage());

        $params = ['tab' => $tab];
        $input = $request->all();

        return view('solution_profiles.index', compact('solutionprofile', 'input', 'solutionpending', 'tab', 'params'));
    }

    /**
     * Ge the total items per page showing.
     *
     * @return mixed
     */
    private function getPaginatePage()
    {
        return SystemSetting::pluck('paginate_page')->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('solution_profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSolutionProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSolutionProfileRequest $request)
    {
        $data = $request->validated();
        if (empty($data['solutioncode'])) {
            $data['solutioncode'] = SolutionProfile::generateNewSolutionCode();
        }
        $data['active'] = $request->has('active') ? 1 : 0;
        $solutionProfile = SolutionProfile::create($data);

        return redirect()
            ->route('solutionprofile.index', ['tab' => $request->input('tab', 'solutionprofile-tab')])
            ->with('success', 'New Solution Code (' . $solutionProfile->solutioncode . ') has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param App\Models\SolutionProfile $solutionprofile
     * @return \Illuminate\Contracts\View\View
     */
    public function show(SolutionProfile $solutionprofile)
    {
        return view('solution_profiles.show', compact('solutionprofile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\SolutionProfile $solutionprofile
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(SolutionProfile $solutionprofile)
    {
            return view('solution_profiles.edit', compact('solutionprofile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\UpdateSolutionProfileRequest $request
     * @param App\Models\SolutionProfile $solutionprofile
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSolutionProfileRequest $request, SolutionProfile $solutionprofile)
    {
        $data = $request->validated();
        
        $data['active'] = $request->has('active') ? 1 : 0;

        if ($solutionprofile->active == 1) {
            if (empty($data['solutioncode'])) {
                $data['solutioncode'] = SolutionProfile::generateNewSolutionCode();
            }
        } else {
            $data['solutioncode'] = $solutionprofile->solutioncode;
        }

        $solutionprofile->update($data);

        $parameter = '?tab=' . $request->input('tab', 'solutionprofile-tab');

        if (!empty($data['solutioncode'])) {
            $scode = $data['solutioncode'];
        } else {
            $str = explode('</p>', $data['problem_description']);
            $str2 = explode('<p>', $str[0]);
            $scode = $str2[1];
        }

        return redirect()
                ->route('solutionprofile.index', ['tab' => $request->input('tab', 'solutionprofile-tab')])
                ->with('success', 'Solution Profile (' .  $scode . ') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\SolutionProfile $solutionprofile
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SolutionProfile $solutionprofile, Request $request)
    {
        if ($request->filled('solutionselect')) {
            $idsToDelete = array_keys($request->input('solutionselect'));

            if (!empty($idsToDelete)) {
                SolutionProfile::whereIn('id', $idsToDelete)->delete();
            }

            $message = 'Pending Solution Profiles have been deleted!!';
        } elseif ($solutionprofile->exists) {
            $solutioncode = $solutionprofile->solutioncode;
            $solutionprofile->delete();
            $message = 'Pending Solution Profile (' . $solutioncode . ') has been deleted!!';
        } else {
            abort(404); // Handle invalid or missing ID
        }

        $parameter = [
            'tab' => $request->input('tab', 'solutionprofile-tab'),
            'searchvalue' => $request->input('searchvalue'),
            'page' => $request->input('page'),
        ];

        return redirect()->route('solutionprofile.index', $parameter)->with('success', $message);
    }

    public function checksimilarproblem(Request $request)
    {
        $checkduplicate = SolutionProfile::where('id','!=',$request['id'])
                            ->whereRaw('problem_description like "'.$request['problem_description'].'"')->first();
        if($checkduplicate){
            $check = 1;
        } else {
            $check = 0;
        }
        echo $check;
    }

    public function solutionpending(Request $request, $id){

        $solutionpending = SoftwareService::where('id',$id)->first();

        return view('solutionprofile.solutionpendingshow',compact('solutionpending','id'));
    }
}
