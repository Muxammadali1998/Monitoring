<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Traits\ApiResponcer;
use App\Models\Worker;
use App\Models\Event;
use Carbon\Carbon;

class SearchController extends Controller
{
    use ApiResponcer;

    public function search($data)
    {
        $workers = Worker::where('name', 'like', '%'.$data.'%')
            ->orWhere('job', 'like', '%'.$data.'%')
            ->orWhere('phone', 'like', '%'.$data.'%')->get();
        return $this->success($workers,'',200);
    }

    public function daily($day)
    {
        $daily = Event::whereDay('created_at', $day)->get();
        return $this->success($dataToday,'',200);
    }

    public function weekly()
    {
        $weekly = Event::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return $this->success($weekly,'',200);
    }

    public function monthly($month)
    {
        $monthly = Event::whereMonth('created_at', $month)->get();
        return $this->success($monthly,'',200);
    }

    public function yearly($year)
    {
        $year = Event::whereYear('created_at', $year)->get();
        return $this->success($year,'',200);

    }
}
