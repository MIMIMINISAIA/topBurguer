<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteControler extends Controller
{
    public function indexCliente(){
        $produtos = Produto::all();

        $produtosComImagem = $produtos->map(function($produto){
            return [
                'foto' => asset('storage/'. $produto->foto),
                'nome' => $produto->nome,
                'telefone' => $produto->telefone,
                'endereco' => $produto->endereco,
                'email' => $produto->email,
                'password' => Hash::make($produto->password),
            
            ];
        });
        return response()->json($produtosComImagem);
    }

    public function storeCliente(Request $request){
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
}
