<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ItemController extends Controller
{
    private function readData()
    {
        $json = file_get_contents(storage_path('app/items.json'));
        return json_decode($json, true);
    }

    #[OA\Get(path: "/items", summary: "Menampilkan semua data item")]
    #[OA\Response(response: 200, description: "Menampilkan semua data")]
    public function index()
    {
        $data = $this->readData();
        return response()->json($data);
    }

    #[OA\Get(path: "/items/{id}", summary: "Read item berdasarkan ID")]
    #[OA\Parameter(name: "id", in: "path", required: true, description: "ID Item")]
    #[OA\Response(response: 200, description: "Data Item")]
    #[OA\Response(response: 404, description: "Item tidak ditemukan")]
    public function show($id)
    {
        $data = $this->readData();

        foreach ($data as $item) {
            if ($item['id'] == $id) {
                return response()->json($item);
            }
        }

        return response()->json([
            "message" => "Item dengan ID $id tidak Ditemukan"
        ], 404);
    }

    #[OA\Post(path: "/items", summary: "Menambahkan data item baru")]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "nama", type: "string"),
                new OA\Property(property: "harga", type: "integer")
            ]
        )
    )]
    #[OA\Response(response: 201, description: "Item berhasil ditambahkan")]
    #[OA\Response(response: 422, description: "Validasi Gagal")]
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric'
        ]);

        $data = $this->readData();
        
        $newId = count($data) > 0 ? max(array_column($data, 'id')) + 1 : 1;

        $newItem = [
            "id" => $newId,
            "nama" => $request->nama,
            "harga" => $request->harga
        ];

        $data[] = $newItem;

        file_put_contents(storage_path('app/items.json'), json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            "message" => "Item berhasil ditambahkan",
            "data" => $newItem
        ], 201);
    }

    #[OA\Put(path: "/items/{id}", summary: "Mengupdate semua detail item")]
    #[OA\Parameter(name: "id", in: "path", required: true)]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "nama", type: "string"),
                new OA\Property(property: "harga", type: "integer")
            ]
        )
    )]
    #[OA\Response(response: 200, description: "Item berhasil diupdate full")]
    #[OA\Response(response: 404, description: "Item tidak ditemukan")]
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric'
        ]);

        $data = $this->readData();
        $index = array_search($id, array_column($data, 'id'));

        if ($index === false) {
            return response()->json(["message" => "Item dengan ID $id tidak Ditemukan"], 404);
        }

        $data[$index]['nama'] = $request->nama;
        $data[$index]['harga'] = $request->harga;

        file_put_contents(storage_path('app/items.json'), json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            "message" => "Item berhasil diupdate full",
            "data" => $data[$index]
        ]);
    }

    #[OA\Patch(path: "/items/{id}", summary: "Mengupdate sebagian detail item")]
    #[OA\Parameter(name: "id", in: "path", required: true)]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "nama", type: "string"),
                new OA\Property(property: "harga", type: "integer")
            ]
        )
    )]
    #[OA\Response(response: 200, description: "Item berhasil diupdate sebagian")]
    #[OA\Response(response: 404, description: "Item tidak ditemukan")]
    public function patch(Request $request, $id)
    {
        $request->validate([
            'nama' => 'sometimes|string',
            'harga' => 'sometimes|numeric'
        ]);

        $data = $this->readData();
        $index = array_search($id, array_column($data, 'id'));

        if ($index === false) {
            return response()->json(["message" => "Item dengan ID $id tidak Ditemukan"], 404);
        }

        if ($request->has('nama')) {
            $data[$index]['nama'] = $request->nama;
        }
        if ($request->has('harga')) {
            $data[$index]['harga'] = $request->harga;
        }

        file_put_contents(storage_path('app/items.json'), json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            "message" => "Item berhasil diupdate sebagian",
            "data" => $data[$index]
        ]);
    }

    #[OA\Delete(path: "/items/{id}", summary: "Menghapus item")]
    #[OA\Parameter(name: "id", in: "path", required: true)]
    #[OA\Response(response: 200, description: "Item berhasil dihapus")]
    #[OA\Response(response: 404, description: "Item tidak ditemukan")]
    public function destroy($id)
    {
        $data = $this->readData();
        $index = array_search($id, array_column($data, 'id'));

        if ($index === false) {
            return response()->json(["message" => "Item dengan ID $id tidak Ditemukan"], 404);
        }

        array_splice($data, $index, 1);

        file_put_contents(storage_path('app/items.json'), json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            "message" => "Item berhasil dihapus"
        ]);
    }
}