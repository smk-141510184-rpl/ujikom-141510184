<?php

namespace App\Http\Controllers;

use App\pegawaiModel;
use Input ;
use Illuminate\Http\Request ;
use App\tunjanganModel;
use App\golonganModel;
use App\jabatanModel;
use Validator;

class tunjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tunjangan=tunjanganModel::all();
        return view('tunjangan.index',compact('tunjangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tunjangan=tunjanganModel::all();
        $golongan=golonganModel::all();
        $jabatan=jabatanModel::all();
        
        return view('tunjangan.create',compact('tunjangan','jabatan','golongan'));
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
        $definisi=['kode_tunjangan'=>'required|unique:tunjangan',
                   'jabatan_id'=>'required',
                   'golongan_id'=>'required',
                   ];


        $sms=['kode_tunjangan.required'=>'tidak boleh kosong',
               'kode_tunjangan.unique'=>'data tidak boleh sama',
               'kode_tunjangan.required'=>'tidak boleh kosong',
               'jabatan_id.required'=>'tidak boleh kosong',
               'golongan_id.required'=>'tidak boleh kosong', 
               

               ];
        $kirim=Validator::make(Input::all(),$definisi,$sms);
        if ($kirim->fails()) {
            return redirect('tunjangan/create')->withErrors($kirim)->withInput();
        }
        
            

       $tunjangan=Request::all();
        kategori_lemburModel::create($tunjangan);
        return redirect('tunjangan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tunjangan=tunjanganModel::all();
        return view('tunjangan.edit',compact('tunjangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $Update=Request::all();
        $tunjangan=tunjanganModel::find($id);
        $tunjangan->update($Update);
        return redirect('tunjangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        tunjanganModel::find($id)->delete();
        return redirect('tunjangan');
    }
}
