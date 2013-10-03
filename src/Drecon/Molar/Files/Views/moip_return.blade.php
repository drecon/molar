@if(isset($moip_return))
	<?php $return = json_decode($moip_return,true) ?>
	@if(empty($return['errors']))
		<div class="alert alert-success">
			<p><strong>{{ $return['message'] }}</strong></p>
			<p>Valor: R$ {{ $return['amount']/100 }}</p>
			<p>Próxima cobrança: {{ $return['next_invoice_date']['day']."/".$return['next_invoice_date']['month']."/".$return['next_invoice_date']['year'] }}</p>
		</div>
	@else
		<div class="alert alert-danger">
			<p><strong>{{ $return['message'] }}</strong></p>
			<ul>
				@foreach($return['errors'] as $e)
					<li>
						{{ $e['description'] }}
					</li>
				@endforeach
			</ul>
		</div>
	@endif
@endif