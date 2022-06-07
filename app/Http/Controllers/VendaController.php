<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\ItemVenda;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 // lista.blade.php
    public function index()
    {
        $vendas = DB::table("venda AS v")
					->join("cliente AS c", "v.cliente_id", "=", "c.id")
					->select("v.id", "v.total", "v.created_at AS data", "c.nome AS cliente", "v.cancelada")
					->orderByDesc("v.created_at")
					->get();
					
		return view("venda.lista", [
			"vendas" => $vendas
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venda = new Venda();
		$clientes = Cliente::All();
		$itens = [];
		
		return view("venda.index", [
			"venda" => $venda,
			"clientes" => $clientes,
			"itens" => $itens
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$venda = Venda::Find($request->get("id"));
		} else {
			$venda = new Venda();
		}
		
		$venda->cliente_id = $request->get("cliente_id");
		$venda->total = 0;
		
		$venda->save();
		$request->session()->flash("status", "salvo");
		
		return redirect("/venda/" . $venda->id . "/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venda = Venda::Find($id);
		$clientes = Cliente::All();
		$itens = [];
		
		return view("venda.index", [
			"venda" => $venda,
			"clientes" => $clientes,
			"itens" => $itens
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
