@extends('layouts.master')
@section('content')
<h2>Dashboard</h2>
<div class="row">
    <div class="col-md-3"><div class="card text-center"><div class="card-body"><h4>{{ $totalCourses }}</h4><p>Tổng khóa học</p></div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body"><h4>{{ $totalStudents }}</h4><p>Tổng học viên</p></div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body"><h4>{{ number_format($totalRevenue) }} đ</h4><p>Tổng doanh thu</p></div></div></div>
    <div class="col-md-3"><div class="card text-center"><div class="card-body">
        <h5>Khóa học hot nhất</h5>
        <p><strong>{{ $topCourse?->name }}</strong> ({{ $topCourse?->enrollments_count ?? 0 }} học viên)</p>
    </div></div></div>
</div>

<h4 class="mt-4">5 khóa học mới nhất</h4>
<div class="row">
    @foreach($recentCourses as $course)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if($course->image)<img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" style="height:180px;object-fit:cover">@endif
                <div class="card-body">
                    <h5>{{ $course->name }}</h5>
                    <span class="badge bg-{{ $course->status=='published'?'success':'secondary' }}">{{ $course->status }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<h4 class="mt-4">Thống kê khóa học</h4>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Tên khóa học</th>
            <th>Số học viên</th>
            <th>Doanh thu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courseStats as $course)
        <tr>
            <td>{{ $course->name }}</td>
            <td>{{ $course->enrollments_count }}</td>
            <td>{{ number_format($course->revenue) }} đ</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection