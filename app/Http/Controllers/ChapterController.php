<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Http\Resources\ChapterResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        // 当前类所有的方法都需要登录验证
        // return ['auth'];
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ChapterResource::collection(Chapter::paginate(request('row', 12)));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request)
    {
        //
        Gate::authorize('create', Chapter::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
        return new ChapterResource($chapter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
}