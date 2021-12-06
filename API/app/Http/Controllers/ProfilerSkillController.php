<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerSkillStore;
use App\Http\Requests\profilerSkillUpdate;
use App\Http\Resources\profilerSkillResource;
use App\Models\profilerSkill;
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
        $query = profilerSkill::query();
        $size = $request->query('size');
        $skills = $query->get();
        if ($size) {
            $skills = $query->paginate($size);
        }
        return profilerSkillResource::collection($skills);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerSkillStore $request
     * @return profilerSkillResource
     * @throws Exception
     */
    public function store(Request $request): profilerSkillResource
    {
        $skill = profilerSkill::create($request->all());
        if ($skill) {
            return new profilerSkillResource($skill);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerSkillResource
     */
    public function show($id): JsonResponse|profilerSkillResource
    {
        $skill = profilerSkill::find($id);
        if (!$skill) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerSkillResource::make($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerSkillUpdate $request
     * @param int $id
     * @return profilerSkillResource
     * @throws Exception
     */
    public function update(profilerSkillUpdate $request, $id): profilerSkillResource
    {
        $skill = profilerSkill::find($id);
        if ($skill->update($request->all())) {
            $skill->flash();
            return new profilerSkillResource($skill);
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
        $skill = profilerSkill::find($id);
        if ($skill->delete()) {
            return ['data' => $skill->id];
        }
        throw new Exception('Unexpected Error');
    }
}
