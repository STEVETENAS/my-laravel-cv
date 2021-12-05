<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_residentStore;
use App\Http\Requests\profiler_residentUpdate;
use App\Http\Resources\profiler_residentResource;
use App\Models\profiler_resident;
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
        $query = profiler_resident::query();
        $size = $request->query('size');
        $residents = $query->get();
        if ($size) {
            $residents = $query->paginate($size);
        }
        return profiler_residentResource::collection($residents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_residentStore $request
     * @return profiler_residentResource
     * @throws Exception
     */
    public function store(profiler_residentStore $request): profiler_residentResource
    {
        $resident = profiler_resident::create($request->all());
        if ($resident) {
            return new profiler_residentResource($resident);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_residentResource
     */
    public function show($id): JsonResponse|profiler_residentResource
    {
        $resident = profiler_resident::find($id);
        if (!$resident) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_residentResource($resident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_residentUpdate $request
     * @param int $id
     * @return profiler_residentResource
     * @throws Exception
     */
    public function update(profiler_residentUpdate $request, $id): profiler_residentResource
    {
        $resident = profiler_resident::find($id);
        if ($resident->update($request->all())) {
            $resident->flash();
            return new profiler_residentResource($resident);
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
        $resident = profiler_resident::find($id);
        if ($resident->delete()) {
            return ['data' => $resident->id];
        }
        throw new Exception('Unexpected Error');
    }
}
