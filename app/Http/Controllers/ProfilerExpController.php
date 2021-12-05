<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_expStore;
use App\Http\Requests\profiler_expUpdate;
use App\Http\Resources\profiler_expResource;
use App\Models\profiler_exp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_exp::query();
        $size = $request->query('size');
        $exps = $query->get();
        if ($size) {
            $exps = $query->paginate($size);
        }
        return profiler_expResource::collection($exps);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_expStore $request
     * @return profiler_expResource
     * @throws Exception
     */
    public function store(profiler_expStore $request): profiler_expResource
    {
        $exp = profiler_exp::create($request->all());
        if ($exp) {
            return new profiler_expResource($exp);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_expResource
     */
    public function show($id): JsonResponse|profiler_expResource
    {
        $exp = profiler_exp::find($id);
        if (!$exp) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_expResource($exp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_expUpdate $request
     * @param int $id
     * @return profiler_expResource
     * @throws Exception
     */
    public function update(profiler_expUpdate $request, $id): profiler_expResource
    {
        $exp = profiler_exp::find($id);
        if ($exp->update($request->all())) {
            $exp->flash();
            return new profiler_expResource($exp);
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
        $exp = profiler_exp::find($id);
        if ($exp->delete()) {
            return ['data' => $exp->id];
        }
        throw new Exception('Unexpected Error');
    }
}
