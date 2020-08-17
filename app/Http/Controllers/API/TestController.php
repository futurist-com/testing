<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Test;
use App\Http\Requests\StoreTestRequest;

class TestController extends Controller
{
    public function __construct(Test $test)
    {
        $this->test=$test;
    }
    /**
     * Display a listing of the resource.
     *@todo отдаем  тесты компании сделать  пагинацию  разбор  по группам и поиск 
     * @return \Illuminate\Http\Response
     */
    public function index($company)
    {
        return $this->test->all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request)
    {
        //
        $test=$this->test->create($request->all());
        return response()->json($test, 201);

        
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
