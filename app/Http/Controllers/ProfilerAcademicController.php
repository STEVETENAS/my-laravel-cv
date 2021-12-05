<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_academicStore;
use App\Http\Requests\profiler_academicUpdate;
use App\Http\Resources\profiler_academicResource;
use App\Models\profiler_academic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerAcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_academic::query();
        $size = $request->query('size');
        $academics = $query->get();
        if ($size) {
            $academics = $query->paginate($size);
        }
        return profiler_academicResource::collection($academics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_academicStore $request
     * @return profiler_academicResource
     * @throws Exception
     */
    public function store(profiler_academicStore $request): profiler_academicResource
    {
        $academic = profiler_academic::create($request->all());
        if ($academic) {
            return new profiler_academicResource($academic);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_academicResource
     */
    public function show($id): JsonResponse|profiler_academicResource
    {
        $academic = profiler_academic::find($id);
        if (!$academic) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_academicResource($academic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_academicUpdate $request
     * @param int $id
     * @return profiler_academicResource
     * @throws Exception
     */
    public function update(profiler_academicUpdate $request, $id): profiler_academicResource
    {
        $academic = profiler_academic::find($id);
        if ($academic->update($request->all())) {
            $academic->flash();
            return new profiler_academicResource($academic);
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
        $academic = profiler_academic::find($id);
        if ($academic->delete()) {
            return ['data' => $academic->id];
        }
        throw new Exception('Unexpected Error');
    }
}
