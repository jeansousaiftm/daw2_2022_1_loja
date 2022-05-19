<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{

    public function index()
    {
        $cliente = new Cliente();
		$clientes = Cliente::All();
		return view("cliente.index", [
			"cliente" => $cliente,
			"clientes" => $clientes
		]);
    }

    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$cliente = Cliente::Find($request->get("id"));
		} else {
			$cliente = new Cliente();
		}
		$cliente->nome = $request->get("nome");
		$cliente->cpf = $request->get("cpf");
		$cliente->save();
		$request->session()->flash("status", "salvo");
		return redirect("/cliente");
    }

    public function edit($id)
    {
        $cliente = Cliente::Find($id);
		$clientes = Cliente::All();
		return view("cliente.index", [
			"cliente" => $cliente,
			"clientes" => $clientes
		]);
    }

    public function destroy($id, Request $request)
    {
        Cliente::Destroy($id);
		$request->session()->flash("status", "excluido");
		return redirect("/cliente");
    }
}
