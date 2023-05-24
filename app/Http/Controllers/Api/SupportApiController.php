<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SupportService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupportRequest;
use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Resources\SupportResource;

class SupportApiController extends Controller
{
    public function __construct(
        protected SupportService $supportService
    ) {
    }

    public function index(Request $request)
    {
        $supports = $this->supportService->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );
        return ApiAdapter::toJson($supports);
    }

    public function store(SupportRequest $request)
    {
        $support = $this->supportService->create(
            CreateSupportDTO::makeFromRequest($request)
        );
        return new SupportResource($support);
    }

    public function show(string $id)
    {
        if (!$support = $this->supportService->get($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        };
        return new SupportResource($support);
    }

    public function update(SupportRequest $request, string $id)
    {
        $support = $this->supportService->update(
            UpdateSupportDTO::makeFromRequest($request, $id)
        );
        if (!$support) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        };

        return new SupportResource($support);
    }

    public function destroy(string $id)
    {
        if (!$this->supportService->get($id)) {
            return response()->json([
                'error' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        };
        $this->supportService->delete($id);
        return response()->json([], 204);
    }
}
