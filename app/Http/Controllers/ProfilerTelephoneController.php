<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_telephoneStore;
use App\Http\Requests\profiler_telephoneUpdate;
use App\Http\Resources\profiler_telephoneResource;
use App\Models\profiler_telephone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerTelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_telephone::query();
        $size = $request->query('size');
        $telephones = $query->get();
        if ($size) {
            $telephones = $query->paginate($size);
        }
        return profiler_telephoneResource::collection($telephones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_telephoneStore $request
     * @return profiler_telephoneResource
     * @throws Exception
     */
    public function store(profiler_telephoneStore $request): profiler_telephoneResource
    {
        $telephone = profiler_telephone::create($request->all());
        if ($telephone) {
            return new profiler_telephoneResource($telephone);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_telephoneResource
     */
    public function show($id): JsonResponse|profiler_telephoneResource
    {
        $telephone = profiler_telephone::find($id);
        if (!$telephone) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_telephoneResource($telephone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_telephoneUpdate $request
     * @param int $id
     * @return profiler_telephoneResource
     * @throws Exception
     */
    public function update(profiler_telephoneUpdate $request, $id): profiler_telephoneResource
    {
        $telephone = profiler_telephone::find($id);
        if ($telephone->update($request->all())) {
            $telephone->flash();
            return new profiler_telephoneResource($telephone);
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
        $telephone = profiler_telephone::find($id);
        if ($telephone->delete()) {
            return ['data' => $telephone->id];
        }
        throw new Exception('Unexpected Error');
    }
}
