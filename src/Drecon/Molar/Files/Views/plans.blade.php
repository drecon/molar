@if(isset($plans))
	<!-- show active plans -->
	@foreach(json_decode($plans,true)['plans'] as $p)
		@if($p['status'] == 'ACTIVE')
			<h1>{{ $p['name'] }}</h1>
		@endif
	@endforeach
@endif