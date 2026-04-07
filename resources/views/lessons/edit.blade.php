@extends('layouts.master')

@section('content')
<h2>Chỉnh sửa bài học: <span class="text-primary">{{ $lesson->title }}</span></h2>

@include('components.alert')

<div class="card">
    <div class="card-body">
        <form action="{{ route('lessons.update', $lesson) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Khóa học -->
            <div class="mb-3">
                <label>Khóa học</label>
                <select name="course_id" class="form-select" required>
                    <option value="">Chọn khóa học</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ old('course_id', $lesson->course_id) == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tiêu đề -->
            <div class="mb-3">
                <label>Tiêu đề bài học <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $lesson->title) }}" required>
            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <label>Nội dung bài học</label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content', $lesson->content) }}</textarea>
            </div>

            <!-- Video -->
            <div class="mb-3">
                <label>Video URL</label>
                <input type="url" name="video_url" class="form-control"
                       value="{{ old('video_url', $lesson->video_url) }}">
            </div>

            <!-- Thứ tự -->
            <div class="mb-3">
                <label>Thứ tự hiển thị</label>
                <input type="number" name="order" class="form-control"
                       value="{{ old('order', $lesson->order) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật bài học</button>
            <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection