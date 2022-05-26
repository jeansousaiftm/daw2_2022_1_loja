@extends("templates.main")

@section("title", "Clientes")

@section("formulario")
	<h1>Cadastro de Clientes</h1>
	<form action="/cliente" method="POST" class="row" onsubmit="carregaDados();">
		<div class="form-group col-5">
			<label for="nome">Nome:</label>
			<input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}" />
		</div>
		<div class="form-group col-5">
			<label for="cpf">CPF:</label>
			<input type="text" id="cpf_mask" name="cpf_mask" class="form-control" value="{{ $cliente->cpf }}" />
			<input type="hidden" id="cpf" name="cpf" value="{{ $cliente->cpf }}" />
		</div>
		<div class="form-group col-2">
			@csrf
			<input type="hidden" name="id" value="{{ $cliente->id }}" />
			
			<a href="/cliente" class="btn btn-primary" style="margin-top: 23px;">
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
	<table id="tabClientes" class="table table-striped" style="margin-top: 10px;">
		<colgroup>
			<col width="200">
			<col width="200">
			<col width="100">
			<col width="100">
		</colgroup>
		<thead>
			<tr>
				<th>Nome</th>
				<th>CPF</th>
				<th>Edit</th>
				<th>Del</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($clientes as $cliente)
				<tr>
					<td class="td_nome">{{ $cliente->nome }}</td>
					<td class="td_cpf">{{ $cliente->cpf }}</td>
					<td>
						<a href="/cliente/{{ $cliente->id }}/edit" class="btn btn-warning">
							<i class="bi bi-pencil-square"></i>
							Edit
						</a>
					</td>
					<td>
						<form action="/cliente/{{ $cliente->id }}" method="POST">
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
		
		$("#tabClientes tbody tr").each(function() {
			
			var mostrar = true;
			
			var nome = $("td.td_nome", this).html();
			nome = nome.toLowerCase();
			
			var cpf = $("td.td_cpf", this).cleanVal();
			
			mostrar = nome.includes(q) || cpf.includes(q);
			
			if (mostrar) {
				$(this).show();
			} else {
				$(this).hide();
			}
			
		});
		
	}
	
	function carregaDados() {
		$("#cpf").val($("#cpf_mask").cleanVal());
	}
	
	document.addEventListener("DOMContentLoaded", function() {
	
		$("#cpf_mask").mask("000.000.000-00", { "placeholder": "___.___.___-__" });
		
		$(".td_cpf").mask("000.000.000-00");
		
	});
</script>