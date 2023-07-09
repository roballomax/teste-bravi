<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    
    public function getAll() 
    {
        $personList = Contato::with('pessoa')->paginate(5);
        return response($personList);
    }

    public function getOne(Request $request)
    {
        try {
            $person = Contato::with('pessoa')->findOrFail($request->id); 
            return response([
                'data' => $person,
                'message' => 'Dados retornados com sucesso!'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Contato não encontrado!',
            ]);
        }
    }

    public function add(ContatoRequest $request)
    {
        // TODO: Terminar as actions daqui pra baixo
        try {
            $person = new Contato();
            $person->nome = $request->nome;
            $person->save();

            return response([
                'data'      => $person,
                'message'   => 'Contato cadastrada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao cadastrar contato!',
            ]);
        }
    }

    public function update(ContatoRequest $request)
    {
        try {
            $person = Contato::findOrFail($request->id);
            $person->nome = $request->nome;
            $person->save();
    
            return response([
                'data'      => $person,
                'message'   => 'Contato atualizada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao atualizar contato!',
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $person = Contato::findOrFail($request->id);
            $person->delete();

            return response([
                'data'      => $person,
                'message'   => 'Contato deletada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao deletar contato!',
            ]);
        }
    }
}
