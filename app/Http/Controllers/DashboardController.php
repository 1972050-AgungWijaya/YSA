<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=DB::select('CALL view_siswa_kelas(?)',array(Auth::user()->siswa_id));
        // return $data;
        return view('dashboard',[
            'ukinfo'=>$data
        ]);
    }
    public function store(Request $request){
        $data=validator($request->all(),[
            'siswaid'=>'required'
        ])->validate();
        $user=Auth::user();
        $user->siswa_id=$data['siswaid'];
        $user->save();
        return redirect(route('dashboard'));
    }
}
