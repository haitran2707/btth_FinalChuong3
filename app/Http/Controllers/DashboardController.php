<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $totalRevenue = Enrollment::with('course')->get()->sum(fn($en) => $en->course?->price ?? 0);

        $topCourse = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->first();

        $courseStats = Course::withCount('enrollments')
        ->get()
        ->map(function ($course) {
        $course->revenue = $course->price * $course->enrollments_count;
        return $course;
        });

        $recentCourses = Course::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalCourses', 'totalStudents', 'totalRevenue', 'topCourse', 'recentCourses', 'courseStats'
        ));
    }
}
