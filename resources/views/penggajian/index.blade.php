@extends('layouts/app')
@section('content')
<center><h1>Penggajian Data</h1></center>
<hr>
<div class="col-md-11">
	<table class="table table-striped table-bordered table-hover">
<table class="table table-striped table-hover table-bordered">
<tr class="danger">

<a href="{{url('/penggajian/create')}}"class="btn btn-primary form-control">Tambah Data</a><br><br>

	<thead>
		<tr class="bg-info">
		<th>No</th>
		<th><center>Tunjangan</center></th>
		<th colspan="2"><center>Jumlah Jam Lembur Uang Lembur</center></th>
		<th>Gaji Pokok</th>
		<th><center>Total Gaji</center></th>
		<th><center>Tanggal Pengambilan</center></th>
		<th><center>Status Pengambilan</center></th>
		<th><center>Petugas Penerima</center></th>
			
		</tr>
	</thead>
	<tbody>
		@php
		$no=1;
		@endphp
		@foreach($penggajian as $gaji)
		<tr class="bg-danger">
			<td>{{$no++}}</td>
			<td>{{$gaji->tunjangan_pegawaiModel->tunjanganModel->besaran_uang}}</td>
<<<<<<< HEAD
			<td>{{$gaji->jumlah_jam_lembur}}</td>
			<td>{{$gaji->jumlah_uang_lembur}}</td>
			<td>{{$gaji->gaji_pokok}}</td>
			<td>{{$gaji->total_gaji}}</td>
			<td></td>
			<td></td>
			<td></td>
=======
			<td>{{$gaji->$penggajian->jumlah_jam_lembur}}</td>
			<td>{{$gaji->$penggajian->jumlah_uang_lembur}}</td>
			<td>{{$gaji->$penggajian->gaji_pokok}}</td>
			<td>{{$gaji->$penggajian->total_gaji}}</td>
		<td><a href="{{route('penggajian.edit',$penggajians->id)}}" class="btn btn-warning">Update</a></td>	
		</td>
		<td>
		{!!Form::open(['method'=>'DELETE','route'=>['penggajian.destroy',$gaji->id]])!!}
		
		<input type="submit" class="btn btn-danger" onclick="return confirm('anda yakin akan menghapus data?');"value="Delete"> 
		{!!Form::close()!!}
		</td>
>>>>>>> 905a8e4812607708fc35103817402f4905128f4e
		</tr>
		
		@endforeach

	</tbody>
</table>

</div>




@endsection