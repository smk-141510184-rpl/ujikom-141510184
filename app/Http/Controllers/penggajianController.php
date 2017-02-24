<?php

namespace App\Http\Controllers;

use App\penggajianModel;
use App\jabatanModel;
use DB;
use App\golonganModel;
use App\lembur_pegawaiModel;
use App\kategori_lemburModel;
use App\tunjangan_pegawaiModel;
use App\tunjanganModel;
use App\pegawaiModel;
use Input ;
use Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;

class penggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $penggajian=penggajianModel::all();
        $pegawai=pegawaiModel::all();
        $lembur_pegawai=kategori_lemburModel::all();
        $tunjangan_pegawai=tunjangan_pegawaiModel::all();
        return view('penggajian.index',compact('penggajian','pegawai','lembur_pegawai','tunjangan_pegawai'));
        //$penggajian = penggajianModel::with('tunjangan_pegawai')->get();
        //$tunjangan_pegawai = tunjangan_pegawaiModel::with('tunjangan')->first();
        //$tunjangan = tunjanganModel::where('id',$tunjangan_pegawai->kode_tunjangan_id)->first();
        //$pegawai = pegawaiModel::with('User')->first();
        //$users = User::where('id',$pegawai['user_id'])->first();
        //$penggajian = penggajianModel::all();
        //return view('penggajian.index',compact('penggajian','users','pegawai','tunjangan_pegawai','tunjangan'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pegawai=pegawaiModel::with('User')->get();
        $tunjangan_pegawai=tunjangan_pegawaiModel::all();
        return view('penggajian.create',compact('tunjangan_pegawai','pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $penggajian = Request::all();
        $tunjangan_pegawai = tunjangan_pegawaiModel::where('pegawai_id',$penggajian['pegawai_id'])->first();
        $kode_tunjangan_id = tunjangan_pegawaiModel::where('pegawai_id', $penggajian['pegawai_id'])->first();
        $user = $penggajian['pegawai_id'];

            $penggajian1 = penggajianModel::where('tunjangan_pegawai_id', $kode_tunjangan_id->id)->first();
        
        $jumlah_jam_lembur = DB::table('lembur_pegawai')
        ->where('lembur_pegawai.pegawai_id', '=', $user)
        ->sum('lembur_pegawai.jumlah_jam');
        $pegawai = pegawaiModel::where('id',$penggajian['pegawai_id'])->first();
        $kategori_lembur = kategori_lemburModel::where('jabatan_id',$pegawai->jabatan_id)->where('golongan_id',$pegawai->golongan_id)->first();
        $jabatan = jabatanModel::where('id',$pegawai->jabatan_id)->first();
        $golongan = golonganModel::where('id',$pegawai->golongan_id)->first();
        $lembur_pegawai = lembur_pegawaiModel::where('pegawai_id',$penggajian['pegawai_id'])->first();
        $gaji_pokok = jabatanModel::where('besaran_uang')->first();
        $tunjangan = tunjanganModel::where('id',$tunjangan_pegawai->kode_tunjangan_id)->first();

        $penggajian['tunjangan_pegawai_id']= $tunjangan_pegawai->id;
        $penggajian['jumlah_jam_lembur']= (int)$jumlah_jam_lembur;
        $penggajian['jumlah_uang_lembur']= $kategori_lembur->besaran_uang*(int)$jumlah_jam_lembur;
        $penggajian['gaji_pokok']= $jabatan->besaran_uang+$golongan->besaran_uang;
        $penggajian['total_gaji']= $penggajian['gaji_pokok']+$penggajian['jumlah_uang_lembur']+$tunjangan->besaran_uang;
        $penggajian['status_pengambilan']=0;
        penggajianModel::create($penggajian);
        
        return redirect('penggajian');

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
    }
}
