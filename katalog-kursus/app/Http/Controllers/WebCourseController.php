<?php

namespace App\Http\Controllers;

use App\Models\Course;

class WebCourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['topic', 'language'])->get();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with(['topic', 'language'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}