<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoFormRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = Produto::all();

        $produtosComImagem = $produtos->map(function($produto){
            return [
                'id'=> $produto->id,
                'nome' => $produto->nome,
                'valor' => $produto->valor,
                'descricao' => $produto->descricao,
                'imagem' => asset('storage/'. $produto->imagem),
            ];
        });
        return response()->json($produtosComImagem);
    }

    public function store(ProdutoFormRequest $request){
        $produtoData = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $nomeImagem = time().'.'.$imagem->getClientOriginalExtension();
            $caminhoImagem= $imagem->storeAs('imagens/produtos', $nomeImagem,'public');
            $produtoData['imagem']= $caminhoImagem;
        }
        $produto = Produto::create($produtoData);
        return response()->json(['produto'=>$produto], 201);
    }

    public function retornarTodos()
    {
        $clientes = Produto::all();
        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }

}
