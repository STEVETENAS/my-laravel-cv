<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerResidentStore;
use App\Http\Requests\profilerResidentUpdate;
use App\Http\Resources\profilerResidentResource;
use App\Models\profilerResident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerResident::query();
        $size = $request->query('size');
        $residents = $query->get();
        if ($size) {
            $residents = $query->paginate($size);
        }
        return profilerResidentResource::collection($residents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerResidentStore $request
     * @return profilerResidentResource
     * @throws Exception
     */
    public function store(profilerResidentStore $request): profilerResidentResource
    {
        $resident = profilerResident::create($request->all());
        if ($resident) {
            return new profilerResidentResource($resident);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerResidentResource
     */
    public function show($id): JsonResponse|profilerResidentResource
    {
        $resident = profilerResident::find($id);
        if (!$resident) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerResidentResource($resident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerResidentUpdate $request
     * @param int $id
     * @return profilerResidentResource
     * @throws Exception
     */
    public function update(profilerResidentUpdate $request, $id): profilerResidentResource
    {
        $resident = profilerResident::find($id);
        if ($resident->update($request->all())) {
            $resident->flash();
            return new profilerResidentResource($resident);
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
        $resident = profilerResident::find($id);
        if ($resident->delete()) {
            return ['data' => $resident->id];
        }
        throw new Exception('Unexpected Error');
    }
}
