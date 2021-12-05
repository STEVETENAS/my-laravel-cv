<?php

namespace App\Http\Controllers;

use App\Http\Requests\profiler_langStore;
use App\Http\Requests\profiler_langUpdate;
use App\Http\Resources\profiler_langResource;
use App\Models\profiler_lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerLangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profiler_lang::query();
        $size = $request->query('size');
        $langs = $query->get();
        if ($size) {
            $langs = $query->paginate($size);
        }
        return profiler_langResource::collection($langs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profiler_langStore $request
     * @return profiler_langResource
     * @throws Exception
     */
    public function store(profiler_langStore $request): profiler_langResource
    {
        $lang = profiler_lang::create($request->all());
        if ($lang) {
            return new profiler_langResource($lang);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profiler_langResource
     */
    public function show($id): JsonResponse|profiler_langResource
    {
        $lang = profiler_lang::find($id);
        if (!$lang) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profiler_langResource($lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profiler_langUpdate $request
     * @param int $id
     * @return profiler_langResource
     * @throws Exception
     */
    public function update(profiler_langUpdate $request, $id): profiler_langResource
    {
        $lang = profiler_lang::find($id);
        if ($lang->update($request->all())) {
            $lang->flash();
            return new profiler_langResource($lang);
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
        $lang = profiler_lang::find($id);
        if ($lang->delete()) {
            return ['data' => $lang->id];
        }
        throw new Exception('Unexpected Error');
    }
}
