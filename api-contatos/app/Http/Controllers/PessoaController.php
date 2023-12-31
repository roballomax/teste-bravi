<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PessoaController extends Controller
{
    public function getAll() 
    {
        $personList = Pessoa::with('contacts')->get();
        return response([
            'data' => $personList,
            'message' => 'Dados retornados com sucesso!'
        ]);
    }

    public function getOne(Request $request)
    {
        try {
            $person = Pessoa::with('contacts')->findOrFail($request->id); 
            return response([
                'data' => $person,
                'message' => 'Dados retornados com sucesso!'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Pessoa não encontrada!',
            ], 400);
        }
    }

    public function add(PessoaRequest $request)
    {
        try {
            $person = new Pessoa();
            $person->nome = $request->nome;
            $person->save();

            return response([
                'data'      => $person,
                'message'   => 'Pessoa cadastrada com sucesso!',
            ], 201);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao cadastrar pessoa!',
            ], 400);
        }
    }

    public function update(PessoaRequest $request)
    {
        try {
            $person = Pessoa::findOrFail($request->id);
            $person->nome = $request->nome;
            $person->save();
    
            return response([
                'data'      => $person,
                'message'   => 'Pessoa atualizada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao atualizar pessoa!',
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $person = Pessoa::findOrFail($request->id);
            $person->delete();

            return response([
                'data'      => $person,
                'message'   => 'Pessoa deletada com sucesso!',
            ]);
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return response([
                'message' => 'Ocorreu um erro ao deletar pessoa!',
            ], 400);
        }
    }
}
