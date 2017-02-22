@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Edit Lembur Pegawai</h1></div>
                <div class="panel-body">

                     {!! Form::model($lembur_pegawai,['method'=>'PATCH','route'=>['lembur_pegawai.update',$lembur_pegawai->id]])!!}
                    <div class="col-md-6">
                        <label>Kode Lembur ID</label>
                        <input type="text" name="kode_jabatan" class="form-control" value="{{$lembur_pegawai->kategori_lemburModel->kode_lembur_id}}" >
                        <span class="help-block">
                            <strong>{{ $errors->first('kode_lembur_id') }}</strong>
                        </span>
                    </div>
                   <div class="col-md-6">
                        {!! Form::label('Jumlah Jam', 'Jumlah Jam') !!}
                        {!! Form::text('jumlah_jam',null,['class'=>'form-control']) !!}
                          @if ($errors->has('jumlah_jam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jumlah_jam') }}</strong>
                                    </span>
                            @endif
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-md-12">
                        {!! Form::submit('SAVE', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection