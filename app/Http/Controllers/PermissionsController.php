<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
class PermissionsController extends Controller
{
    /**
     * Display the index page listing permissions with optional search filters.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request with optional search filters.
     * @return \Illuminate\View\View Returns the view with the list of filtered permissions.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['searchvalue']);
        $permissions = Permission::searchPermissionsWithFilters($filters);
        if(isset($filters['searchvalue'])){
            $permissions->withPath('?searchvalue='.($filters['searchvalue']) ? $filters['searchvalue'] : '');
        }

        $input=$request->all();
        return view('permissions.index',compact('permissions','filters'));
    }

    /**
     * Display the create form for adding a new permission.
     *
     * @return \Illuminate\View\View Returns the view with the create form for permissions.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param \App\Http\Requests\StorePermissionRequest $request The incoming HTTP request with validated data.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the permission index page with a success message.
     */
    public function store(StorePermissionRequest $request)
    {
        $validatedData = $request->validated();
        $permission = Permission::create(['name' => $validatedData['name'], 'guard_name'=>'web']);

        return redirect()->route('permissions.index')
            ->with('success','Permission'. $permission->name.' added!');
    }

    /**
     * Display the specified permission.
     *
     * @param \App\Models\Permission $permission The permission instance to be displayed.
     * @return \Illuminate\View\View Returns the view with the specified permission details.
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Permission $permission The permission instance to be displayed.
     * @return \Illuminate\View\View Returns the view with the specified permission details.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     *
     * @param \App\Http\Requests\StorePermissionRequest $request The incoming HTTP request with validated data.
     * @param \App\Models\Permission $permission The permission instance to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the permissions index page with a success message.
     */
    public function update(StorePermissionRequest $request, Permission $permission)
    {
        $validatedData = $request->validated();
        $permission->update(['name'=>$validatedData['name']]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission'. $permission->name.' updated!');
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param \App\Models\Permission $permission The permission instance to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the permissions index page with a success or error message.
     */
    public function destroy(Permission $permission)
    {
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('success',
                    'Cannot delete this Permission!');
        }
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success',
                'Permission '. $permission->name.' deleted!');
    }
}
