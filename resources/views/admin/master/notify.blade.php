@if(Session::get('notify_success'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
		<strong>{{ Session::get('notify_success') }}</strong>
	</div>
@elseif(Session::get('notify_error'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
		<strong>{{ Session::get('notify_error') }}</strong>
	</div>
@elseif(count($errors) > 0)
	{{--@foreach($errors->all() as $item)--}}
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>&times;</span></button>
		<strong>{{ $errors->first() }}</strong>
	</div>
	{{--@endforeach--}}
@endif