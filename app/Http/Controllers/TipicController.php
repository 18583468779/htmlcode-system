<?php

namespace App\Http\Controllers;

use App\Models\Tipic;
use App\Http\Requests\StoreTipicRequest;
use App\Http\Requests\UpdateTipicRequest;
use App\Http\Resources\TipicResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TipicController extends Controller implements HasMiddleware
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
        //返回所有的数据->关联user->分页(用户不传row参数就默认10条)
        return TipicResource::collection(Tipic::with('user')->paginate(request('row', '10')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipicRequest $request, Tipic $tipic)
    {
        Gate::authorize('create', Tipic::class); // policy策略
        //新增一条帖子
        $tipic->fill($request->all());
        $tipic->user_id = Auth::id();
        // $tipic->title = $request->input('title');
        // $tipic->content = $request->input('content');
        $tipic->save();
        // return Auth::id(); // 返回当前用户
        return new TipicResource($tipic);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipic $tipic)
    {
        // 获取单条的帖子
        return new TipicResource($tipic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipicRequest $request, Tipic $tipic)
    {
        //
        if (Auth::id() !== $tipic->user_id) {
            // 不允许修改别人的帖子
            abort(403);
        }
        $tipic->fill($request->all()); // 使用 fill 方法填充数据
        $tipic->save(); // 保存更新后的数据
        return new TipicResource($tipic); // 返回更新后的帖子资源
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tipic $tipic)
    {
        //
    }
}