<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return response()->json(Topic::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:topics,id',
        ]);

        $topic = Topic::create($request->all());

        return response()->json([
            'message' => 'Topic berhasil dibuat',
            'data' => $topic,
        ], 201);
    }

    public function show($id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return response()->json(['message' => 'Topic tidak ditemukan'], 404);
        }

        return response()->json($topic);
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return response()->json(['message' => 'Topic tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:topics,id',
        ]);

        $topic->update($request->all());

        return response()->json([
            'message' => 'Topic berhasil diupdate',
            'data' => $topic,
        ]);
    }

    public function destroy($id)
{
    $topic = Topic::find($id);

    if (!$topic) {
        return response()->json(['message' => 'Topic tidak ditemukan'], 404);
    }

    try {
        $topic->delete();
        return response()->json(['message' => 'Topic berhasil dihapus']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Topic tidak bisa dihapus karena masih digunakan oleh course'], 422);
    }
}
}