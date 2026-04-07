<?php

namespace App\Http\Controllers;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function create()
    {
        $courses = Course::published()->get(); // chỉ khóa published
        return view('enrollments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string',
            'email'     => 'required|email',
        ]);

        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        $exists = Enrollment::where('course_id', $request->course_id)
            ->where('student_id', $student->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Học viên đã đăng ký khóa học này!');
        }

        Enrollment::create([
            'course_id' => $request->course_id,
            'student_id' => $student->id,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Đăng ký thành công!');
    }

    public function index()
    {
        $enrollments = Enrollment::with(['course', 'student'])->paginate(15);
        // Tổng số học viên đã đăng ký (distinct)
        $totalStudents = Enrollment::distinct('student_id')->count('student_id');
        return view('enrollments.index', compact('enrollments', 'totalStudents'));
    }
}
