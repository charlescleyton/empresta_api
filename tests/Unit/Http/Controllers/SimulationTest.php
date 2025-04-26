<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SimulationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function deve_retornar_as_instituicoes()
    {
        $response = $this->getJson('/api/instituicoes');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['chave', 'valor']
                 ]);
    }

    /** @test */
    public function deve_retornar_os_convenios()
    {
        $response = $this->getJson('/api/convenios');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['chave', 'valor']
                 ]);
    }

    /** @test */
    public function verificando_dados_com_sucesso()
    {
        $payload = [
            'valor' => 1000,
            'instituicoes' => ['PAN'],
            'convenios' => ['INSS'],
            'parcela' => 12
        ];

        $response = $this->postJson('/api/simular', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                             'taxa',
                             'parcelas',
                             'valor_parcela',
                             'convenio'
                         ]

                 ]);
    }

    /** @test */
    public function  verificando_dados_invalidos()
    {
        $payload = [
            'valor' => -100,
            'instituicoes' => ['INVALIDO'],
            'convenios' => ['ERRADO'],
            'parcela' => 0
        ];

        $response = $this->postJson('/api/simular', $payload);

        $response->assertStatus(422)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Validation errors',
                 ])
                 ->assertJsonStructure([
                     'errors' => [
                         'valor',
                         'instituicoes.0',
                         'convenios.0',
                         'parcela'
                     ]
                 ]);
    }
}
