@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between  align-items-center mb-4">
    <h2>Quản lý Đăng ký Học viên</h2>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm đăng ký mới
    </a>
</div>
@include('components.alert')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="text-muted">
        Tổng số học viên: <strong>{{ $totalStudents }}</strong>
    </h5>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Khóa học</th>
            <th>Học viên</th>
            <th>Email</th>
            <th>Ngày đăng ký</th>
        </tr>
    </thead>
    <tbody>
        @forelse($enrollments as $enrollment)
        <tr>
            <td>{{ $enrollment->course->name }}</td>
            <td>{{ $enrollment->student->name }}</td>
            <td>{{ $enrollment->student->email }}</td>
            <td>{{ $enrollment->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center">Chưa có đăng ký nào.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $enrollments->links() }}
@endsection