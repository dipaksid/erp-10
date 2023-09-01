<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Staff;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['searchvalue']);
        $users = User::searchUsersWithFilters($filters);
        if(isset($filters['searchvalue'])){
            $users->withPath('?searchvalue='.(($filters['searchvalue']) ? $filters['searchvalue']: ""));
        }

        return view('users.index', compact('users','filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->getData();

        return view('users.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'staff_id' => $request->get('staff_id'),
        ]);

        $this->updateRole($user, $validatedData['rolesid']);

        return redirect()->route('users.index')->with('success', 'User ('.$user->name.') has been created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = $this->getData();

        return view('users.show',compact('user','data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = $this->getData();

        return view('users.edit', compact('user', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $validatedData['staff_id'] = $request->get('staff_id');
        $user->update($validatedData);

        $this->updateRole($user, $request->get('rolesid'), true);

        return redirect()->route('users.index')->with('success', 'User ('.$user->name.') has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User ('. $user->name .') has been deleted!!');
    }

    protected function getData(){
        $data["roles"] = Role::all();
        $data["staff"] = Staff::all();

        return $data;
    }

    protected function updateRole($user, $role_id, $update = false){
        $role = Role::where('id', $role_id)->first();
        if($update) {
            if (isset($role)) {
                $user->roles()->sync($role);  //If one or more role is selected associate user to roles
            } else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
        }else{
            if ($role) {
                $user->assignRole($role->name);
                $user->save();
            } else {
                Log::error('Role Not Found for ID: ' . $validatedData['rolesid']);
            }
        }
    }
}
