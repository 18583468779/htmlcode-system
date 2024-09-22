<?php

namespace App\Http\Controllers;

use App\Models\Tipic;
use App\Http\Requests\StoreTipicRequest;
use App\Http\Requests\UpdateTipicRequest;
use App\Http\Resources\TipicResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

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
        //
        return TipicResource::collection(Tipic::with('user')->paginate()); //返回所有的数据->关联user->分页
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreTipicRequest $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipicRequest $request, Tipic $tipic)
    {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tipic $tipic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipicRequest $request, Tipic $tipic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tipic $tipic)
    {
        //
    }
}