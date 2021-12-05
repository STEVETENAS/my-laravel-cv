<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_infoStore;
use App\Http\Requests\profiler_infoUpdate;
use App\Http\Resources\profiler_infoResource;
use App\Models\profiler_info;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_info::query();
        $size = $request->query('size');
        $infos = $query->get();
        if ($size) {
            $infos = $query->paginate($size);
        }
        return profiler_infoResource::collection($infos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_infoStore $request
     * @return profiler_infoResource
     * @throws Exception
     */
    public function store(profiler_infoStore $request): profiler_infoResource
    {
        $info = profiler_info::create($request->all());
        if ($info) {
            return new profiler_infoResource($info);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_infoResource
     */
    public function show($id): JsonResponse|profiler_infoResource
    {
        $info = profiler_info::find($id);
        if (!$info) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_infoResource($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_infoUpdate $request
     * @param int $id
     * @return profiler_infoResource
     * @throws Exception
     */
    public function update(profiler_infoUpdate $request, $id): profiler_infoResource
    {
        $info = profiler_info::find($id);
        if ($info->update($request->all())) {
            $info->flash();
            return new profiler_infoResource($info);
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
        $info = profiler_info::find($id);
        if ($info->delete()) {
            return ['data' => $info->id];
        }
        throw new Exception('Unexpected Error');
    }
}
