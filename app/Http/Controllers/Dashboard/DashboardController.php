<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //

    public function welcome() {
        if(App::isLocale('ar')){
            return view('dashboard-rtl');
        }

        return view('dashboard');
    }
}
