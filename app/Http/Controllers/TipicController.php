<?php

namespace App\Http\Controllers;

use App\Models\Tipic;
use App\Http\Requests\StoreTipicRequest;
use App\Http\Requests\UpdateTipicRequest;
use App\Http\Resources\TipicResource;
use Illuminate\Support\Facades\Auth;

class TipicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TipicResource::collection(Tipic::paginate()); //返回所有的数据->分页
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
        // return $request->all();
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