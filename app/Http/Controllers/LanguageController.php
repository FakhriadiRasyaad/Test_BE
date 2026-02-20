<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return response()->json(Language::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = Language::create($request->all());

        return response()->json([
            'message' => 'Language berhasil dibuat',
            'data' => $language,
        ], 201);
    }

    public function show($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json(['message' => 'Language tidak ditemukan'], 404);
        }

        return response()->json($language);
    }

    public function update(Request $request, $id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json(['message' => 'Language tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        $language->update($request->all());

        return response()->json([
            'message' => 'Language berhasil diupdate',
            'data' => $language,
        ]);
    }

    public function destroy($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json(['message' => 'Language tidak ditemukan'], 404);
        }

        $language->delete();

        return response()->json(['message' => 'Language berhasil dihapus']);
    }
}