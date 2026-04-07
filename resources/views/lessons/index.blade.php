@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Bài học</h2>
    <a href="{{ route('lessons.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm bài học mới
    </a>
</div>

@include('components.alert')

<!-- Danh sách bài học theo từng khóa -->
@forelse($lessons as $course)
    <div class="card mb-4 shadow-sm">
        
        <!-- Header khóa học -->
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <strong>{{ $course->name }}</strong>
            <span>{{ $course->lessons->count() }} bài học</span>
        </div>

        <!-- Nội dung -->
        <div class="card-body p-0">
            @if($course->lessons->count())
                <table class="table table-bordered mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tiêu đề bài học</th>
                            <th>Thứ tự</th>
                            <th>Video</th>
                            <th width="120">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->title }}</td>

                            <td>
                                <span class="badge bg-info">
                                    {{ $lesson->order }}
                                </span>
                            </td>

                            <td>
                                @if($lesson->video_url)
                                    <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-play"></i> Xem
                                    </a>
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-sm btn-warning mb-1">Sửa
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Xóa bài học này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xóa
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-3 text-muted text-center">
                    Chưa có bài học nào
                </div>
            @endif
        </div>
    </div>
@empty
    <div class="text-center">
        <p>Chưa có khóa học nào.</p>
    </div>
@endforelse

@endsection