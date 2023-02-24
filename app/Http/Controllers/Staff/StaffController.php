<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Acceptor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        // $from = date('Y-m-d');
        // $to = Carbon::now()->addDays(7);
        // return Acceptor::whereBetween('return_date', [$from, $to])->get();

        $patients = Patient::whereHas('acceptor', function ($query) {
            $from = date('Y-m-d');
            $to = Carbon::now()->addDays(7);
            $query->whereBetween('return_date', [$from, $to])->orderBy('return_date', 'ASC');
        })->get();

        return view('staff.dashboard', [
            'patients' => $patients
        ]);
    }
}
