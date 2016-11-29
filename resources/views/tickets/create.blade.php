@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md8 col-md-offset-2">
			<h2> Nueva Solicitud </h2>
			@include('partials/errors')
			{!! Form::open(['route' => 'tickets.store', 'method' => 'Post'])!!}
				<p>
					<div class="form-group">
						{!! Form::label('title', 'Titulo')!!}
						{!!
							Form::textarea('title', null, [
								'rows'			=> 2,
								'class'			=> 'form-control',
								'placeholder'	=> 'Describe brevemente de que quieres que se trate el tutorial'
							])
						!!}
					</div>
					<button type="submit" class="btn btn-primary">
			 			Enviar Solicitud
			 		</button>
				</p>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection