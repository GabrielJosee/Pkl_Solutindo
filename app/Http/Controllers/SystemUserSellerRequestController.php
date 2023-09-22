<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PublicController;
use App\Providers\RouteServiceProvider;
use App\Models\InvtItemCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SystemUserSellerRequestController extends PublicController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('sess_sellerrequesttoken');
        Session::forget('data_systemuserseller');
        $sellerrequest = User::select('system_user.name', 'system_user_seller.*')
        ->join('system_user_seller', 'system_user_seller.user_id', 'system_user.user_id')
        ->join('system_user_group', 'system_user_group.user_group_id', 'system_user.user_group_id')
        ->where('system_user_group.user_group_level', 2)
        ->where('system_user.seller_status', 0)
        ->get();

        return view('content/SystemUserSellerRequest/ListSystemUserSellerRequest',compact('sellerrequest'));
    }

    public function acceptSystemUserSellerRequest($user_id)
    {
        $item                   = User::findOrFail($user_id);
        $item->seller_status    = 1;
        $item->updated_id       = Auth::id();
        
        if($item->save())
        {
            $msg = 'Menyetujui Seller Berhasil';
        }else{
            $msg = 'Menyetujui Seller Gagal';
        }

        return redirect('/seller-request')->with('msg',$msg);
    }

    public function rejectSystemUserSellerRequest($user_id)
    {
        $item                   = User::findOrFail($user_id);
        $item->seller_status    = 2;
        $item->updated_id       = Auth::id();
        
        if($item->save())
        {
            $msg = 'Menolak Seller Berhasil';
        }else{
            $msg = 'Menolak Seller Gagal';
        }

        return redirect('/seller-request')->with('msg',$msg);
    }
}
