<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SimulationService
{
    protected $institutions;
    protected $agreements;
    protected $taxas;

    public function __construct()
    {
        $this->institutions = json_decode(Storage::get('instituicoes.json'), true);
        $this->agreements = json_decode(Storage::get('convenios.json'), true);
        $this->taxas = json_decode(Storage::get('taxas_instituicoes.json'), true);
    }

    public function getInstitutions()
    {
        return collect($this->institutions)->select('chave', 'valor')->toArray();
    }

    public function getAgreements()
    {
        return collect($this->agreements)->select('chave', 'valor')->toArray();
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
