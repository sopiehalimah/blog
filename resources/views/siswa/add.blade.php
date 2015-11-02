@extends('app')
@section('content')
<div class="container">
{!! link_to_route("siswa.index","Siswa") !!}
<hr>
{!! Form::model($siswa,
['route'=>['siswa.store',$siswa->id],'method'=>'POST']) !!}
@include ('siswa.form')
{!! Form::close() !!}
</div>
@endsection