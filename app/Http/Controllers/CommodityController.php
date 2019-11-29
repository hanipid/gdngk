<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commodity;

class CommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!$this->authorize('browse', \App\Commodity::first()))
        //     redirect('/home');
        // $commodities[] = (object) ['id' => 1, 'name' => 'Cabai'];
        // $commodities[] = (object) ['id' => 2, 'name' => 'Kentang'];
        $commodities = Commodity::all();
        return view('commodity.index', compact('commodities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('commodity.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Commodity::create($request->all());
        return redirect('commodities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if ($id == 1) {
        //     $commodity = (object) ['id' => 1, 'name' => 'Cabai', 'rent' => 250];
        // } else {
        //     $commodity = (object) ['id' => 2, 'name' => 'Kentang', 'rent' => 250];
        // }
        $commodity = Commodity::find($id);

        // $grades[] = (object) ['id' => 1, 'commodity_id' => 1, 'name' => 'Kelas A', 'price' => 60000];
        // $grades[] = (object) ['id' => 2, 'commodity_id' => 1, 'name' => 'Kelas B', 'price' => 55000];
        $commodityGrades = CommodityGradeController::index($id);

        return view('commodity.show', compact('commodity', 'commodityGrades'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if ($id == 1) {
        //     $commodity = (object) ['id' => 1, 'name' => 'Cabai', 'rent' => 250];
        // } else {
        //     $commodity = (object) ['id' => 2, 'name' => 'Kentang', 'rent' => 250];
        // }

        $commodity = Commodity::find($id);

        return view('commodity.edit', compact('commodity'));
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
        Commodity::where('id', $id)->update($request->except(['_method', '_token']));
        return redirect('commodities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commodity::where('id', $id)->delete();
        return redirect('/commodities');
    }
}
