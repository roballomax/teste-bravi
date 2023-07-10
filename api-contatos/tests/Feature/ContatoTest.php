<?php

namespace Tests\Feature;

use App\Models\Contato;
use Tests\TestCase;

class ContatoTest extends TestCase
{
    public function test_lista_contatos(): void
    {
        $response = $this->get('/api/contato');
        $response->assertOk();
    }

    public function test_busca_contato(): void
    {
        $contact = Contato::factory(1)->create();
        $contact = $contact[0];
        $response = $this->get('/api/contato/' . $contact->id);

        $response->assertOk()
            ->assertJson([
                "data" => $contact->load('pessoa')->toArray(),
                "message" => 'Dados retornados com sucesso!'
            ]);
        $contact->delete();
    }

    public function test_cria_contato():void 
    {
        $value = fake()->email();

        $response = $this->post('/api/contato', [
            'valor' => $value,
            'tipo_id' => 3,
            'pessoa_id' => 1,
        ]);

        $personId = $response->decodeResponseJson()['data']['id'];

        $response->assertCreated()
            ->assertJsonPath('message', 'Contato cadastrado com sucesso!')
            ->assertJsonPath('data.valor', $value)
            ->assertJsonPath('data.tipo_id', 3)
            ->assertJsonPath('data.pessoa_id', 1)
            ;

        (new Contato())->find($personId)->delete();
    }

    public function test_cria_contato_fail(): void 
    {
        $response = $this->post('/api/contato', []);
        $response->assertBadRequest()
            ->assertJsonPath('message', 'Ocorreram erros de validação');
    }

    public function test_atualiza_contato(): void
    {
        $contato = Contato::factory(1)->create();
        $contato = $contato[0];

        $response = $this->put('/api/contato/' . $contato->id, [
            'valor' => fake()->email(),
            'tipo_id' => 3,
            'pessoa_id' => 1,
        ]);

        $content = $response->decodeResponseJson();

        $response->assertOk()
            ->assertJsonPath('message', 'Contato atualizada com sucesso!')
            ->assertJsonPath('data.id', $contato->id);

        $this->assertNotEquals($content['data']['valor'], $contato->valor);

        $contato->delete();
    }

    public function test_atualiza_contato_fail(): void 
    {
        $lastContact = (new Contato())->orderBy('id', 'DESC')->first();
        $response = $this->put('/api/contato/' . ($lastContact->id + 1), [
            'nome' => fake()->name()
        ]);

        $response->assertBadRequest();
    }

    public function test_deleta_contato(): void 
    {
        $contato = Contato::factory(1)->create();
        $contato = $contato[0];
        
        $request = $this->delete('/api/contato/' . $contato->id);
        $request->assertOk();
    }

    public function test_deleta_contato_fail(): void 
    {
        $lastContact = (new Contato())->orderBy('id', 'DESC')->first();
        $request = $this->delete('/api/contato/' . ($lastContact->id + 1));
        $request->assertBadRequest();
    }
}
