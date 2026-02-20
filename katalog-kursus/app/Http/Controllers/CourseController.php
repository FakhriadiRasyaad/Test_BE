<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::with(['topic', 'language', 'createdBy'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'language_id' => 'required|exists:languages,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_rate' => 'required|numeric',
            'thumbnail_url' => 'required|string',
            'level' => 'required|in:ALL LEVEL,BEGINNER,INTERMEDIATE,ADVANCE',
        ]);

        $course = Course::create([
            ...$request->all(),
            'created_by_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Course berhasil dibuat',
            'data' => $course,
        ], 201);
    }

    public function show($id)
    {
        $course = Course::with(['topic', 'language', 'createdBy'])->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        $request->validate([
            'topic_id' => 'sometimes|exists:topics,id',
            'language_id' => 'sometimes|exists:languages,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'short_description' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'discount_rate' => 'sometimes|numeric',
            'thumbnail_url' => 'sometimes|string',
            'level' => 'sometimes|in:ALL LEVEL,BEGINNER,INTERMEDIATE,ADVANCE',
        ]);

        $course->update($request->all());

        return response()->json([
            'message' => 'Course berhasil diupdate',
            'data' => $course,
        ]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course berhasil dihapus']);
    }
}