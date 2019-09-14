<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Image;
use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users'],
            'idnumber' => ['required', 'numeric', 'unique:users'],
        ]);

        if ($request->has('password') && !empty($request->password)) {
            // set password manually
            $password = trim($request->password);
        } else {
            // generate password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->idnumber = $request->idnumber;
        $user->password = Hash::make($password);

        if ($user->save()) {
            return redirect()->route('users.show', $user->id);
        } else {
            $request->session()->flash('danger', 'Sorry a problem occured while creating user. try again later or contact the developer');
            return redirect()->route('users.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)->with('roles')->first();
        return view('manage.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user = User::where('id', $user->id)->with('roles')->first();
        return view('manage.users.edit')->withUser($user)->withroles($roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users,phone,' . $user->id],
            'idnumber' => ['required', 'numeric', 'unique:users,idnumber,' . $user->id],
        ]);
        $id = $user->id;
        $user = User::findOrFail($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->idnumber = $request->idnumber;

        if ($request->password != '') {
            $user->password = $request->password;
        } else {
            // generate password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }
        $user->save();

        $user->syncRoles(explode(',', $request->roles));

        return redirect()->route('users.show', $id);
        // if () {
        //     return redirect()->route('users.show', $user->id);
        // } else {
        //     $request->session()->flash('danger', 'Sorry a problem occured while editing the  user. try again later or contact the developer');
        //     return redirect()->route('users.edit', $user->id);
        // }
    }

    public function profile(){
        return view('profile', array('user' => Auth::user()));
    }
    public function updateprofile(Request $request, User $user){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:users,phone,' . $user->id],
            'idnumber' => ['required', 'numeric', 'unique:users,idnumber,' . $user->id],
        ]); 
        $id = $user->id;
        echo
        $user = User::findOrFail($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->idnumber = $request->idnumber;

        if ($request->password != '') {
            $user->password = $request->password;
        } else {
            // generate password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }
        $user->save();

        return view('profile', array('user' => Auth::user()));
    }
    public function updateavatar(Request $request){

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return view('profile', array('user' => Auth::user()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
