<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerInfoStore;
use App\Http\Requests\profilerInfoUpdate;
use App\Http\Resources\profilerInfoResource;
use App\Models\profilerInfo;
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
        $query = profilerInfo::query();
        $size = $request->query('size');
        $infos = $query->get();
        if ($size) {
            $infos = $query->paginate($size);
        }
        return profilerInfoResource::collection($infos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerInfoStore $request
     * @return profilerInfoResource
     * @throws Exception
     */
    public function store(profilerInfoStore $request): profilerInfoResource
    {
        $info = profilerInfo::create($request->all());
        if ($info) {
            return new profilerInfoResource($info);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerInfoResource
     */
    public function show($id): JsonResponse|profilerInfoResource
    {
        $info = profilerInfo::find($id);
        if (!$info) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerInfoResource($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerInfoUpdate $request
     * @param int $id
     * @return profilerInfoResource
     * @throws Exception
     */
    public function update(profilerInfoUpdate $request, $id): profilerInfoResource
    {
        $info = profilerInfo::find($id);
        if ($info->update($request->all())) {
            $info->flash();
            return new profilerInfoResource($info);
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
        $info = profilerInfo::find($id);
        if ($info->delete()) {
            return ['data' => $info->id];
        }
        throw new Exception('Unexpected Error');
    }
}
