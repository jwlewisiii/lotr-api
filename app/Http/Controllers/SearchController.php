<?php

namespace App\Http\Controllers;

use App\Services\ExternalApi\TheOneApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchByName(TheOneApiService $theOneApiService, string $name = null): JsonResponse
    {
        return response()->json($theOneApiService->getCharactersByName($name));
    }
}
