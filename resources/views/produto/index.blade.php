@extends("templates.main")

@section("title", "Produtos")

@section("formulario")
	<h1>Cadastro de Produtos</h1>
	<form action="/produto" method="POST" class="row" onsubmit="carregaDados();">
		<div class="form-group col-5">
			<label for="descricao">Descrição:</label>
			<input type="text" name="descricao" class="form-control" value="{{ $produto->descricao }}" />
		</div>
		<div class="form-group col-5">
			<label for="preco">Preço:</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">R$</span>
				</div>
				<input type="text" id="preco_mask" name="preco_mask" class="form-control" value="{{ ($produto->id == '') ? '' : number_format($produto->preco, 2) }}" />
			</div>
			<input type="hidden" id="preco" name="preco" value="{{ $produto->preco }}" />
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" name="id" value="{{ $produto->id }}" />
			
			<a href="/produto" class="btn btn-primary" style="margin-top: 23px;">
				<i class="bi bi-plus-square"></i>
				Novo
			</a>
			<button type="submit" class="btn btn-success" style="margin-top: 23px;">
				<i class="bi bi-save"></i>
				Salvar
			</button>
		</div>
	</form>
@endsection

@section("tabela")
	<div class="row" style="margin-top: 50px;">
		<div class="col-12 form-group">
			<input type="text" id="q" placeholder="Pesquisar por nome..." class="form-control" onkeyup="buscar($(this).val());" />
		</div>
	</div>
	<table id="tabProdutos" class="table table-striped" style="margin-top: 10px;">
		<colgroup>
			<col width="200">
			<col width="200">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($produtos as $produto)
				<tr>
					<td class="td_descricao">{{ $produto->descricao }}</td>
					<td class="td_preco">{{ number_format($produto->preco, 2) }}</td>
					<td>
						<a href="/produto/{{ $produto->id }}/edit" class="btn btn-warning">
							<i class="bi bi-pencil-square"></i>
							Edit
						</a>
					</td>
					<td>
						<form action="/produto/{{ $produto->id }}" method="POST">
							@csrf
							<input type="hidden" name="_method" value="DELETE" />
							<button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?');">
								<i class="bi bi-trash"></i>
								Del
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

<script>
	
	function buscar(q) {
		
		q = q.toLowerCase();
		
		$("#tabProdutos tbody tr").each(function() {
			
			var mostrar = true;
			
			var descricao = $("td.td_descricao", this).html();
			descricao = descricao.toLowerCase();

			mostrar = descricao.includes(q);
			
			if (mostrar) {
				$(this).show();
			} else {
				$(this).hide();
			}
			
		});
		
	}
	
	function carregaDados() {
		$("#preco").val(parseFloat($("#preco_mask").cleanVal()) / 100);
	}
	
	document.addEventListener("DOMContentLoaded", function() {
	
		$("#preco_mask").mask('#.##0,00', {reverse: true});
		
		$(".td_preco").mask('#.##0,00', {reverse: true});
		
	});
</script>