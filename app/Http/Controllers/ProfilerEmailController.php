<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_emailStore;
use App\Http\Requests\profiler_emailUpdate;
use App\Http\Resources\profiler_emailResource;
use App\Models\profiler_email;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_email::query();
        $size = $request->query('size');
        $emails = $query->get();
        if ($size) {
            $emails = $query->paginate($size);
        }
        return profiler_emailResource::collection($emails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_emailStore $request
     * @return profiler_emailResource|Response
     * @throws Exception
     */
    public function store(profiler_emailStore $request): profiler_emailResource|Response
    {
        $email = profiler_email::create($request->all());
        if ($email) {
            return new profiler_emailResource($email);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_emailResource
     */
    public function show($id): JsonResponse|profiler_emailResource
    {
        $email = profiler_email::find($id);
        if (!$email) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_emailResource($email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_emailUpdate $request
     * @param int $id
     * @return profiler_emailResource
     * @throws Exception
     */
    public function update(profiler_emailUpdate $request, $id): profiler_emailResource
    {
        $email = profiler_email::find($id);
        if ($email->update($request->all())) {
            $email->flash();
            return new profiler_emailResource($email);
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
        $email = profiler_email::find($id);
        if ($email->delete()) {
            return ['data' => $email->id];
        }
        throw new Exception('Unexpected Error');
    }
}
