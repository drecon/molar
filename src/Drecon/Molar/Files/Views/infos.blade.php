<div style="width:400px;" class="alert alert-info">
 	Transação teste no valor de R$ 92,50. Confirme os dados para seguir com o pagamento.
</div>

<!-- require client infos -->
<form role="form" style="width:400px" method="POST" action="{{ route('checkout') }}" accept-charset="UTF-8">
	<div class="panel panel-default">
		<!-- hidden infos -->
		<?php
			$date = new DateTime();
			$timestamp = $date->getTimestamp();
		?>
		<input name="id" type="hidden" value="{{ $timestamp }}">
		<input name="price" type="hidden" value="92.50">
		<input name="reason" type="hidden" value="Pagamento Teste">
		<!-- infos -->
		<div class="panel-heading">Informações do Usuário</div>
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
				<label for="phone_area_code">Telefone</label><br>
				<input name="phone_area_code" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="phone_area_code" placeholder="DDD"> 
				<input name="phone_number" style="width:298px" type="text" class="form-control" id="phone_number" placeholder="Telefone">
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
		</div>
		<div class="panel-footer"><button type="submit" class="btn btn-success">Confirmar</button></div>
	</div>
</form>