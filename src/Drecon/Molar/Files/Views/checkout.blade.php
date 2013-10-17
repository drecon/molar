<script type='text/javascript' src='https://desenvolvedor.moip.com.br/sandbox/transparente/MoipWidget-v2.js' charset='ISO-8859-1'></script>

<div style="width:400px;visibility:hidden" id="result" data-payment="bank-bill"></div>

@if(isset($moip_return))
	<?php $return = json_decode($moip_return,true) ?>
	@if($return["Resposta"]["Status"] == "Sucesso")
		<div id="MoipWidget"
	        data-token="{{ $return['Resposta']['Token'] }}"
	        callback-method-success="moip_success"
	        callback-method-error="moip_fail">
		</div>

		<div style="width:400px;" class="panel panel-default">
		  <div class="panel-heading">Confirmar compra</div>
		  <div class="panel-body">
		  	<div>
			  <h5>Escolha a forma de pagamento</h5>
			</div>
			<hr>
		  	<div id="payment-form" class="btn-group" data-toggle="buttons">
			  <label id="bank-bill" class="btn btn-primary btn-radio active">
			    <input type="radio" name="options"> Boleto
			  </label>
			  <label id="debit" class="btn btn-primary btn-radio">
			    <input type="radio" name="options"> Débito Bancário
			  </label>
			  <label id="credit-card" class="btn btn-primary btn-radio">
			    <input type="radio" name="options"> Cartão de Crédito
			  </label>
			</div>
			<hr>
			<div id="panel-content">
				<div id="bank-bill-content" class="payment-form-content">
					Clique em "Confirmar" para finalizar a compra e pagar através de boleto bancário.
				</div>
				<div style="display:none" id="debit-content" class="payment-form-content">
					<span>Selecione o seu banco:</span>
					<br><br><form id="select-bank">
						<input type="radio" name="bank" value="BancoDoBrasil"> Banco do Brasil<br>
						<input type="radio" name="bank" value="Bradesco"> Bradesco<br>
						<input type="radio" name="bank" value="Banrisul"> Banrisul<br>
						<input type="radio" name="bank" value="Itau"> Itaú
					</form>
				</div>
				<div style="display:none" id="credit-card-content" class="payment-form-content">
					<span>Selecione a bandeira:</span>
					<br><br><form id="select-card">
						<input type="radio" name="card" value="AmericanExpress"> American Express<br>
						<input type="radio" name="card" value="Diners"> Diners<br>
						<input type="radio" name="card" value="Mastercard"> Mastercard<br>
						<input type="radio" name="card" value="Hipercard"> Hipercard<br>
						<input type="radio" name="card" value="Visa"> Visa
					</form>

					<br><br><span>Preencha os dados:</span>
					<br><br><form id="credit-card-info">
					<div class="form-group">
						<label for="holder_name">Nome do Titular</label>
						<input name="holder_name" type="text" class="form-control" id="holder_name" placeholder="Nome do Titular">
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
					<div class="form-group">
						<label for="credicard_number">Número do Cartão</label>
						<input name="credicard_number" type="text" class="form-control" id="credicard_number" placeholder="Número do Cartão">
					</div>
					<div class="form-group">
						<label for="expiration_month">Expiração</label><br>
						<input name="expiration_month" style="width:60px;float:left;margin-right:10px" type="text" class="form-control" id="expiration_month" placeholder="Mês">
						<input name="expiration_year" style="width:60px;" type="text" class="form-control" id="expiration_year" placeholder="Ano">
					</div>
					<div class="form-group">
						<label for="secure_code">Código de Segurança</label>
						<input name="secure_code" type="text" class="form-control" id="secure_code" placeholder="Código de Segurança">
					</div></form>
				</div>
			</div>
		  </div>
		  <div class="panel-footer">
		  	<a id="bank-bill-btn" onclick="bankBill()" class="btn btn-success btn-payment-confirm" href="#">Confirmar</a>
		  	<a id="debit-btn" style="display:none;" onclick="debit()" class="btn btn-success btn-payment-confirm" href="#">Confirmar</a>
		  	<a id="credit-card-btn" style="display:none;" onclick="ceditCard()" class="btn btn-success btn-payment-confirm" href="#">Confirmar</a>
		  </div>
		</div>
	@else
		<div class="alert alert-danger">
			<p><strong>Erro:</strong></p>
			<p>{{ $return["Resposta"]["Erro"] }}</p>
		</div>
	@endif
@endif

<script type="text/javascript">
	$(".btn-radio").click(function(){
		$('.payment-form-content').css('display','none');
		$('#' + $(this).attr('id') + '-content').css('display','block');

		$('.btn-payment-confirm').css('display','none');
		$('#' + $(this).attr('id') + '-btn').css('display','inline');

		$('#result').attr('data-payment',$(this).attr('id'));
	});

	var moip_success = function(data){
	    payment_form = $('#result').attr('data-payment');
	    html = '<div class="alert alert-success"><strong>' + data['Mensagem'] + '</strong>';
	    html += '<br>Sua transação foi processada pelo Moip Pagamentos S/A.';
		html +=	'<br>Caso tenha alguma dúvida referente a transação, entre em contato com o Moip.';
	    switch(payment_form){
	    	case 'bank-bill':
	    		html += '<br><br><p><a href="' + data['url'] + '" class="btn btn-success">Imprimir Boleto</a></p>';
	    		break;
	    	case 'debit':
	    		html += '<br><br><p><a href="' + data['url'] + '" class="btn btn-success">Realizar Pagamento</a></p>';
	    		break;
	    	case 'credit-card':
	    		html += '<br><br><p>Status: "' + data['Status'] + '".</p>';
	    		break;
	    }
	    
	    html += '</div>';

	    $('#result').html(html);
	    $('#result').css('visibility','visible');
	};

	var moip_fail = function(data) {
	    html = '<div class="alert alert-danger"><strong>Erros:</strong><ul>';

	    for(i=0;i<data.length;i++){
	    	html += '<li>' + data[i]['Mensagem'] + '</li>';
	    }

	    html += '</ul></div>';

	    $('#result').html(html);
	    $('#result').css('visibility','visible');

	    console.log(data);
	};

	var bankBill = function() {
	    var settings = {
	        "Forma": "BoletoBancario"
	    }
	    MoipWidget(settings);
	} 

	var debit = function() {
	    var settings = {
	        "Forma": "DebitoBancario",
			"Instituicao": $('input[name=bank]:checked', '#select-bank').val()
	    }
	    MoipWidget(settings);
	}

	var ceditCard = function() {
	    var settings = {
		    "Forma": "CartaoCredito",
		    "Instituicao": $('input[name=card]:checked', '#select-card').val(),
		    "Parcelas": "1",
		    "CartaoCredito": {
		        "Numero": $('#credicard_number').val(),
		        "Expiracao": $('#expiration_month').val() + "/" + $('#expiration_year').val(),
		        "CodigoSeguranca": $('#secure_code').val(),
		        "Portador": {
		            "Nome": $('#holder_name').val(),
		            "DataNascimento": $('#birthdate_day').val() + "/" + $('#birthdate_month').val() + "/" + $('#birthdate_year').val(),
		            "Telefone": "(" + $('#phone_area_code').val() + ")" + $('#phone_number').val(),
		            "Identidade": $('#cpf').val()
		        }
		    }
		}
	    MoipWidget(settings);
	}    
</script>