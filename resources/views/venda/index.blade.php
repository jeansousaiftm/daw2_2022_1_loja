@extends("templates.main")

@section("titulo", "Realizar Venda")

@section("formulario")
	<br/>
	<form method="POST" action="/venda" class="row">
		<div class="col-6 form-group">
			<label for="cliente">Cliente:</label>
			<select class="form-control selectpicker" name="cliente_id" data-live-search="true">
				<option value=""></option>
				@foreach($clientes as $cliente)
					<option value="{{ $cliente->id }}" @selected($venda->cliente_id == $cliente->id) >
						{{ $cliente->nome }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-6 form-group">
			@csrf
			<input type="hidden" name="id" value="{{ $venda->id }}" />
			
			<button type="submit" class="btn btn-success" style="margin-top: 25px;">
				<i class="bi bi-save"></i> Salvar Venda
			</button>
			@if ($venda->id != "")
				<a href="/venda/{{ $venda->id }}/item" class="btn btn-primary" style="margin-top: 25px;">
					<i class="bi bi-plus-square"></i> Adicionar Item
				</a>
			@endif
		</div>
	</form>
@endsection

@section("tabela")
	
@endsection