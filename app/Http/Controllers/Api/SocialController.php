<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSociaRequest;
use App\Http\Requests\UpdateSocialRequest;
use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Social::all();
        return SocialResource::collection($socials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSociaRequest $request)
    {
        $social = Social::create($request->validated());
        return new SocialResource($social);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        return new SocialResource($social);
    }

    public function update(UpdateSocialRequest $request, Social $social)
    {
        $social->update($request->validated());
        return new SocialResource($social);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
