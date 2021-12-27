<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use DB;
use Auth;
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Siswa::all();
        return view('siswa.index',[
            'sList'=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $s=DB::select('CALL view_profile(?)',array($siswa->id));
        return view('siswa.index',[
            'siswa'=>$s,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $data=validator($request->all(),[
            'fotoprofil'=>'',
            'alamat'=>''
        ])->validate();
        $user=Auth::user();
        if ($request->fotoprofil){
            $imageName=$request->siswa_id.'.'.$request->fotoprofil->getClientOriginalExtension();
            $user->fotoprofil=$imageName;

            $request->fotoprofil->move(public_path('/uploadedimages'), $imageName);
        } 
        $siswa->alamat=$data['alamat'];
        $siswa->user->save();
        $siswa->save();
        return redirect(route('profileshow',['id'=>$request->siswa_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
