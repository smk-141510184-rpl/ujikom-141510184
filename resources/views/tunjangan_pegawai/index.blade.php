@extends('layouts/app')
@section('content')
<div class="container">
<<<<<<< HEAD
<center><h1>Data tunjangan pegawai</h1></center>
<div class="col-md-9">
<table class="table table-striped table-bordered table-hover">
<tr class="danger">

=======
<div class="col-md-10">
	<div class="panel panel-default">
	<div class="panel-heading">
		<center><h1>Data tunjangan pegawai</h1></center>
	</div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover">
>>>>>>> 905a8e4812607708fc35103817402f4905128f4e
<a href="{{url('/tunjangan_pegawai/create')}}" class="btn btn-primary form-control">Tambah Data</a><br><br>

	<thead>
		<tr class="bg-info">
		<th>No</th>
		<th><center>Kode Tunjangan ID</center></th>
		<th><center>Nip</center></th>
		<th><center>Nama pegawai</center></th>
		<th colspan="2">Jabatan dan Golongan</th>
		<th><center>Status</center></th>
		<th><center>Jumalah anak</center></th>
		<th><center>Besaran uang</center></th>
		<th colspan="2">Action</th>
			
		</tr>
	</thead>
	<tbody>
		@php
		$no=1;
		@endphp
		@foreach($tunjangan_pegawai as $tunjangan_pegawais)
		<tr class="bg-danger">
			<td>{{$no++}}</td>
			<td>{{$tunjangan_pegawais->tunjanganModel->kode_tunjangan}}</td>
			<td>{{$tunjangan_pegawais->pegawaiModel->nip}}</td>
			<td>{{$tunjangan_pegawais->pegawaiModel->User->name}}</td>
			<td>{{$tunjangan_pegawais->pegawaiModel->jabatanModel->nama_jabatan}}</td>
			<td>{{$tunjangan_pegawais->pegawaiModel->golonganModel->nama_golongan}}</td>
			<td>{{$tunjangan_pegawais->tunjanganModel->status}}</td>
			<td>{{$tunjangan_pegawais->tunjanganModel->jumlah_anak}}</td>
			<?php $tunjangan_pegawais->tunjanganModel->besaran_uang=number_format($tunjangan_pegawais->tunjanganModel->besaran_uang,2,',','.') ?>
			<td>{{$tunjangan_pegawais->tunjanganModel->besaran_uang}}</td>
		<td><a href="{{route('tunjangan_pegawai.edit',$tunjangan_pegawais->id)}}" class="btn btn-warning">Update</a></td>	
		<td>
		{!!Form::open(['method'=>'DELETE','route'=>['tunjangan_pegawai.destroy',$tunjangan_pegawais->id]])!!}
		
		<input type="submit" class="btn btn-danger" onclick="return confirm('anda yakin akan menghapus data?');"value="Delete"> 
		{!!Form::close()!!}
		</td>
		</tr>
		
		@endforeach

	</tbody>
</table>
</div>
<<<<<<< HEAD
</div>
=======


		</div>
	</div>
</div>


>>>>>>> 905a8e4812607708fc35103817402f4905128f4e

@endsection