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
        // $grades[] = (object) ['id' => 1, 'commodity_id' => 1, 'name' => 'Kelas A', 'price' => 60000];
        // $grades[] = (object) ['id' => 2, 'commodity_id' => 1, 'name' => 'Kelas B', 'price' => 55000];
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $commodityId)
    {
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
        CommodityGrade::find($id)->delete();
        return redirect('/commodities/' . $commodityId);
    }
}
