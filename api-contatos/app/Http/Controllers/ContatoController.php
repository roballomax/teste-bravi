<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    
    public function getAll() 
    {
        $contactList = Contato::with('pessoa')->paginate(5);
        return response($contactList);
    }

    public function getOne(Request $request)
    {
        try {
            $contact = Contato::with('pessoa')->findOrFail($request->id); 
            return response([
                'data' => $contact,
                'message' => 'Dados retornados com sucesso!'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Contato não encontrado!',
            ], 400);
        }
    }

    public function add(ContatoRequest $request)
    {
        try {
            $contact = new Contato();
            $contact->valor     = $request->valor;
            $contact->tipo_id   = $request->tipo_id;
            $contact->pessoa_id = $request->pessoa_id;
            $contact->save();

            return response([
                'data'      => $contact,
                'message'   => 'Contato cadastrado com sucesso!',
            ], 201);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao cadastrar contato!',
            ], 400);
        }
    }

    public function update(ContatoRequest $request)
    {
        try {
            $contact = Contato::findOrFail($request->id);
            
            if (!empty($request->valor)) {
                $contact->valor = $request->valor;
            }

            if (!empty($request->tipo_id)) {
                $contact->tipo_id = $request->tipo_id;
            }

            if (!empty($request->pessoa_id)) {
                $contact->pessoa_id = $request->pessoa_id;
            }
            
            $contact->save();
    
            return response([
                'data'      => $contact,
                'message'   => 'Contato atualizada com sucesso!',
            ]);
            
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao atualizar contato!',
            ], 400);
        }
    }

    public function delete(Request $request)
    {
        try {
            $contact = Contato::findOrFail($request->id);
            $contact->delete();

            return response([
                'data'      => $contact,
                'message'   => 'Contato deletada com sucesso!',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Ocorreu um erro ao deletar contato!',
            ], 400);
        }
    }
}
