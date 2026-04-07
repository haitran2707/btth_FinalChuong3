@extends('layouts.master')

@section('content')
<h2>Thêm bài học mới</h2>
@include('components.alert')

<div class="card">
    <div class="card-body">
        <form action="{{ route('lessons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Khóa học</label>
                <select name="course_id" class="form-select" required>
                    <option value="">Chọn khóa học</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tiêu đề bài học <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nội dung bài học</label>
                <textarea name="content" class="form-control" rows="6" required></textarea>
            </div>

            <div class="mb-3">
                <label>Video URL (YouTube, Vimeo...)</label>
                <input type="url" name="video_url" class="form-control">
            </div>

            <div class="mb-3">
                <label>Thứ tự hiển thị</label>
                <input type="number" name="order" class="form-control" value="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Lưu bài học</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection