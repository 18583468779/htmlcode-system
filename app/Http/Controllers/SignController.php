<?php

namespace App\Http\Controllers;

use App\Http\Resources\SignResource;
use App\Models\Sign;
use App\Http\Requests\StoreSignRequest;
use App\Http\Requests\UpdateSignRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class SignController extends Controller implements HasMiddleware
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSignRequest $request, Sign $sign)
    {
        //
        Gate::authorize('create', Sign::class);
        $sign->fill($request->validated())->save();
        return new SignResource($sign);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sign $sign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sign $sign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignRequest $request, Sign $sign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sign $sign)
    {
        //
    }
}
