<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpAddress\StoreRequest;
use App\Http\Requests\IpAddress\UpdateRequest;
use App\Http\Resources\IpAddressResource;
use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $ipAddresses = IpAddress::query()->get();

        return response()->json(IpAddressResource::collection($ipAddresses));
    }

    public function store(StoreRequest $request)
    {
        $ipAddress = IpAddress::create($request->validated());

        return response()->json(IpAddressResource::make($ipAddress));
    }

    public function update(UpdateRequest $request, IpAddress $ipAddress)
    {
        $ipAddress->label = $request->label;
        $ipAddress->save();

        return response()->json(IpAddressResource::make($ipAddress));
    }
}
