<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    const DIRECTORY = 'back.roles';

    function __construct()
    {
        $this->middleware('check_permission:roles')->only(['create', 'store']);
        $this->middleware('check_permission:roles')->only(['edit', 'update']);
        $this->middleware('check_permission:roles')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('back.roles.index', compact('roles'));
    }

   

 
    public function create()
    {
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('back.roles.create', compact('permissions'));
    }

 
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'admin']);
        if (isset($data['permissionArray'])) {
            foreach ($data['permissionArray'] as $permission => $value) {
                $role->givePermissionTo($permission);
            }
        }
       
        return back()->with('roleCreate', 'Created successfuly');

    }

 
    public function show(Role $role)
    {
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('back.roles.show' ,compact('permissions','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('guard_name', 'admin')->get();
        return view('back.roles.edit' ,compact('permissions','role'));
       


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update(['name' => $data['name']]);
        $role->syncPermissions();
        if (isset($data['permissionArray'])) {
            foreach ($data['permissionArray'] as $permission => $value) {
                $role->givePermissionTo($permission);
            }
        }
        return back()->with('roleEdit', 'Edited successfuly');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->syncPermissions();
        $role->delete();
        return back()->with('roleDeleteStatus', 'your role has been deleted successfuly');

    }
}
