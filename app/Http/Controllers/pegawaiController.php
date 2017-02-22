<?php

namespace App\Http\Controllers;

use App\pegawaiModel;
use App\User;
use App\golonganModel;
use App\jabatanModel;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Request;



class pegawaiController extends Controller
{
    use RegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
         $pegawai=pegawaiModel::paginate(5);
        return view('pegawai.index',compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       $user=User::all();
            $jabatan=jabatanModel::all();
            $golongan=golonganModel::all();
        return view('pegawai.create',compact('pegawai','golongan','jabatan'));
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
        $rules = array('email' => 'required|unique:users',
                        'password' => 'required|min:6|confirmed',
                        'name' => 'required',
                        'permision' =>'required',
                        'nip' => 'required|min:11|numeric|unique:pegawai',
                        'jabatan_id' =>'required',
                        'golongan_id' => 'required',
                        'foto' => 'required',
                         );

        $message =array('email.unique' =>'Gunakan Email Lain' ,
                        'name.required' =>'Wajib Isi',
                        'email.required' =>'Wajib Isi',
                        'password.unique' =>'wajib isi',
                        'permision.confirmed' =>'Masukan Password Yang Benar',
                        'permision.required' =>'Wajib isi',
                        'nip.unique' =>'Gunakan Nip Lain',
                        'nip.required' =>'Wajib isi',
                        'nip.min' =>'Min 11',
                        'nip.numeric' =>'Input Dengan Angka',
                        'jabatan_id.required' =>'Wajib isi',
                        'golongan_id.required' =>'Wajib isi');


        $val=validator::make(Input::all(),$rules,$message);
        if($val->fails())
        {
            return redirect()->back()
            ->withErrors($val)
            ->withInput();

        }

        $akun=new User ;
        $akun->name=Input::get('name');
        $akun->email=Input::get('email');
        $akun->password=bcrypt(Input::get('password'));
        $akun->permision=Input::get('permision');
        $akun->save();
        
        $file= Input::file('foto');
        $destination= public_path().'/assets/image/';
        $filename=$file->getClientOriginalName();
        $uploadsuccess=$file->move($destination,$filename);
        if(Input::hasFile('foto')){
            

                $pegawai=new pegawaiModel ;
                $pegawai->nip=Input::get('nip');
                $pegawai->foto=$filename;
                $pegawai->jabatan_id=Input::get('jabatan_id');
                $pegawai->golongan_id=Input::get('golongan_id');
                $pegawai->user_id=$akun->id;
                $pegawai->save();
                return redirect('pegawai');
        }
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
        
        $pegawai=pegawaiModel::find($id);
        $jabatan=jabatanModel::all();
        $golongan=golonganModel::all();
        $user=User::all();
         // $user=User::where('id',$pegawai->user_id)->first();
        
        return view('pegawai.edit',compact('pegawai','jabatan','golongan','user'));
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
        $cariid=pegawaiModel::find($id);
        if ($cariid->nip != Request('nip')) {
            $rules = array('email' => 'required|unique:users',
                        'password' => 'required|min:6|confirmed',
                        'name' => 'required',
                        'permision' =>'required',
                        'nip' => 'required|min:11|numeric|unique:pegawai',
                        'jabatan_id' =>'required',
                        'golongan_id' => 'required',
                        'foto' => 'required',
                         );
        }
        else{

            $rules = array('email' => 'required',
                            'password' => 'required|min:6|confirmed',
                            'name' => 'required',
                            'permision' =>'required',
                            'nip' => 'required|min:11|numeric',
                            'jabatan_id' =>'required',
                            'golongan_id' => 'required',
                            'foto' => 'required',
                             );
        }

        $message =array('email.unique' =>'Gunakan Email Lain' ,
                        'name.required' =>'Wajib Isi',
                        'email.required' =>'Wajib Isi',
                        'password.unique' =>'wajib isi',
                        'permision.confirmed' =>'Masukan Password Yang Benar',
                        'permision.required' =>'Wajib isi',
                        'nip.unique' =>'Gunakan Nip Lain',
                        'nip.required' =>'Wajib isi',
                        'nip.min' =>'Min 11',
                        'nip.numeric' =>'Input Dengan Angka',
                        'jabatan_id.required' =>'Wajib isi',
                        'golongan_id.required' =>'Wajib isi');

        $val=validator::make(Input::all(),$rules,$message);
        if($val->fails())
        {
            return redirect('pegawai/'.$cariid->id.'/edit')
            ->withErrors($val)
            ->withInput();

        }
        //$update=Request::all();
        //$pegawai=User::find($id);
        // // $user=User::where('id',$pegawai->user_id) ;
        // // dd($user);
        // // $user=User::find($pegawai->user_id);
        // $user->update($update);
        //$pegawai->update($update);
        //return redirect('pegawai');

        $user=User::find($pegawai->user_id);
        $user->name = Request('name');
        $user->type_user = Request('permision');
        $user->email = Request('email');
        $user->save();
        
        $file= Input::file('foto');
        $destination= '/assets/image/';
        $filename=$file->getClientOriginalName();
        $uploadsuccess=$file->move($destination,$filename);
        if($uploadsuccess){

        
            $pegawai =Pegawai::find($id);
            $pegawai->nip = Request('nip');
            $pegawai->permision = $user->id;
            $pegawai->jabatan_id = Request('jabatan_id');
            $pegawai->golongan_id = Request('golongan_id');
            $pegawai->foto=$filename;
            $pegawai->update();
        return redirect('pegawai');
        }
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
         pegawaiModel::find($id)->delete();
        return redirect('pegawai');
    }
}
