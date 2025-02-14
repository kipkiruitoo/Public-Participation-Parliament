<?php

namespace App\Http\Controllers;
use Auth;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'asc')->paginate(10);
        return view('manage.permissions.index',  array('user' => Auth::user()))->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create',  array('user' => Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->permission_type == 'basic') {
            $this->validateWith([
              'display_name' => 'required|max:255',
              'name' => 'required|max:255|alphadash|unique:permissions,name',
              'description' => 'sometimes|max:255'
            ]);
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();
            Session::flash('success', 'Permission has been successfully added');
            return redirect()->route('permissions.index');
          } elseif ($request->permission_type == 'crud') {
            $this->validateWith([
              'resource' => 'required|min:3|max:100|alpha'
            ]);
            $crud = explode(',', $request->crud_selected);
            if (count($crud) > 0) {
              foreach ($crud as $x) {
                $slug = strtolower($x) . '-' . strtolower($request->resource);
                $display_name = ucwords($x . " " . $request->resource);
                $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->resource);
                $permission = new Permission();
                $permission->name = $slug;
                $permission->display_name = $display_name;
                $permission->description = $description;
                $permission->save();
              }
              Session::flash('success', 'Permissions were all successfully added');
              return redirect()->route('permissions.index');
            }
          } else {
            return redirect()->route('permissions.create',  array('user' => Auth::user()))->withInput();
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
        $permission = Permission::findOrFail($permission->id);
      return view('manage.permissions.show',  array('user' => Auth::user()))->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
        $permission = Permission::findOrFail($permission->id);
      return view('manage.permissions.edit',  array('user' => Auth::user()))->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $id = $permission->id;
        $this->validateWith([
            'display_name' => 'required|max:255',
            'description' => 'sometimes|max:255'
          ]);
          $permission = Permission::findOrFail($id);
          $permission->display_name = $request->display_name;
          $permission->description = $request->description;
          $permission->save();
          Session::flash('success', 'Updated the '. $permission->display_name . ' permission.');
          return redirect()->route('permissions.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
