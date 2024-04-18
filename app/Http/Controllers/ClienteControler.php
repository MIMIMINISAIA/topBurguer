<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteFormRequest;
use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteControler extends Controller
{
    public function indexCliente(){
        $clientes = cliente::all();

        $clientesComImagem = $clientes->map(function($cliente){
            return [
                'foto' => asset('storage/'. $cliente->foto),
                'nome' => $cliente->nome,
                'telefone' => $cliente->telefone,
                'endereco' => $cliente->endereco,
                'email' => $cliente->email,
                'password' => Hash::make($cliente->password),
            
            ];
        });
        return response()->json($clientesComImagem);
    }

    public function storeCliente(ClienteFormRequest $request){
        $clienteData = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $nomeImagem = time().'.'.$imagem->getClientOriginalExtension();
            $caminhoImagem= $imagem->storeAs('imagens/clientes', $nomeImagem,'public');
            $clienteData['imagem']= $caminhoImagem;
        }
        $cliente = cliente::create($clienteData);
        return response()->json(['cliente'=>$cliente], 201);
    }

    public function retornarTodos()
    {
        $clientes = cliente::all();
        return response()->json([
            'status' => true,
            'data' => $clientes
        ]);
    }
}
