<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Branch;
use App\Enums\AdminStatuses;
use Illuminate\Http\Request;
use App\Services\UploadService;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    const DIRECTORY = 'back.admins';

    function __construct()
    {
     
        $this->middleware('check_permission:admins')->only(['create', 'store']);
        $this->middleware('check_permission:admins')->only(['edit', 'update']);
        $this->middleware('check_permission:admins')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('back.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('back.admins.create' ,compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();
        $admin = Admin::create($data);
        if (isset($data['role'])) $admin->assignRole($data['role']);
        return back()->with('adminCreate', 'updated successfuly');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('back.admins.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('back.admins.edit',compact('roles' ,'admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->validated();
        if ($data['password'] == null) unset($data['password']);
        $admin->update($data);
        $admin->syncRoles([$data['role']]);
        return back()->with('adminUpdate', 'updated successfuly');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->syncRoles();
        $admin->delete();
        return back()->with('adminDelete', 'deleted successfuly');

    }
}
