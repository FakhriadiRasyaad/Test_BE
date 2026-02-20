<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalTopics = Topic::count();
        $totalLanguages = Language::count();
        return view('admin.dashboard', compact('totalCourses', 'totalTopics', 'totalLanguages'));
    }

    // TOPICS
    public function topics()
    {
        $topics = Topic::all();
        return view('admin.topics', compact('topics'));
    }

    public function storeTopic(Request $request)
    {
        $request->validate(['name' => 'required', 'description' => 'nullable']);
        Topic::create($request->all());
        return back()->with('success', 'Topic berhasil ditambahkan!');
    }

    public function updateTopic(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());
        return back()->with('success', 'Topic berhasil diupdate!');
    }

    public function destroyTopic($id)
    {
        try {
            Topic::findOrFail($id)->delete();
            return back()->with('success', 'Topic berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Topic tidak bisa dihapus karena masih digunakan!');
        }
    }

    // LANGUAGES
    public function languages()
    {
        $languages = Language::all();
        return view('admin.languages', compact('languages'));
    }

    public function storeLanguage(Request $request)
    {
        $request->validate(['name' => 'required']);
        Language::create($request->all());
        return back()->with('success', 'Language berhasil ditambahkan!');
    }

    public function updateLanguage(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());
        return back()->with('success', 'Language berhasil diupdate!');
    }

    public function destroyLanguage($id)
    {
        try {
            Language::findOrFail($id)->delete();
            return back()->with('success', 'Language berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Language tidak bisa dihapus karena masih digunakan!');
        }
    }

    // COURSES
    public function courses()
    {
        $courses = Course::with(['topic', 'language'])->get();
        $topics = Topic::all();
        $languages = Language::all();
        return view('admin.courses', compact('courses', 'topics', 'languages'));
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'language_id' => 'required|exists:languages,id',
            'title' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'price' => 'required|numeric',
            'discount_rate' => 'required|numeric',
            'thumbnail_url' => 'required',
            'level' => 'required|in:ALL LEVEL,BEGINNER,INTERMEDIATE,ADVANCE',
        ]);

        Course::create([
            ...$request->all(),
            'created_by_id' => Auth::id(),
        ]);

        return back()->with('success', 'Course berhasil ditambahkan!');
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return back()->with('success', 'Course berhasil diupdate!');
    }

    public function destroyCourse($id)
    {
        Course::findOrFail($id)->delete();
        return back()->with('success', 'Course berhasil dihapus!');
    }
}