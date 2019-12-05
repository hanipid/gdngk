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
        $users = User::where('role_id', '>', 1)->get();
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
        $roles = Role::where('id', '>', 1)->get();
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
            'nik' => 'unique:users|numeric',
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
        $roles = Role::where('id', '>', 1)->get();

        return view('users/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->hasPermission('edit_users') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

        $user = User::find($user->id);
        // dd(array_filter($request->except(['_method'])));
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'sometimes|email:rfc,dns|unique:users,email,' . $user->id,
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

        $role_id = $request->role_id ? $request->role_id : $user->role_id;
        $email = $request->email ? $request->email : $user->email;
        $nik = $request->nik ? $request->nik : $user->nik;
        $name = $request->name ? $request->name : $user->name;
        $address = $request->address ? $request->address : $user->address;
        $phone = $request->phone ? $request->phone : $user->phone;
        $company = $request->company ? $request->company : $user->company;
        $bank = $request->bank ? $request->bank : $user->bank;
        $bank_account = $request->bank_account ? $request->bank_account : $user->bank_account;

        if (trim($request->password) != '') {
            User::where('id', $user->id)
                    ->update([
                        'role_id' => $role_id,
                        'email' => $email,
                        'password' => Hash::make($request->password),
                        'nik' => $nik,
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                        'company' => $company,
                        'bank' => $bank,
                        'bank_account' => $bank_account,
                        'avatar' => $path . '/' . $avatar
                    ]);
        } else {
            User::where('id', $user->id)
                    ->update([
                        'role_id' => $role_id,
                        'email' => $email,
                        'nik' => $nik,
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                        'company' => $company,
                        'bank' => $bank,
                        'bank_account' => $bank_account,
                        'avatar' => $path . '/' . $avatar
                    ]);
        }

        // return redirect('/users');
        return back();
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
