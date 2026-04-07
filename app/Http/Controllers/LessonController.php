<?php

namespace App\Http\Controllers;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Course::with(['lessons' => function ($query) {
        $query->orderBy('order', 'asc');
        }])->get();
        return view('lessons.index', compact('lessons'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('lessons.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required',
            'content'   => 'required',
            'video_url' => 'nullable|url',
            'order'     => 'required|integer',
        ]);

        Lesson::create($data);
        return redirect()->route('lessons.index')->with('success', 'Thêm bài học thành công!');
    }

    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('lessons.edit', compact('lesson', 'courses'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required',
            'content'   => 'required',
            'video_url' => 'nullable|url',
            'order'     => 'required|integer',
        ]);
        $lesson->update($data);
        return redirect()->route('lessons.index')->with('success', 'Cập nhật bài học thành công!');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('lessons.index')->with('success', 'Xóa bài học thành công!');
    }
}
