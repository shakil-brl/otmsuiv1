<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardDetailsController extends Controller
{
    // 
    public function totalBatches()
    {
        return view('dashboard_details.total_batches');
    }

    // 
    public function runningBatches()
    {
        return view('dashboard_details.running_batches');
    }

    // 
    public function completeBatches()
    {
        return view('dashboard_details.complete_batches');
    }

    // 
    public function districts()
    {
        return view('dashboard_details.districts');
    }

    // 
    public function upazilas()
    {
        return view('dashboard_details.upazilas');
    }

    // 
    public function partners()
    {
        return view('dashboard_details.partners');
    }

    // 
    public function trainers()
    {
        return view('dashboard_details.trainers');
    }

    // 
    public function trainees()
    {
        return view('dashboard_details.trainees');
    }

    // 
    public function allowance()
    {
        return view('dashboard_details.allowance');
    }
}
