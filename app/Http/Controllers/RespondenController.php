<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responden;


class RespondenController extends Controller
{
     /**
     * Get all respondens names.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllRespondens()
    {
        $respondens = Responden::all(['id', 'name']);  // Only get id and name columns

        return response()->json([
            'message' => 'Respondens fetched successfully',
            'data' => $respondens
        ]);
    }

    /**
     * Get a specific responden by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRespondensById($id)
    {
        $respondens = Responden::find($id, ['id', 'name']);  // Find by ID and get only id and name columns

        if (!$respondens) {
            return response()->json([
                'message' => 'Respondens not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Respondens fetched successfully',
            'data' => $respondens
        ]);
    }
}
