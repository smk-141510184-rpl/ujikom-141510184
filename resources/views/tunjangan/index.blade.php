@extends('layouts/app')
@section('content')
<center><h1>Data tunjangan pegawai</h1></center>
<hr>
<div class="col-md-11"></div>
<table class="table table-striped table bordered table-hover">
<table class="table table-default">
<tr class="danger">

<a href="{{url('/tunjangan/create')}}"class="btn btn-primary form-control">Tambah Data</a><br><br>

	<thead>
		<tr class="bg-info">
		<th>No</th>
		<th><center>Kode Tunjangan</center></th>
		<th><center>Jabatan</center></th>
		<th>Golongan</th>
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
		@foreach($tunjangan as $tunjangans)
		<tr>
			<td>{{$no++}}</td>
			<td>{{$tunjangans->kode_tunjangan}}</td>
			<td>{{$tunjangans->jabatanModel->nama_jabatan}}</td>
			<td>{{$tunjangans->golonganModel->nama_golongan}}</td>
			<td>{{$tunjangans->status}}</td>
			<td>{{$tunjangans->jumlah_anak}}</td>
			<td>{{$tunjangans->besaran_uang}}</td>
		<td><a href="{{route('tunjangan.edit',$tunjangans->id)}}" class="btn btn-warning">Update</a></td>	
		</td>
		<td>
		{!!Form::open(['method'=>'DELETE','route'=>['tunjangan.destroy',$tunjangans->id]])!!}
		
		<input type="submit" class="btn btn-danger" onclick="return confirm('anda yakin akan menghapus data?');"value="Delete"> 
		{!!Form::close()!!}
		</td>
		</tr>
		
		@endforeach

	</tbody>
</table>




@endsection