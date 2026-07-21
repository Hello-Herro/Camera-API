<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camera;
use Illuminate\Http\Request;
use App\Http\Resources\CameraResource;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Memanggil data dan menampilkan data berupa JSON pada Postman
        // return response()->json(
        //     Camera::all()
        // );

        // Memanggil data dan menampilkan data berupa JSON pada Postman menggunakan API Resource
        // return CameraResource::collection(
        //     Camera::all()
        // );

        // Memanggil data dan menampilkan data berupa JSON pada Postman menggunakan API Resource dan Pagination agar data yang terpanggil tidak langsung semua
        // Standar API Modern
        // $cameras = Camera::paginate(5);

        // return CameraResource::collection($cameras);

        //Memanggil data pada GET Postman lebih spesifik menggunakan Search nama atau brand
        // $query = Camera::query();

        // if ($request->search) {
        //     $query->where('name', 'like', '%' . $request->search . '%')
        //         ->orWhere('brand', 'like', '%' . $request->search . '%');
        // }
        // // menambahkan Sorting terhadap pricce (Opsional)
        // if ($request->sort) {
        //     $query->orderBy($request->sort);
        // }

        // $cameras = $query->paginate(5);

        // return CameraResource::collection($cameras);

        $query = Camera::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        return CameraResource::collection(
            $query->paginate(5)
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
        // $camera = Camera::find($id);

        // if (!$camera) {
        //     return response()->json([
        //         'message' => 'Camera tidak ditemukan'
        //     ], 404);
        // }

        // return response()->json($camera);
        $camera = Camera::findOrFail($id);

        return new CameraResource($camera);
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
