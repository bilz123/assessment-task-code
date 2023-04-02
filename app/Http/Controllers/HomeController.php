<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //if vendor login
        if (auth()->user()->getRoleNames()->first() == 'vendor') {


            return view('home');
        }

        //if super admin login
        if (auth()->user()->getRoleNames()->first() == 'super_admin') {
           
            return view('admindashboard.dashboard');
        }

    }

}
