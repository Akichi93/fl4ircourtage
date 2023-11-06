<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOkRequest;
use App\Http\Requests\UpdateOkRequest;
use App\Models\Ok;

class OkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ok  $ok
     * @return \Illuminate\Http\Response
     */
    public function show(Ok $ok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ok  $ok
     * @return \Illuminate\Http\Response
     */
    public function edit(Ok $ok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOkRequest  $request
     * @param  \App\Models\Ok  $ok
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOkRequest $request, Ok $ok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ok  $ok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ok $ok)
    {
        //
    }
}
