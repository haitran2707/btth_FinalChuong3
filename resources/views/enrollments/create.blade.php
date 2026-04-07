@extends('layouts.master')

@section('content')
<h2>Đăng ký khóa học</h2>
@include('components.alert')

<div class="card">
    <div class="card-body">
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Chọn khóa học <span class="text-danger">*</span></label>
                <select name="course_id" class="form-select" required>
                    <option value="">-- Chọn khóa học --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} - {{ number_format($course->price) }} đ</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tên học viên <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email học viên <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Đăng ký ngay</button>
            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection