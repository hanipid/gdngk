<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\User;
use App\Commodity;
use Illuminate\Support\Facades\Storage;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasPermission('browse_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $warehouses = Warehouse::all();
        // dd($warehouses);
        return view('warehouse.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermission('add_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $users = User::where('role_id', 6)->get();
        $commodities = Commodity::all();
        return view('warehouse.create', compact('users', 'commodities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasPermission('add_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $request->validate([
            'capacity' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required'
        ]);

        $photo = null;
        $path = 'warehouses';

        if ($request->hasFile('photo') and $request->file('photo')->isValid()) {
            $photo = $request->address . $request->user_id . $request->commodity_id .'.'.$request->photo->getClientOriginalExtension();
            $request->photo->storeAs($path, $photo);
        }
        // dd($request->photo);
        Warehouse::create($request->all());
        return redirect('/warehouses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermission('read_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $warehouse = Warehouse::find($id);
        return view('warehouse.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasPermission('edit_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $users = User::where('role_id', 6)->get();
        $commodities = Commodity::all();
        $warehouse = Warehouse::find($id);
        return view('warehouse.edit', compact('users', 'commodities', 'warehouse'));
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
        if (auth()->user()->hasPermission('edit_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $request->validate([
            'capacity' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required'
        ]);

        $warehouse = Warehouse::find($id);

        $path = 'warehouses';
        $photo = str_replace($path . '/', '', $warehouse->photo);

        $fullPhoto = $path . '/'. $photo;

        if ($request->hasFile('photo') and $request->file('photo')->isValid()) {
            if ($warehouse->photo != $path . '/default.png') {
                Storage::delete($warehouse->photo);
            }
            $photo = $request->address . $request->user_id . $request->commodity_id .'.'.$request->photo->getClientOriginalExtension();
            $request->photo->storeAs($path, $photo);
            $fullPhoto = $request->photo;
        }

        Warehouse::find($id)->update([
            'user_id' => $request->user_id,
            'commodity_id' => $request->commodity_id,
            'capacity' => $request->capacity,
            'address' => $request->address,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'information' => $request->information,
            'photo' => $fullPhoto,
        ]);
        return redirect('/warehouses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermission('delete_warehouses') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $warehouse = Warehouse::find($id);
        if (isset($warehouse->photo) AND $warehouse->photo != 'warehouses/default.png') {
            Storage::delete($warehouse->photo);
        }
        $warehouse->delete();
        return redirect('/warehouses');
    }
}
