<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommodityGrade;

class CommodityGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    static function index($commodityId)
    {
        if (auth()->user()->hasPermission('browse_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $commodityGrades = CommodityGrade::where('commodity_id', $commodityId)->get();

        return $commodityGrades;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($commodityId)
    {
        if (auth()->user()->hasPermission('add_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        return view('commodity.grade.create', compact('commodityId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $commodityId)
    {
        if (auth()->user()->hasPermission('add_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        // 10.000,20 -> 10000,20
        $price = str_replace('.', '', $request->price);
        // 10000,20 -> 10000.20
        $price = str_replace(',', '.', $price);
        $price = (float) number_format($price, 2, '.', '');
        CommodityGrade::create([
            'commodity_id' => $request->commodity_id,
            'name' => $request->name,
            'price' => $price
        ]);
        return redirect('commodities/' . $commodityId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->hasPermission('read_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $commodityId)
    {
        if (auth()->user()->hasPermission('edit_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $commodityGrade = CommodityGrade::find($id);
        return view('commodity.grade.edit', compact('commodityGrade', 'commodityId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $commodityId)
    {
        if (auth()->user()->hasPermission('edit_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        // 10.000,20 -> 10000,20
        $price = str_replace('.', '', $request->price);
        // 10000,20 -> 10000.20
        $price = str_replace(',', '.', $price);
        $price = (float) number_format($price, 2, '.', '');
        // dd($price);
        CommodityGrade::where('id', $id)
            ->update([
            'name' => $request->name,
            'price' => $price
        ]);
        return redirect('commodities/'.$commodityId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $commodityId)
    {
        if (auth()->user()->hasPermission('delete_commodity_grades') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        CommodityGrade::find($id)->delete();
        return redirect('/commodities/' . $commodityId);
    }
}
