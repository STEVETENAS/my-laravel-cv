<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerMedicalStore;
use App\Http\Requests\profilerMedicalUpdate;
use App\Http\Resources\profilerMedicalResource;
use App\Models\profilerMedical;
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
        $query = profilerMedical::query();
        $size = $request->query('size');
        $medicals = $query->get();
        if ($size) {
            $medicals = $query->paginate($size);
        }
        return profilerMedicalResource::collection($medicals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerMedicalStore $request
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function store(profilerMedicalStore $request): profilerMedicalResource
    {
        $medical = profilerMedical::create($request->all());
        if ($medical) {
            return new profilerMedicalResource($medical);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerMedicalResource
     */
    public function show($id): JsonResponse|profilerMedicalResource
    {
        $medical = profilerMedical::find($id);
        if (!$medical) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerMedicalResource($medical);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerMedicalUpdate $request
     * @param int $id
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function update(profilerMedicalUpdate $request, $id): profilerMedicalResource
    {
        $medical = profilerMedical::find($id);
        if ($medical->update($request->all())) {
            $medical->flash();
            return new profilerMedicalResource($medical);
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
        $medical = profilerMedical::find($id);
        if ($medical->delete()) {
            return ['data' => $medical->id];
        }
        throw new Exception('Unexpected Error');
    }
}
