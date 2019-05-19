<?php

namespace App\Http\Controllers;

use App\RestHistory;
use Illuminate\Http\Request;

class RestHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RestHistory $model)
    {
        return view('resthistory.index', ['teams' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RestHistory  $RestHistory
     * @return \Illuminate\Http\Response
     */
    public function show(RestHistory $RestHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RestHistory  $RestHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(RestHistory $RestHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RestHistory  $RestHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RestHistory $RestHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RestHistory  $RestHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestHistory $RestHistory)
    {
        //
    }
}
