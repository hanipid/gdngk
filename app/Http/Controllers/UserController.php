<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasPermission('browse_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $users = User::all();
        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermission('add_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $roles = Role::all();
        return view('users/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasPermission('add_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'unique:users|email:rfc,dns',
            'nik' => 'numeric',
            'password' => 'required|confirmed|min:6',
        ]);

        $avatar = null;
        $path = 'users';

        if ($request->hasFile('avatar') and $request->file('avatar')->isValid()) {
            $avatar = $request->nik .'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs($path, $avatar);
        }

        User::create($request->all());

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermission('read_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $user = User::find($id);
        return view('users/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasPermission('edit_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

        $user = User::find($id);
        $roles = Role::all();

        return view('users/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermission('edit_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

        $user = User::find($id);
        // dd(array_filter($request->except(['_method'])));
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'sometimes|email:rfc,dns|unique:users,email,' . $id,
            'nik' => 'numeric'
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => 'confirmed|min:6'
            ]);
        }

        $path = 'users';
        $avatar = str_replace($path . '/', '', $user->avatar);

        // dd($avatar);

        if ($request->hasFile('avatar') and $request->file('avatar')->isValid()) {
            if ($user->avatar != 'users/default.png') {
                Storage::delete($user->avatar);
            }
            $avatar = $request->nik .'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs($path, $avatar);
        }

        if (trim($request->password) != '') {
            User::where('id', $id)
                    ->update([
                        'role_id' => $request->role_id,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'nik' => $request->nik,
                        'name' => $request->name,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'company' => $request->company,
                        'bank' => $request->bank,
                        'bank_account' => $request->bank_account,
                        'avatar' => $path . '/' . $avatar
                    ]);
        } else {
            User::where('id', $id)
                    ->update([
                        'role_id' => $request->role_id,
                        'email' => $request->email,
                        'nik' => $request->nik,
                        'name' => $request->name,
                        'address' => $request->address,
                        'phone' => $request->phone,
                        'company' => $request->company,
                        'bank' => $request->bank,
                        'bank_account' => $request->bank_account,
                        'avatar' => $path . '/' . $avatar
                    ]);
        }

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermission('browse_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        
        $user = User::find($id);

        if (isset($user->avatar) AND $user->avatar != 'users/default.png') {
            Storage::delete($user->avatar);
        }
        $user->delete();
        return redirect('/users')->with('status', 'Data berhasil dihapus!');
    }
}
