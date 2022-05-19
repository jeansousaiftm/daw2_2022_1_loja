<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

    public function index()
    {
        $produto = new Produto();
		$produtos = Produto::All();
		return view("produto.index", [
			"produto" => $produto,
			"produtos" => $produtos
		]);
    }

    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$produto = Produto::Find($request->get("id"));
		} else {
			$produto = new Produto();
		}
		$produto->descricao = $request->get("descricao");
		$produto->preco = $request->get("preco");
		$produto->save();
		$request->session()->flash("status", "salvo");
		return redirect("/produto");
    }

    public function edit($id)
    {
        $produto = Produto::Find($id);
		$produtos = Produto::All();
		return view("produto.index", [
			"produto" => $produto,
			"produtos" => $produtos
		]);
    }

    public function destroy($id, Request $request)
    {
        Produto::Destroy($id);
		$request->session()->flash("status", "excluido");
		return redirect("/produto");
    }
}
