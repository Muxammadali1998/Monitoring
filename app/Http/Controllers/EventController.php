<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Helpers\Traits\ApiResponcer;

class EventController extends Controller
{
    use ApiResponcer;
    public function event($id)
    {
        $worker = Event::where('worker_id', $id)->latest()->with('worker')->first();
        if(empty($worker->status)){
            $worker = Event::create(['worker_id'=>$id,'status'=>1, 'date'=>date('H:i:s')]);
            $worker = Event::with('worker')->find($worker->id);
            return $this->success($worker,"kirdi", 200);
        }else{
            $worker->status = 0;
            $worker->date = date('H:i:s');
            $worker->create($worker->toArray());
            return $this->success($worker,"chiqdi", 200);
        }
    }
}
