<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\Lesson;
use Date;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth', except: ['index'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return VideoResource::collection(Video::paginate(request('row', 10)));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        //章节（项目）-> 课程->视频
        // $request->validated("videos") ===  $request->videos; // 只会验证需要的字段
        // $videos =  collect($request->videos)->map(function ($data) {
        //     $video = new Video();
        //     $video->fill([...$data, "lesson_id" => request->lesson_id])->save();
        //     return $video;
        // });

        $lesson = Lesson::findOrFail($request->lesson_id);

        $videos = collect($request->videos)->map(function ($data) use ($lesson) {
            return $lesson->videos()->create($data);
        });
        return new VideoResource($videos);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
        Gate::authorize('view', $video);
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        Gate::authorize('update', $video);
        //更新视频操作
        $lesson = Lesson::findOrFail($request->lesson_id);

        $videos = collect($request->videos)->map(function ($data) use ($lesson) {
            return $lesson->videos()->updateOrCreate([
                'id' => $data->id ?? null // 判断视频是否有id，有id就是修改，没有就是新增
            ], $data);
        });
        return new VideoResource($videos);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
        Gate::authorize('delete', $video);
        $video->delete();
        return response(null, 204);
    }
}
