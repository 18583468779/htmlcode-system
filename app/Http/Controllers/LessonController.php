<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\LessonResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class LessonController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Lesson $lesson)
    {
        //
        return LessonResource::collection(Lesson::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request, Lesson $lesson)
    {
        //
        Gate::authorize('create', Lesson::class);
        $lesson->fill($request->input())->save();
        return new LessonResource($lesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        //
        Gate::authorize('update', Lesson::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
        Gate::authorize('delete', Lesson::class);
    }
}