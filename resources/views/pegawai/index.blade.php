<!DOCTYPE html>
<html>
@extends('layouts/app')
@section('content')
<head>
	<title>Pegawai</title>
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
<div class="col-md-3">
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


                <div class="panel-body">
                    
                    <a class="btn btn-success form-control" href="{{url('jabatan')}}">Jabatan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('golongan')}}">Golongan</a><hr>
                    <a class="btn btn-danger form-control" href="{{url('pegawai')}}">Pegawai</a><hr>
                    <a class="btn btn-warning form-control" href="{{url('kategori_lembur')}}">Kategori Lembur</a><hr>
<<<<<<< HEAD
                    <a class="btn btn-info form-control" href="{{url('lembur_pegawai')}}">Lembur Pegawai</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjangan')}}">Tunjangan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjangan_pegawai')}}">Tunjangan Karyawan</a><hr>
=======
                    <a class="btn btn-info form-control" href="{{url('lemburpegawai')}}">Lembur Pegawai</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjangan')}}">Tunjangan</a><hr>
                    <a class="btn btn-primary form-control" href="{{url('tunjanganpegawai')}}">Tunjangan Karyawan</a><hr>
>>>>>>> 905a8e4812607708fc35103817402f4905128f4e
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
<<<<<<< HEAD
			<div class="panel-heading"><center><h1><font color="#FF0000">Pegawai</font></h1></center></div>
=======
			<div class="panel-heading"><center><h1><font color="#FF0000">Lembur Pegawai</font></h1></center></div>
>>>>>>> 905a8e4812607708fc35103817402f4905128f4e
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover">
					<a href="{{url('/pegawai/create')}}"class="btn btn-primary form-control">Tambah Data</a>
					<br><br>
					<thead>
					<tr class="bg-info">
					<th>Nip</th>
					<th>Email</th>
					<th>permision</th>
					<th colspan="2">Jabatan dan golongan</th>
					<th>Foto</th>
					<th colspan="3">Action</th>
			
					</tr>
					</thead>
					<tbody>
						@php
						$no=1;
						@endphp
						@foreach($pegawai as $pegawais)
<<<<<<< HEAD
						<tr class="bg-danger">
=======
						<tr>
>>>>>>> 905a8e4812607708fc35103817402f4905128f4e
							<td>{{$pegawais->nip}}</td>
							<td>{{$pegawais->User->email}}</td>
							<td>{{$pegawais->User->permision}}</td>
							<td>{{$pegawais->jabatanModel->nama_jabatan}}</td>
							<td>{{$pegawais->golonganModel->nama_golongan}}</td>
			
					<td><img src="assets/image/{{$pegawais->foto}}" class="img-circle" alt="Cinque Terre" width="50" height="50"></td>

					<td><a href="{{route('pegawai.edit',$pegawais->id)}}"class="btn btn-warning">edit</a></td>	
				<td>
				{!!Form::open(['method'=>'DELETE','route'=>['pegawai.destroy',$pegawais->id]])!!}
		
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
