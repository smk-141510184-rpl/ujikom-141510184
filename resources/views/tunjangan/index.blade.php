<!DOCTYPE html>
<html>
@extends('layouts/app')
@section('content')
<head>
	<title>Tunjangan</title>
</head>
<style type="text/css">
    div{
    background-image: url("large.jpg");
    }
    .panel-body{

        color: #663333;
    }
    .panel-default{
     border: 2px solid black;
     background-color: #99CCFF;
     box-shadow: 7px 7px 10px;
   }
</style>
<body>
<div class="col-md-3 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3><font color="#ff33cc">Halaman</font></h3>
                <div class="collapse navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-center">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="" href="{{ url('/login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>


                <div class="panel-body" align="center">
                    
                    <a class="btn btn-success form-control" href="{{url('jabatan')}}">Jabatan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('golongan')}}">Golongan</a><hr>
                    <a class="btn btn-danger form-control" href="{{url('pegawai')}}">Pegawai</a><hr>
                    <a class="btn btn-warning form-control" href="{{url('kategori_lembur')}}">Kategori Lembur</a><hr>
                    <a class="btn btn-info form-control" href="{{url('lembur_pegawai')}}">Lembur Pegawai</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjangan')}}">Tunjangan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjangan_pegawai')}}">Tunjangan Karyawan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('penggajian')}}">Penggajian Karyawan</a><hr>  
  

                </div>
            </center>
        </div>
    </div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading"><center><h1><font color="#FF0000">Tunjangan</font></h1></center></div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover">
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
					<tr class="bg-danger">
						<td>{{$no++}}</td>
						<td>{{$tunjangans->kode_tunjangan}}</td>
						<td>{{$tunjangans->jabatanModel->nama_jabatan}}</td>
						<td>{{$tunjangans->golonganModel->nama_golongan}}</td>
						<td>{{$tunjangans->status}}</td>
						<td>{{$tunjangans->jumlah_anak}}</td>
						<?php $tunjangans->besaran_uang=number_format($tunjangans->besaran_uang,2,',','.') ?>
                        <td>{{$tunjangans->besaran_uang}}</td>
					<td><a href="{{route('tunjangan.edit',$tunjangans->id)}}" class="btn btn-warning">Update</a></td>	
					<td>
					{!!Form::open(['method'=>'DELETE','route'=>['tunjangan.destroy',$tunjangans->id]])!!}
		
					<input type="submit" class="btn btn-danger" onclick="return confirm('anda yakin akan menghapus data?');"value="Delete"> 
					{!!Form::close()!!}
					</td>
					</tr>
		
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>
@endsection
</body>
</html>
