<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class SimulationController extends Controller
{
    public function getInstitutions()
    {
        $instituicaoJson = json_decode(Storage::get('instituicoes.json', true));
        return $this->getData($instituicaoJson);
    }
    private function getData($request){

        return collect($request)->select('chave', 'valor')->toArray();
    }
}
