@extends('layouts.leitor')

@section('titulo')
	Fale Conosco | Paperium
@endsection

@section('conteudo')

	<div class="content-wrapper" id="conteudo">
		<div class="container-fluid">
			<div class="wrapper">
				<div class="row">
					<div class="col-md-6">
						<br>
						<h3 class="text-left"><b>Localização</b></h3>
						<p class="lead">Rua Ariosvaldo S Franco, 237 - Mirante, Mogi Mirim - SP</a><br>
							<b>Telefone: </b>(19)3862-0177<br>
						</p>
					</div>
					<div class="col-md-6">
						<form class="form-horizontal" method="post" action="/contato/email">
							{{csrf_field()}}
							<br>
							<fieldset>
								<legend class=" header">Entre em Contato</legend>
								<div class="form-group">
									<div class="col-md-12">
										<input id="fname" name="nome" type="text" placeholder="Nome" value="{{Auth::check() ? Auth::user()->nome : ''}}" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input id="email" name="email" type="text" placeholder="Seu Email" value="{{Auth::check() ? Auth::user()->email : ''}}" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<textarea class="form-control" id="message" name="mensagem" placeholder="Entre com sua mensagem aqui..."></textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-8 col-md-offset-4 ">
										<button type="submit" class="btn btn-primary btn-lg">Enviar</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

