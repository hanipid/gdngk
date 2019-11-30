<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingGoods;
use App\User;
use App\CommodityGrade;
use App\Warehouse;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasPermission('browse_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $warehouse = Warehouse::find(3);
        // $warehouse = Warehouse::where('employee_id', auth()->user()->id);
        $incomingGoods = IncomingGoods::where('warehouse_id', $warehouse->id)
                            ->groupBy('farmer_id')->get();
                            // dd($incomingGoods);
        return view('stock.index', compact('incomingGoods', 'warehouse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermission('add_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $farmers = User::where('role_id', 3)->get();
        $commodityGrades = CommodityGrade::where('commodity_id', 4)
                            ->orderBy('name', 'asc')
                            ->get();
        return view('stock.create', compact('farmers', 'commodityGrades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasPermission('add_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $warehouse = Warehouse::where('user_id', auth()->user()->id)->first(); // satu petugas gudang hanya punya akses ke satu gudang
        $employee = auth()->user();
        for ($i=0; $i < count($request->commodityGradeId); $i++) { 
            if (isset($request->weight[$i]) AND $request->weight[$i] > 0) {
                IncomingGoods::create([
                    'employee_id' => $employee->id,
                    'farmer_id' => $request->farmer_id,
                    'warehouse_id' => $warehouse->id,
                    'commodity_grades_id' => $request->commodityGradeId[$i],
                    'weight' => $request->weight[$i]
                ]);
            }                
        }

        return redirect('/stocks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($warehouseId, $farmerId)
    {
        if (auth()->user()->hasPermission('read_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $incomingGoods = IncomingGoods::where('warehouse_id', $warehouseId)
                            ->where('farmer_id', $farmerId)
                            ->get();
        $farmer = User::find($farmerId);
        return view('stock.show', compact('incomingGoods', 'farmer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasPermission('edit_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $incomingGoods = IncomingGoods::find($id);
        return view('stock.edit', compact('incomingGoods'));
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
        if (auth()->user()->hasPermission('edit_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $request->validate([
            'weight' => 'required|numeric'
        ]);

        $incomingGoods = IncomingGoods::find($id);
        $incomingGoods->update([
            'weight' => $request->weight
        ]);
        return redirect('/stocks/' . $incomingGoods->warehouse_id . '/' . $incomingGoods->farmer_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermission('delete_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $incomingGoods = IncomingGoods::find($id);
        $tobeDeleted = IncomingGoods::where('warehouse_id', $incomingGoods->warehouse_id)
                                    ->where('farmer_id', $incomingGoods->farmer_id)->get()->toArray();
        $ids_to_delete = array_map(function($item){ return $item['id']; }, $tobeDeleted);
        IncomingGoods::whereIn('id', $ids_to_delete)->delete();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGrade($id)
    {
        if (auth()->user()->hasPermission('delete_incoming_goods') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        IncomingGoods::find($id)->delete();
        return back();
    }
}
