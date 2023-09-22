<?php

namespace App\Http\Controllers;

use App\Models\Expired;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;

class ExpiredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $expired = Expired::where('data_state', '=', 0)->get();
        return view('content/Expired/ListExpired', ['expired' => $expired]);
        // return view('content/Expired/ListExpired', compact('results'));
    }

    public function showExpiredDate()
    {

    }
}