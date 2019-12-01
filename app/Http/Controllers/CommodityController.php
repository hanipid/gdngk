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
        if (auth()->user()->hasPermission('browse_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
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
        if (auth()->user()->hasPermission('add_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
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
        if (auth()->user()->hasPermission('add_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
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
        if (auth()->user()->hasPermission('read_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
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
        if (auth()->user()->hasPermission('edit_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

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
        if (auth()->user()->hasPermission('edit_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }

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
        if (auth()->user()->hasPermission('delete_commodities') === false) {
            return redirect('/home')->with('danger', 'You don\'t have permissions');
        }
        Commodity::where('id', $id)->delete();
        return redirect('/commodities');
    }
}
