<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerIpStore;
use App\Http\Requests\profilerIpUpdate;
use App\Http\Resources\profilerIpResource;
use App\Models\profilerIp;
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
        $query = profilerIp::query();
        $size = $request->query('size');
        $ips = $query->get();
        if ($size) {
            $ips = $query->paginate($size);
        }
        return profilerIpResource::collection($ips);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerIpStore $request
     * @return profilerIpResource
     * @throws Exception
     */
    public function store(profilerIpStore $request): profilerIpResource
    {
        $ip = profilerIp::create($request->all());
        if ($ip) {
            return new profilerIpResource($ip);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerIpResource
     */
    public function show($id): JsonResponse|profilerIpResource
    {
        $ip = profilerIp::find($id);
        if (!$ip) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerIpResource::make($ip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerIpUpdate $request
     * @param int $id
     * @return profilerIpResource
     * @throws Exception
     */
    public function update(profilerIpUpdate $request, $id): profilerIpResource
    {
        $ip = profilerIp::find($id);
        if ($ip->update($request->all())) {
            $ip->flash();
            return new profilerIpResource($ip);
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
        $ip = profilerIp::find($id);
        if ($ip->delete()) {
            return ['data' => $ip->id];
        }
        throw new Exception('Unexpected Error');
    }
}
