<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_ipStore;
use App\Http\Requests\profiler_ipUpdate;
use App\Http\Resources\profiler_ipResource;
use App\Models\profiler_ip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerIpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_ip::query();
        $size = $request->query('size');
        $ips = $query->get();
        if ($size) {
            $ips = $query->paginate($size);
        }
        return profiler_ipResource::collection($ips);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_ipStore $request
     * @return profiler_ipResource
     * @throws Exception
     */
    public function store(profiler_ipStore $request): profiler_ipResource
    {
        $ip = profiler_ip::create($request->all());
        if ($ip) {
            return new profiler_ipResource($ip);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_ipResource
     */
    public function show($id): JsonResponse|profiler_ipResource
    {
        $ip = profiler_ip::find($id);
        if (!$ip) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_ipResource($ip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_ipUpdate $request
     * @param int $id
     * @return profiler_ipResource
     * @throws Exception
     */
    public function update(profiler_ipUpdate $request, $id): profiler_ipResource
    {
        $ip = profiler_ip::find($id);
        if ($ip->update($request->all())) {
            $ip->flash();
            return new profiler_ipResource($ip);
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
        $ip = profiler_ip::find($id);
        if ($ip->delete()) {
            return ['data' => $ip->id];
        }
        throw new Exception('Unexpected Error');
    }
}
