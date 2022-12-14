<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::paginate(10)->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStoreRequest $request)
    {
        $cliente = Cliente::create($request->validated());
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $cliente;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        return $cliente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response(200);
    }

    /**
     * Undocumented function
     * //TODO
     * @param [type] $params
     * @return void
     */
    public function buscarClientesPorNomeOuCpf(Request $request)
    {
        $nome = $request->input('nome', null);
        $cpf = $request->input('cpf', null);
        $clientesPorPagina = $request['clientes_por_pagina'];

        $clientes = Cliente::when($nome, function($query, $nome) {
            $query->where('nome', 'like', '%' . $nome . '%');
        })
        ->when($cpf, function($query, $cpf) {
            $query->where('cpf', 'like', '%' . $cpf . '%');
        })->paginate($clientesPorPagina);

        return response($clientes);
    }
}
