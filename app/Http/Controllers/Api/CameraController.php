<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Camera::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'sensor_type' => 'required|string|max:255',
            'resolution' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $camera = Camera::create($validated);

        return response()->json([
            'message' => 'Camera berhasil ditambahkan',
            'data' => $camera
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $camera = Camera::find($id);

        if (!$camera) {
            return response()->json([
                'message' => 'Camera tidak ditemukan'
            ], 404);
        }

        return response()->json($camera);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $camera = Camera::find($id);

        if (!$camera) {
            return response()->json([
                'message' => 'Camera tidak ditemukan'
            ], 404);
        }

        $camera->update($request->all());

        return response()->json([
            'message' => 'Camera berhasil diupdate',
            'data' => $camera
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $camera = Camera::find($id);

        if (!$camera) {
            return response()->json([
                'message' => 'Camera tidak ditemukan'
            ], 404);
        }

        $camera->delete();

        return response()->json([
            'message' => 'Camera berhasil dihapus'
        ]);
    }
}
