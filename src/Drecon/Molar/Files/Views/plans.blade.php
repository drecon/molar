@if(isset($plans))
	@if(!isset($_GET['code']))
		<!-- show active plans -->
		<ul class="list-unstyled list-inline">
		@foreach(json_decode($plans,true)['plans'] as $p)
			@if($p['status'] == 'ACTIVE')
				<li>
					<div class="panel panel-default">
					  	<div class="panel-heading">{{ $p['name'] }}</div>
				  		<div class="panel-body">
							<dl>
								<dt>Descrição</dt>
								<dd>{{ $p['description'] }}</dd>
								<dt>Preço</dt>
								<dd>R$ {{ $p['amount']/100 }}</dd>
							</dl>
					  	</div>
					  	<div class="panel-footer"><a href="/plans?code={{ $p['code'] }}" class="btn btn-success">Assinar</a></div>
					</div>
				</li>
			@endif
		@endforeach
		</ul>
	@else
		<!-- show selected plan -->
		<div class="alert alert-info" style="width:400px">
			@foreach(json_decode($plans,true)['plans'] as $p)
				@if($p['code'] == $_GET['code'])
					Você selecionou o plano <strong>{{ $p['name'] }}</strong>, no valor de <strong>R$ {{ $p['amount']/100 }}</strong>. Para modificar o plano selecionado, por favor <a href="/plans" class="alert-link">clique aqui</a>.
				@endif
			@endforeach
		</div>
		<!-- require client info and signs the plan -->
		<form role="form" style="width:400px" method="POST" action="{{ route('sign_plan') }}" accept-charset="UTF-8">
			<div class="panel panel-default">
				<!-- hidden infos -->
				<?php
					$date = new DateTime();
					$timestamp = $date->getTimestamp();
				?>
				<input name="sign_code" type="hidden" value="{{ $timestamp }}">
				<input name="plan_code" type="hidden" value="{{ $_GET['code'] }}">
				<input name="customer_code" type="hidden" value="{{ $timestamp }}">
				<!-- infos -->
				<div class="panel-heading">Confirmar assinatura do plano</div>
				<div class="panel-body">
					<div>
					  <h5>Informações de cadastro</h5>
					</div>
					<hr>
					<div class="form-group">
						<label for="email">Email</label>
						<input name="email" type="email" class="form-control" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="fullname">Nome Completo</label>
						<input name="fullname" type="text" class="form-control" id="fullname" placeholder="Nome Completo">
					</div>
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input name="cpf" type="text" class="form-control" id="cpf" placeholder="Cpf">
					</div>
					<div class="form-group">
						<label for="phone_area_code">Telefone</label><br>
						<input name="phone_area_code" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="phone_area_code" placeholder="DDD"> 
						<input name="phone_number" style="width:298px" type="text" class="form-control" id="phone_number" placeholder="Telefone">
					</div>
					<div class="form-group">
						<label for="birthdate_day">Data de Nascimento</label><br>
						<input name="birthdate_day" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="birthdate_day" placeholder="Dia">
						<input name="birthdate_month" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="birthdate_month" placeholder="Mês">
						<input name="birthdate_year" style="width:60px;margin-right:10px" type="text" class="form-control" id="birthdate_year" placeholder="Ano">
					</div>
					<br><div>
					  <h5>Endereço</h5>
					</div>
					<hr>
					<div class="form-group">
						<label for="street">Rua</label>
						<input name="street" type="text" class="form-control" id="street" placeholder="Rua">
					</div>
					<div class="form-group">
						<label for="number">Número</label>
						<input name="number" style="width:60px;" type="text" class="form-control" id="number" placeholder="Nº">
					</div>
					<div class="form-group">
						<label for="complement">Complemento</label>
						<input name="complement" type="text" class="form-control" id="complement" placeholder="Complemento">
					</div>
					<div class="form-group">
						<label for="district">Bairro</label>
						<input name="district" type="text" class="form-control" id="district" placeholder="Bairro">
					</div>
					<div class="form-group">
						<label for="city">Cidade</label>
						<input name="city" type="text" class="form-control" id="city" placeholder="Cidade">
					</div>
					<div class="form-group">
						<label for="state">Estado</label>
						<input name="state" style="width:70px;" type="text" class="form-control" id="state" placeholder="Estado">
						<input name="country" type="hidden" value="BRA">
					</div>
					<div class="form-group">
						<label for="zipcode">CEP</label>
						<input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="CEP">
					</div>
					<br><div>
					  <h5>Informações de pagamento</h5>
					</div>
					<hr>
					<div class="form-group">
						<label for="holder_name">Nome do Titular</label>
						<input name="holder_name" type="text" class="form-control" id="holder_name" placeholder="Nome do Titular">
					</div>
					<div class="form-group">
						<label for="credicard_number">Número do Cartão</label>
						<input name="credicard_number" type="text" class="form-control" id="credicard_number" placeholder="Número do Cartão">
					</div>
					<div class="form-group">
						<label for="expiration_month">Expiração</label><br>
						<input name="expiration_month" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="expiration_month" placeholder="Mês">
						<input name="expiration_year" style="width:60px;" type="text" class="form-control" id="expiration_year" placeholder="Ano">
					</div>
				</div>
				<div class="panel-footer"><button type="submit" class="btn btn-success">Confirmar assinatura do plano</button></div>
			</div>
		</form>
		
	@endif
@endif