<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\SystemUserSeller;
use App\Models\SystemUserBuyer;
use App\Models\CoreSection;
use App\Models\SystemUserGroup;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Components\Widget\Alert;
use Illuminate\Support\Facades\Session;

class SystemUserController extends Controller
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
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get()->pluck('user_group_name','user_group_id');
     
        $systemuser         = User::select('system_user.*', 'system_user_group.user_group_level')
        ->join('system_user_group', 'system_user.user_group_id', 'system_user_group.user_group_id')
        ->where('system_user.data_state', 0);
     
        if(!Session::get('user_group_id')){
            $user_group_id  = null;
            $systemuser     = $systemuser->get();
        }else{
            $user_group_id  = Session::get('user_group_id');
            $systemuser     = $systemuser->where('system_user.user_group_id', $user_group_id)->get();
        }

        return view('content/SystemUser/ListSystemUser',compact('systemuser', 'systemusergroup', 'user_group_id'));
    }

    public function filter(Request $request){
        $user_group_id     = $request->user_group_id;

        Session::put('user_group_id', $user_group_id);

        return redirect('/system-user');
    }

    public function addSystemUser(Request $request)
    {
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get();
        return view('content/SystemUser/FormAddSystemUser',compact('systemusergroup'));
    }

    public function processAddSystemUser(Request $request)
    {
        $fields = $request->validate([
            'name'                  => 'required',
            'full_name'             => 'required',
            'password'              => 'required',
            'user_group_id'         => 'required'
        ]);

        $user = User::create([
            'name'                  => $fields['name'],
            'full_name'             => $fields['full_name'],
            'password'              => Hash::make($fields['password']),
            'phone_number'          => $request->phone_number,
            'user_group_id'         => $fields['user_group_id'],
        ]);

        $msg = 'Tambah System User Berhasil';
        return redirect('/system-user/add')->with('msg',$msg);
    }

    public function editSystemUser($user_id)
    {
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get()->pluck('user_group_name','user_group_id');
        $systemuser         = User::where('user_id',$user_id)->first();
        return view('content/SystemUser/FormEditSystemUser',compact('systemusergroup', 'systemuser', 'user_id'));
    }

    public function processEditSystemUser(Request $request)
    {
        $fields = $request->validate([
            'user_id'                   => 'required',
            'name'                      => 'required',
            'full_name'                 => 'required',
            'password'                  => 'required',
            'user_group_id'             => 'required'
        ]);

        $user                   = User::findOrFail($fields['user_id']);
        $user->name             = $fields['name'];
        $user->full_name        = $fields['full_name'];
        $user->password         = Hash::make($fields['password']);
        $user->user_group_id    = $fields['user_group_id'];
        $user->phone_number     = $request->phone_number;

        if($user->save()){
            $msg = 'Edit System User Berhasil';
            return redirect('/system-user')->with('msg',$msg);
        }else{
            $msg = 'Edit System User Gagal';
            return redirect('/system-user')->with('msg',$msg);
        }
    }

    public function deleteSystemUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->data_state = 1;
        if($user->save())
        {
            $msg = 'Hapus System User Berhasil';
        }else{
            $msg = 'Hapus System User Gagal';
        }

        return redirect('/system-user')->with('msg',$msg);
    }

    public function getUserGroupName($user_group_id)
    {
        $usergroupname =  User::select('system_user_group.user_group_name')->join('system_user_group','system_user_group.user_group_id','=','system_user.user_group_id')->where('system_user.user_group_id','=',$user_group_id)->first();

        return $usergroupname['user_group_name'];
    }

    public function changePassword($user_id)
    {
        
        return view('content.SystemUser.FormChangePassword', compact('user_id'));

    }
    
    public function processChangePassword(Request $request)
    {
        
        // User::find(auth()->user()->user_id)->update([
        //     'password'=> Hash::make($request->new_password)
        //     ]);
       
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',

        ]);
        
        if(Hash::check($request->password, Auth::user()->password))
        {
            User::find(auth()->user()->user_id)->update([
            'password'=> Hash::make($request->new_password)
            ]);
            $msg = "Password Berhasil Diubah";
            return redirect()->back()->with('msg',$msg);
        }else{
            $msg = "Password Lama Tidak Cocok";
            return redirect()->back()->with('msg',$msg);
        }
    }

    public function detailSystemUserSeller($user_id){
        $systemuser         = User::where('user_id',$user_id)->first();
        $systemuserseller   = SystemUserSeller::where('user_id',$user_id)->first();
        return view('content/SystemUser/FormDetailSystemUserSeller',compact('systemuser', 'systemuserseller', 'user_id'));
    }

    public function detailSystemUserBuyer($user_id){
        $systemuser         = User::where('user_id',$user_id)->first();
        $systemuserbuyer    = SystemUserBuyer::where('user_id',$user_id)->first();
        return view('content/SystemUser/FormDetailSystemUserBuyer',compact('systemuser', 'systemuserbuyer', 'user_id'));
    }

    public function blokirSystemUser($user_id)
    {
        $user               = User::findOrFail($user_id);
        $user->user_status  = 1;
        $user->updated_id   = Auth::id();
        $user->updated_at   = date("Y-m-d H:i:s");
        
        if($user->save())
        {
            $msg = 'Blokir User Berhasil';
        }else{
            $msg = 'Blokir User Gagal';
        }

        return redirect('/system-user')->with('msg',$msg);
    }

    public function unblokirSystemUser($user_id)
    {
        $user               = User::findOrFail($user_id);
        $user->user_status  = 0;
        $user->blokir_id    = Auth::id();
        $user->blokir_at    = date("Y-m-d H:i:s");
        
        if($user->save())
        {
            $msg = 'Buka Blokir User Berhasil';
        }else{
            $msg = 'Buka Blokir User Gagal';
        }

        return redirect('/system-user')->with('msg',$msg);
    }
}
