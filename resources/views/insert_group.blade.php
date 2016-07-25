@extends('layouts.app')

@section('content')

@if (Auth::user()->role == 'admin')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Insert group</div>

				<div class="panel-body">
					<form method="POST" action="{{ url('/save_group') }}">
						Group name:<br>
						<input type="text" name="name" size="50">
						<br>
						Description:<br>
						<input type="text"  name="description" size="100"> <br/> <br/>
						<input type="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@else
<div class="col-md-4 col-md-offset-4">
    <h2> Samo administrator moze pristupiti ovoj stranici! </h2>
</div>
@endif

@endsection