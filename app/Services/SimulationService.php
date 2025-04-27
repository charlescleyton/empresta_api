<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SimulationService
{
    protected $instituicoes;
    protected $convenios;
    protected $taxas;

    public function __construct()
    {
        $this->instituicoes = json_decode(file_get_contents(base_path('instituicoes.json')), true);
        $this->convenios = json_decode(file_get_contents(base_path('convenios.json')), true);
        $this->taxas = json_decode(file_get_contents(base_path('taxas_instituicoes.json')), true);
    }

    public function getInstituicoes()
    {
        return collect($this->instituicoes)->select('chave', 'valor')->toArray();
    }

    public function getConvenios()
    {
        return collect(value: $this->convenios)->select('chave', 'valor')->toArray();
    }

    public function getData($request)
    {
        return collect($request)->select('chave', 'valor');
    }

    public function Simulate($valor, $instituicoes = [], $convenios = [], $parcela = null)
    {

    $simulacoes = [];

    foreach ($this->taxas as $item) {
        if ((!empty($instituicoes) && !in_array($item['instituicao'], $instituicoes)) ||
            (!empty($convenios) && !in_array($item['convenio'], $convenios)) ||
            (!is_null($parcela) && $item['parcelas'] != $parcela)
        ) {
            continue;
        }

        $simulacoes[$item['instituicao']][] = [
            'taxa' => $item['taxaJuros'],
            'parcelas' => $item['parcelas'],
            'valor_parcela' => round($valor * $item['coeficiente'], 2),
            'convenio' => $item['convenio'],
        ];
    }

    return $simulacoes;
}
}
