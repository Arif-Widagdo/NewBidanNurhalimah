<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role->slug === 'administrator') {
            if (auth()->user()->staff->position->slug === 'admin') {
                return redirect(route('admin.dashboard'));
            } else {
                return redirect(route('staff.dashboard'));
                // return redirect(route('patients.index'));
            }
        } else {
            return redirect(route('patient.dashboard'));
        }
    }

    public function profile()
    {
        if (auth()->user()->role->slug === 'administrator') {
            if (auth()->user()->staff->position->slug === 'admin') {
                return redirect(route('admin.profile.edit'));
            } else {
                return redirect(route('staff.profile.edit'));
            }
        } else {
            return redirect(route('patient.profile.edit'));
        }
    }
}
