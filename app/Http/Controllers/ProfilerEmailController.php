<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerEmailStore;
use App\Http\Requests\profilerEmailUpdate;
use App\Http\Resources\profilerEmailResource;
use App\Models\profilerEmail;
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
        $query = profilerEmail::query();
        $size = $request->query('size');
        $emails = $query->get();
        if ($size) {
            $emails = $query->paginate($size);
        }
        return profilerEmailResource::collection($emails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerEmailStore $request
     * @return profilerEmailResource|Response
     * @throws Exception
     */
    public function store(profilerEmailStore $request): profilerEmailResource|Response
    {
        $email = profilerEmail::create($request->all());
        if ($email) {
            return new profilerEmailResource($email);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerEmailResource
     */
    public function show($id): JsonResponse|profilerEmailResource
    {
        $email = profilerEmail::find($id);
        if (!$email) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerEmailResource($email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerEmailUpdate $request
     * @param int $id
     * @return profilerEmailResource
     * @throws Exception
     */
    public function update(profilerEmailUpdate $request, $id): profilerEmailResource
    {
        $email = profilerEmail::find($id);
        if ($email->update($request->all())) {
            $email->flash();
            return new profilerEmailResource($email);
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
        $email = profilerEmail::find($id);
        if ($email->delete()) {
            return ['data' => $email->id];
        }
        throw new Exception('Unexpected Error');
    }
}
