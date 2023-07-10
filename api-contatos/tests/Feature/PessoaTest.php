<?php

namespace Tests\Feature;

use App\Models\Pessoa;
use Tests\TestCase;

class PessoaTest extends TestCase
{
    public function test_lista_pessoas(): void
    {
        $response = $this->get('/api/pessoa');
        $response->assertOk();
    }

    public function test_busca_pessoa(): void
    {
        $person = Pessoa::factory(1)->create();
        $person = $person[0];
        $response = $this->get('/api/pessoa/' . $person->id);

        $response->assertOk()
            ->assertJson([
                "data" => $person->load('contacts')->toArray(),
                "message" => 'Dados retornados com sucesso!'
            ]);
        $person->delete();
    }

    public function test_cria_pessoa():void 
    {
        $nome = fake()->name();
        $response = $this->post('/api/pessoa', [
            'nome' => $nome,
        ]);

        $personId = $response->decodeResponseJson()['data']['id'];

        $response->assertCreated()
            ->assertJsonPath('message', 'Pessoa cadastrada com sucesso!')
            ->assertJsonPath('data.nome', $nome);

        (new Pessoa())->find($personId)->delete();
    }

    public function test_cria_pessoa_fail(): void 
    {
        $response = $this->post('/api/pessoa', []);
        $response->assertBadRequest()
            ->assertJsonPath('message', 'Ocorreram erros de validação');
    }

    public function test_atualiza_pessoa(): void
    {
        $person = Pessoa::factory(1)->create();
        $person = $person[0];

        $response = $this->put('/api/pessoa/' . $person->id, [
            'nome' => fake()->name()
        ]);

        $content = $response->decodeResponseJson();

        $response->assertOk()
            ->assertJsonPath('message', 'Pessoa atualizada com sucesso!')
            ->assertJsonPath('data.id', $person->id);

        $this->assertNotEquals($content['data']['nome'], $person->nome);

        $person->delete();
    }

    public function test_atualiza_pessoa_fail(): void 
    {
        $lastPerson = (new Pessoa)->orderBy('id', 'DESC')->first();
        $response = $this->put('/api/pessoa/' . ($lastPerson->id + 1), [
            'nome' => fake()->name()
        ]);

        $response->assertBadRequest();
    }

    public function test_deleta_pessoa(): void 
    {
        $person = Pessoa::factory(1)->create();
        $person = $person[0];
        
        $request = $this->delete('/api/pessoa/' . $person->id);
        $request->assertOk();
    }

    public function test_deleta_pessoa_fail(): void 
    {
        $lastPerson = (new Pessoa)->orderBy('id', 'DESC')->first();
        $request = $this->delete('/api/pessoa/' . ($lastPerson->id + 1));
        $request->assertBadRequest();
    }
}
