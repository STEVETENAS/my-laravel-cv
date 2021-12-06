<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerAcademicStore;
use App\Http\Requests\profilerAcademicUpdate;
use App\Http\Resources\profilerAcademicResource;
use App\Models\profilerAcademic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerAcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $profiler = profilerAcademic::with('profilerInfos');
        $query = profilerAcademic::query();
        $size = $request->query('size');
        $academics = $query->get();
        if ($size) {
            $academics = $query->paginate($size);
        }
        return profilerAcademicResource::collection($profiler->paginate(7))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerAcademicStore $request
     * @return profilerAcademicResource
     * @throws Exception
     */
    public function store(profilerAcademicStore $request): profilerAcademicResource
    {
        $academic = profilerAcademic::create($request->all());
        if ($academic) {
            return new profilerAcademicResource($academic);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerAcademicResource
     */
    public function show($id): JsonResponse|profilerAcademicResource
    {
        $academic = profilerAcademic::find($id);
        if (!$academic) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerAcademicResource::make($academic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerAcademicUpdate $request
     * @param int $id
     * @return profilerAcademicResource
     * @throws Exception
     */
    public function update(profilerAcademicUpdate $request, $id): profilerAcademicResource
    {
        $academic = profilerAcademic::find($id);
        if ($academic->update($request->all())) {
            $academic->flash();
            return new profilerAcademicResource($academic);
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
        $academic = profilerAcademic::find($id);
        if ($academic->delete()) {
            return ['data' => $academic->id];
        }
        throw new Exception('Unexpected Error');
    }
}
