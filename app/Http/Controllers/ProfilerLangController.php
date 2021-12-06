<?php

namespace App\Http\Controllers;

use App\Http\Requests\profilerLangStore;
use App\Http\Requests\profilerLangUpdate;
use App\Http\Resources\profilerLangResource;
use App\Models\profilerLang;
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
        $query = profilerLang::query();
        $size = $request->query('size');
        $langs = $query->get();
        if ($size) {
            $langs = $query->paginate($size);
        }
        return profilerLangResource::collection($langs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param profilerLangStore $request
     * @return profilerLangResource
     * @throws Exception
     */
    public function store(profilerLangStore $request): profilerLangResource
    {
        $lang = profilerLang::create($request->all());
        if ($lang) {
            return new profilerLangResource($lang);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerLangResource
     */
    public function show($id): JsonResponse|profilerLangResource
    {
        $lang = profilerLang::find($id);
        if (!$lang) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return new profilerLangResource($lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param profilerLangUpdate $request
     * @param int $id
     * @return profilerLangResource
     * @throws Exception
     */
    public function update(profilerLangUpdate $request, $id): profilerLangResource
    {
        $lang = profilerLang::find($id);
        if ($lang->update($request->all())) {
            $lang->flash();
            return new profilerLangResource($lang);
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
        $lang = profilerLang::find($id);
        if ($lang->delete()) {
            return ['data' => $lang->id];
        }
        throw new Exception('Unexpected Error');
    }
}
