<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_skillStore;
use App\Http\Requests\profiler_skillUpdate;
use App\Http\Resources\profiler_skillResource;
use App\Models\profiler_skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_skill::query();
        $size = $request->query('size');
        $skills = $query->get();
        if ($size) {
            $skills = $query->paginate($size);
        }
        return profiler_skillResource::collection($skills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_skillStore $request
     * @return profiler_skillResource
     * @throws Exception
     */
    public function store(Request $request): profiler_skillResource
    {
        $skill = profiler_skill::create($request->all());
        if ($skill) {
            return new profiler_skillResource($skill);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_skillResource
     */
    public function show($id): JsonResponse|profiler_skillResource
    {
        $skill = profiler_skill::find($id);
        if (!$skill) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_skillResource($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_skillUpdate $request
     * @param int $id
     * @return profiler_skillResource
     * @throws Exception
     */
    public function update(profiler_skillUpdate $request, $id): profiler_skillResource
    {
        $skill = profiler_skill::find($id);
        if ($skill->update($request->all())) {
            $skill->flash();
            return new profiler_skillResource($skill);
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
        $skill = profiler_skill::find($id);
        if ($skill->delete()) {
            return ['data' => $skill->id];
        }
        throw new Exception('Unexpected Error');
    }
}
