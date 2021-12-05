<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_projectStore;
use App\Http\Requests\profiler_projectUpdate;
use App\Http\Resources\profiler_projectResource;
use App\Models\profiler_project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_project::query();
        $size = $request->query('size');
        $projects = $query->get();
        if ($size) {
            $projects = $query->paginate($size);
        }
        return profiler_projectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_projectStore $request
     * @return profiler_projectResource
     * @throws Exception
     */
    public function store(profiler_projectStore $request): profiler_projectResource
    {
        $project = profiler_project::create($request->all());
        if ($project) {
            return new profiler_projectResource($project);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_projectResource
     */
    public function show($id): JsonResponse|profiler_projectResource
    {
        $project = profiler_project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_projectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_projectUpdate $request
     * @param int $id
     * @return profiler_projectResource
     * @throws Exception
     */
    public function update(profiler_projectUpdate $request, $id): profiler_projectResource
    {
        $project = profiler_project::find($id);
        if ($project->update($request->all())) {
            $project->flash();
            return new profiler_projectResource($project);
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
        $project = profiler_project::find($id);
        if ($project->delete()) {
            return ['data' => $project->id];
        }
        throw new Exception('Unexpected Error');
    }
}
