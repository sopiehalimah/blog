@extends('app')
@section('content')
<div class="container">
{!! link_to_route("siswa.index","Siswa") !!}
<hr>
{!! link_to_route("siswa.create","New") !!}
<ul>
@foreach ($siswas as $data)
<li>
{!! link_to_route("siswa.show",$data->nama,$data->id) !!}
</li>
@endforeach
</ul>
</div>
@endsection