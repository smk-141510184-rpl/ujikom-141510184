<?php

namespace App\Http\Controllers;

use App\penggajianModel;
use App\jabatanModel;
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
        $penggajian=penggajianModel::paginate(5);
        return view('penggajian.index',compact('penggajian'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $tunjangan=tunjangan_pegawaiModel::all();
        return view('penggajian.create',compact('tunjangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tunjangan=Input::all();
        dd($tunjangan);
        $pegawai=pegawaiModel::all();
        $lembur_pegawai=lembur_pegawaiModel::all();

        if(isset($pegawai->lembur_pegawai->first()->id))

        {

            $penggajian['lembur_pegawai_id'] = $pegawai->tunjangan_pegawai->id;
            $kategori_lembur_id = $pegawai->lembur_pegawai->first()->kategori_lembur_id;
            $kategori_lembur = kategori_lemburModel::where('id',$kategori_lembur_id)->first();
            $penggajian['jumlah_jam_lembur']=0;
            $penggajian['jumlah_uang_lembur']=0;
            $uang_lembur = $kategori_lembur;
            foreach ($pegawai->lembur_pegawai as $data) {
                $penggajian['jumlah_jam_lembur']+=$data->jumlah_jam;
                $penggajian['jumlah_uang_lembur']+=$kategori_lembur->besaran_uang*$data->jumlah_jam;
            }

        }

        else

        {

            $penggajian['jumlah_jam_lembur']=0;
            $penggajian['jumlah_uang_lembur']=0;

        }
        $gaji_jabatan = $pegawai->jabatan->tunjangan_uang;
        $gaji_golongan = $pegawai->golongan->tunjangan_uang;
        if (isset($pegawai->tunjangan_pegawai->id))
        {

            $penggajian['tunjangan_pegawai_id']=$pegawai->tunjangan_pegawai->id;
            $tunjangan_pegawai = tunjangan_pegawaiModel::where('id',$pegawai->tunjangan_pegawai->id)->first();
        if (isset(Tunjangan::where('id',$pegawai->tunjangan_pegawai->kode_tunjangan_id)->first()->besaran_uang)) {

            $tunjangan = tunjanganModel::where('id',$pegawai->tunjangan_pegawai->kode_tunjangan_id)->first()->besaran_uang;
        }
        else{
            $tunjangan = 0;
        }
        }
        else{

            $tunjangan = 0;
            $penggajian['tunjangan_pegawai_id']=null;

        }

        $penggajian['gaji_pokok'] = $gaji_jabatan + $gaji_golongan;
        $penggajian['total_gaji'] = $penggajian['gaji_pokok']+$penggajian['jumlah_uang_lembur']+$tunjangan;
        if(!isset($penggajian['tunjangan_pegawai_id'])){
            return redirect('penggajian/'.'create'.'/?errors=notunjangan');

        }
        // dd($penggajian);
        $penggajian = penggajianModel::create($penggajian);
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
