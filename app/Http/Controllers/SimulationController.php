<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulationRequest;
use App\Services\SimulationService;

class SimulationController extends Controller
{

    protected $simulationService;

    public function __construct(SimulationService $simulationService)
    {
        $this->simulationService = $simulationService;
    }

    public function getInstituicoes()
    {
        return response()->json($this->simulationService->getInstituicoes());
    }

    public function getConvenios()
    {
        return response()->json($this->simulationService->getConvenios());
    }

    public function simulate(SimulationRequest $request)
    {
        $validated = $request->validated();

        $service = $this->simulationService->Simulate(
            $validated['valor'],
            $validated['instituicoes'] ?? null,
            $validated['convenios'] ?? null,
            $validated['parcela'] ?? null);

            return response()->json(data: $service);
        }



}
