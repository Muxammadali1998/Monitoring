<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Helpers\Traits\ApiResponcer;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    use ApiResponcer;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Worker::all(),'',200);
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
        $data=Validator::make($request->all(), [
            'name'=>'required', 
            'job'=>'required',
            'phone'=>'required | unique:workers',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
        Worker::create($request->all());
        return $this->success('','create',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        $worker = Worker::with('events')->find($worker->id);
        return $this->success($worker,'',200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $data=Validator::make($request->all(), [
            'name'=>'required', 
            'job'=>'required',
            'phone'=>'required | unique:workers,phone,'.$worker->id,
        ]);
       if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
        $worker->update($request->all());
        return $this->success('','update',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        return $this->success($worker->delete,'delete',200);
    }
}
