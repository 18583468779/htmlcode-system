<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Resources\PackageResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller implements HasMiddleware
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
        return PackageResource::collection(Package::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request, Package $package)
    {
        //
        Gate::authorize('create', $package);
        $package->fill($request->validated())->save();
        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     */
    public function show(package $package)
    {
        //
        return new PackageResource($package);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, package $package)
    {
        //
        Gate::authorize('update', $package);
        $package->fill($request->validated())->save();
        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(package $package)
    {
        Gate::authorize('delete', $package);
        $package->delete();
        return response()->noContent();
    }
}
