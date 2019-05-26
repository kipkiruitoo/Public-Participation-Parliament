<?php

namespace App\Http\Controllers;
use Auth;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use App\Http\Controllers\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index',  array('user' => Auth::user()))->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
      return view('manage.roles.create',  array('user' => Auth::user()))->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validateWith([
            'display_name' => 'required|max:255',
            'name' => 'required|max:100|alpha_dash|unique:roles',
            'description' => 'sometimes|max:255'
          ]);
          $role = new Role();
          $role->display_name = $request->display_name;
          $role->name = $request->name;
          $role->description = $request->description;
          $role->save();
          if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
          }
          Session::flash('success', 'Successfully created the new '. $role->display_name . ' role in the database.');
          return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $id = $role->id;
        $role = Role::where('id', $id)->with('permissions')->first();
        return view('manage.roles.show',  array('user' => Auth::user()))->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $id = $role->id;
        $role = Role::where('id', $id)->with('permissions')->first();
        $permissions = Permission::all();
        return view('manage.roles.edit',  array('user' => Auth::user()))->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $id = $role->id;
        $this->validateWith([
            'display_name' => 'required|max:255',
            'description' => 'sometimes|max:255'
          ]);
          $role = Role::findOrFail($id);
          $role->display_name = $request->display_name;
          $role->description = $request->description;
          $role->save();
          if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
          }
          Session::flash('success', 'Successfully update the '. $role->display_name . ' role in the database.');
          return redirect()->route('roles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
