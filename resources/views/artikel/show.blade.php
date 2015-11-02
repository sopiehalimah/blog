@extends('app')

@section('content')

<div class="panel">
	<div class="heading">
	<div class="icon mif-file-text"></div>
	<div class="title">{{ $data->judul }}</div>
	</div>
	<div class="content">

		{{ $data->isi }}



		<div class="place-right">
			<span class="mif-calendar"></span>
			{{ date_format(date_create($data->created_at),"D, h M Y H:i:s") }}
			<span class="mif-user"></span>
			{{ App\User::find($data->idpengguna)['name'] }}
			
		</div>
		
	</div>
	
</div>

<div class="panel">
	<div class="heading">
	<div class="icon mif-bubbles"></div>
	<div class="title">Comments</div>
	</div>
	<div class="content">
		<div id="form">
		 <span style="margin:50px auto; padding-top:50px;font-size:50pt;" class="mif-spinner5 mif-ani-spin" ></span>	
		</div>
		<div id="komentar">
		<span style="margin:50px auto; padding-top:50px;font-size:50pt;" class="mif-spinner5 mif-ani-spin" ></span>		
		</div>
	</div>
</div>

@endsection

@section('footer')


<script type="text/javascript">
	
	setTimeout(function(){

	$("#form").html('<form>'+
		'<table style="width:100%;">'+
		'<tr>'+
		'<td>'+
		'<div class="input-control textarea full-size">'+
		'<textarea id="input-komentar" type="text"></textarea>'+
		'</div>'+
		'</td>'+
		'</tr>'+
		'<tr>'+
		'<td>'+
		'<button class="button primary" onclick="send_comments()">'+
		'Submit</button>'+
		'</td>'+
		'</tr>'+
		'</table>'+
		'</form>');

	load_comments({{ $data->id}});
		},1000);

		function send_comments() {

		$.ajax({
		url:'{{ url("komentar") }}',
		type:'POST',
		data:{'idpost':{{ $data->id }},
			'_token':'{{ csrf_token() }}',
			'isi':$("#input_komentar").val() },
			success:function(argument) {
				if (argument=="sukses") {
					$("#input_komentar").val('');

					load_comments({{ $data->id}});
				}
			},
			error:function() {
				alert('error');
			}
	});
		function load_comments(id) {
			$.ajax({
				url:'load_comments/'+id,
				type:'GET',
				success:function(argument) {
					$("komentar").html('');

					for (var i = 0; i < argument)
				}
			})
		}
}


</script>


@endsection