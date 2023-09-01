<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Role;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->only(['searchvalue']);
        $roles = \App\Models\Role::searchRolesWithFilters($filters);

        return view('roles.index', compact('roles','filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('roles.create',  compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $validatedData = $request->validated();
        $role = Role::create(['name' => $validatedData['name']]);

        if ($request->has('permissions')) {
            $permissions = $validatedData['permissions'];
            $role->givePermissionTo($permissions);
        }

        return redirect()->route('roles.index')->with('success','Role '. $role->name.' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role The role instance to be edited.
     * @return \Illuminate\View\View
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Display the edit form for a specific role.
     *
     * @param \App\Models\Role $role The role instance to be edited.
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param \App\Http\Requests\StoreRoleRequest $request The incoming HTTP request with validated data.
     * @param \App\Models\Role $role The role instance to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the role index page with a success message.
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $validatedData = $request->validated();
        $role->update(['name'=> $validatedData['name']]);

        $permissions = $validatedData['permissions'];
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role ' . $role->name . ' updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role The role instance to be edited.
     * @return \Illuminate\View\View
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role ' . $role->name . ' deleted!');
    }
}
