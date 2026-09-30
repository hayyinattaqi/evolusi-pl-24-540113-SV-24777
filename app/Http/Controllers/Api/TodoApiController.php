<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoApiController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Todo::latest()->get());
    }

    public function summary(): JsonResponse
    {
        $total = Todo::count();
        $selesai = Todo::where('is_done', true)->count();

        return response()->json([
            'total' => $total,
            'selesai' => $selesai,
            'belum_selesai' => $total - $selesai,
        ]);
    }
}