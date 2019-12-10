<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IncomingGoods;
use App\WarehouseReceipt;
use App\StoredGoods;
use App\GoodsHistory;

class WarehouseReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasPermission('browse_receipts') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $incomingGoods = IncomingGoods::groupBy('farmer_id')
                                        ->selectRaw('sum(weight) as sum_weight, farmer_id, commodity_grade_id, warehouse_id, employee_id, status, created_at, updated_at')
                                        ->get();
        // dd($incomingGoods);
        return view('receipt.index', compact('incomingGoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $farmer_id
     * @return \Illuminate\Http\Response
     */
    public function create($farmer_id)
    {
        $incomingGoods = IncomingGoods::where('farmer_id', $farmer_id)->get();
        return view('receipt.create', compact('incomingGoods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // WarehouseReceipt
        WarehouseReceipt::create([
            'warehouse_id' => $request->warehouse_id,
            'warehouse_employee_id' => $request->warehouse_employee_id,
            'admin_employee_id' => $request->admin_employee_id,
            'farmer_id' => $request->farmer_id,
            'receipt_number' => $request->receipt_number,
            'warehouse_rental' => saveMoney($request->warehouse_rental),
            'date' => $request->date,
            'status' => 'diverifikasi'
        ]);

        $latestWarehouseReceipt = WarehouseReceipt::orderby('created_at', 'desc')->first();
        for ($i=0; $i < count($request->commodity_grade_id); $i++) { 
            // StoredGoods
            StoredGoods::create([
                'warehouse_receipt_id' => $latestWarehouseReceipt->id,
                'commodity_grade_id' => $request->commodity_grade_id[$i],
                'date' => $request->date,
                'weight' => $request->goods_weight[$i],
                'asking_price' => saveMoney($request->goods_price[$i]),
                'status' => 'diverifikasi',
            ]);
        }            

        $storedGoods = StoredGoods::where('warehouse_receipt_id', $latestWarehouseReceipt->id)
                                    ->get();
        foreach ($storedGoods as $goods) {
            // GoodsHistory
            GoodsHistory::create([
                'stored_goods_id' => $goods->id,
                'employee_id' => $request->warehouse_employee_id,
                'farmer_id' => $request->farmer_id,
                'warehouse_id' => $request->warehouse_id,
                'commodity_grade_id' => $goods->commodity_grade_id,
                'weight' => $goods->weight,
                'status' => 'diverifikasi'
            ]);
        }

        // Remove Incoming Goods
        $incomingGoods = IncomingGoods::where('farmer_id', $request->farmer_id)
                                    ->where('warehouse_id', $request->warehouse_id)
                                    ->get();
        foreach ($incomingGoods as $goods) {
            $goods->delete();
        }

        return redirect('/receipts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
