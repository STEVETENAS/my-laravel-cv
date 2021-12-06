<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerContractStore;
use App\Http\Requests\profilerContractUpdate;
use App\Http\Resources\profilerContractResource;
use App\Models\profilerContract;
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
        $query = profilerContract::query();
        $size = $request->query('size');
        $contracts = $query->get();
        if ($size) {
            $contracts = $query->paginate($size);
        }
        return profilerContractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerContractStore $request
     * @return profilerContractResource
     * @throws Exception
     */
    public function store(profilerContractStore $request): profilerContractResource
    {
        $contract = profilerContract::create($request->all());
        if ($contract) {
            return new profilerContractResource($contract);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerContractResource
     */
    public function show($id): JsonResponse|profilerContractResource
    {
        $contract = profilerContract::find($id);
        if (!$contract) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerContractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerContractUpdate $request
     * @param int $id
     * @return profilerContractResource
     * @throws Exception
     */
    public function update(profilerContractUpdate $request, $id): profilerContractResource
    {
        $contract = profilerContract::find($id);
        if ($contract->update($request->all())) {
            $contract->flash();
            return new profilerContractResource($contract);
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
        $contract = profilerContract::find($id);
        if ($contract->delete()) {
            return ['data' => $contract->id];
        }
        throw new Exception('Unexpected Error');
    }
}
