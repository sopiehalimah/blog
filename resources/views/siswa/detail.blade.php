@extends('app')
@section('content')
<div class="container">
{!! link_to_route("siswa.index","Siswa") !!}
<hr>
{{ $siswa->nama }}<br>
{{ $siswa->jenis_kelamin }}<br>
{{ $siswa->tanggal_lahir }}
<hr>
{!! link_to_route("siswa.edit","Edit",$siswa->id) !!}
{!!
Form::open(['method'=>'DELETE','route'=>['siswa.destroy',$siswa->id]]) !!}
{!! Form::submit('Delete',['style'=>'background-color:transparent;border:0px;padding:0px;color:#337ab7;text-decoration: none;','onclick'=>'return confirm("Are you sure?")']) !!}
{!! Form::close() !!}
</div>
@endsection