<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_contractStore;
use App\Http\Requests\profiler_contractUpdate;
use App\Http\Resources\profiler_contractResource;
use App\Models\profiler_contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_contract::query();
        $size = $request->query('size');
        $contracts = $query->get();
        if ($size) {
            $contracts = $query->paginate($size);
        }
        return profiler_contractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_contractStore $request
     * @return profiler_contractResource
     * @throws Exception
     */
    public function store(profiler_contractStore $request): profiler_contractResource
    {
        $contract = profiler_contract::create($request->all());
        if ($contract) {
            return new profiler_contractResource($contract);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_contractResource
     */
    public function show($id): JsonResponse|profiler_contractResource
    {
        $contract = profiler_contract::find($id);
        if (!$contract) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_contractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_contractUpdate $request
     * @param int $id
     * @return profiler_contractResource
     * @throws Exception
     */
    public function update(profiler_contractUpdate $request, $id): profiler_contractResource
    {
        $contract = profiler_contract::find($id);
        if ($contract->update($request->all())) {
            $contract->flash();
            return new profiler_contractResource($contract);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['data' => "mixed"])]
    public function destroy($id): array
    {
        $contract = profiler_contract::find($id);
        if ($contract->delete()) {
            return ['data' => $contract->id];
        }
        throw new Exception('Unexpected Error');
    }
}
