@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md8 col-md-offset-2">
			<h2> Nueva Solicitud </h2>
			{!! Form::open(['route' => 'tickets.store', 'method' => 'Post'])!!}
				<p>
					<button type="submit" class="btn btn-primary">
			 			Enviar Solicitud
			 		</button>
				</p>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection