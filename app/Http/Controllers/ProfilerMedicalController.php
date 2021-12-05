<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_medicalStore;
use App\Http\Requests\profiler_medicalUpdate;
use App\Http\Resources\profiler_medicalResource;
use App\Models\profiler_medical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_medical::query();
        $size = $request->query('size');
        $medicals = $query->get();
        if ($size) {
            $medicals = $query->paginate($size);
        }
        return profiler_medicalResource::collection($medicals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_medicalStore $request
     * @return profiler_medicalResource
     * @throws Exception
     */
    public function store(profiler_medicalStore $request): profiler_medicalResource
    {
        $medical = profiler_medical::create($request->all());
        if ($medical) {
            return new profiler_medicalResource($medical);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_medicalResource
     */
    public function show($id): JsonResponse|profiler_medicalResource
    {
        $medical = profiler_medical::find($id);
        if (!$medical) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_medicalResource($medical);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_medicalUpdate $request
     * @param int $id
     * @return profiler_medicalResource
     * @throws Exception
     */
    public function update(profiler_medicalUpdate $request, $id): profiler_medicalResource
    {
        $medical = profiler_medical::find($id);
        if ($medical->update($request->all())) {
            $medical->flash();
            return new profiler_medicalResource($medical);
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
        $medical = profiler_medical::find($id);
        if ($medical->delete()) {
            return ['data' => $medical->id];
        }
        throw new Exception('Unexpected Error');
    }
}
