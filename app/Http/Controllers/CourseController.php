<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
       $query = Course::withTrashed()->withCount(['lessons', 'enrollments']); // Tối ưu N+1 + count relationship

        // Tìm kiếm nâng cao
         if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    //  Lọc theo trạng thái
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    //  Lọc theo giá
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $query->whereBetween('price', [
            $request->min_price,
            $request->max_price
        ]);
    }

        // Sắp xếp
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['price', 'students', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        $direction = $direction === 'asc' ? 'asc' : 'desc';
        if ($sort === 'students') {
            $query->orderBy('enrollments_count', $direction);
        } else {
            $query->orderBy($sort, $direction);
        }

        $courses = $query->paginate(4)->appends($request->query());

        return view('courses.index', compact('courses'));
    }

    public function create() { return view('courses.create'); }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Thêm khóa học thành công!');
    }

    public function edit(Course $course) { return view('courses.edit', compact('course')); }

    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            if ($course->image) Storage::disk('public')->delete($course->image);
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Đã xóa mềm khóa học!');
    }

    public function restore($id)
    {
        Course::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('courses.index')->with('success', 'Khôi phục khóa học thành công!');
    }
}
