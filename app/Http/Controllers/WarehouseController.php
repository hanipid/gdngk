<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\User;
use App\Commodity;
use Illuminate\Support\Facades\Storage;
use App\WarehouseCategory;
use App\District;
use App\Village;
use App\GoodsHistory;
use App\WarehouseReceipt;

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
        $warehouses = Warehouse::all();
        $users = User::where('role_id', 6)->get(); // pemilik_gudang
        $employees = User::where('role_id', 5)->get(); // petugas_gudang
        $array = [];
        foreach ($warehouses as $warehouse) {
            $array[] = $warehouse->employee_id;
        }
        $employees = $employees->except($array);
        $commodities = Commodity::all();
        $warehouseCategories = WarehouseCategory::all();
        $districts = District::all();
        $villages = Village::all();
        return view('warehouse.create', compact('users', 'commodities', 'employees', 'districts', 'villages', 'warehouseCategories'));
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
            'unit_area' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
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
        $warehouseReceipts = WarehouseReceipt::where('warehouse_id', $warehouse->id)
                                ->orderBy('created_at', 'desc')
                                ->get();
        $goodsHistories = GoodsHistory::where('warehouse_id', $warehouse->id)
										->orderBy('created_at', 'desc')
                                        ->get();
        return view('warehouse.show', compact('warehouse', 'goodsHistories', 'warehouseReceipts'));
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
        $warehouses = Warehouse::all();
        $warehouse = Warehouse::find($id);
        $users = User::where('role_id', 6)->get(); // pemilik_gudang
        $employees = User::where('role_id', 5)->get(); // petugas_gudang
        $array = [];
        foreach ($warehouses as $wh) {
            if ($wh->employee_id != $warehouse->employee_id) {
                $array[] = $wh->employee_id;
            }
        }
        $employees = $employees->except($array);
        $commodities = Commodity::all();
        $warehouseCategories = WarehouseCategory::all();
        $districts = District::all();
        $villages = Village::all();
        return view('warehouse.edit', compact('users', 'employees', 'commodities', 'warehouse', 'warehouseCategories', 'districts', 'villages'));
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
            'unit_area' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required',
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
            'employee_id' => $request->employee_id,
            'commodity_id' => $request->commodity_id,
            'warehouse_category_id' => $request->warehouse_category_id,
            'number_date' => $request->number_date,
            'capacity' => $request->capacity,
            'unit_area' => $request->unit_area,
            'address' => $request->address,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'information' => $request->information,
            'photo' => $fullPhoto,
        ]);
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

    public function print($id)
    {
        $warehouseReceipt = WarehouseReceipt::find($id);
        return view('warehouse.print', compact('warehouseReceipt'));
    }
}
