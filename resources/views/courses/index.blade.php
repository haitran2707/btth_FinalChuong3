@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Khóa học</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm khóa học mới
    </a>
</div>

@include('components.alert')

<!--  FORM TÌM KIẾM + SẮP XẾP -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('courses.index') }}" class="row g-3">

            <!--  TÌM KIẾM -->
            <div class="col-12">
                <h5>🔍 Tìm kiếm nâng cao</h5>
            </div>

            <!-- Tên khóa học -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Tên khóa học..."
                       value="{{ request('search') }}">
            </div>

            <!-- Giá -->
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control"
                       placeholder="Giá từ"
                       value="{{ request('min_price') }}">
            </div>

            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control"
                       placeholder="Giá đến"
                       value="{{ request('max_price') }}">
            </div>

            <!-- Trạng thái -->
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">-- Trạng thái --</option>
                    <option value="published" {{ request('status')=='published'?'selected':'' }}>
                        Published
                    </option>
                    <option value="draft" {{ request('status')=='draft'?'selected':'' }}>
                        Draft
                    </option>
                </select>
            </div>

            <!--  SẮP XẾP -->
            <div class="col-12 mt-3">
                <h5>🔽 Lọc & Sắp xếp</h5>
            </div>

            <!-- Sort -->
            <div class="col-md-4">
                <select name="sort" class="form-select">
                    <option value="">-- Sắp xếp theo --</option>
                    <option value="price" {{ request('sort')=='price'?'selected':'' }}>
                        Giá
                    </option>
                    <option value="students" {{ request('sort')=='students'?'selected':'' }}>
                        Số học viên
                    </option>
                    <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>
                        Ngày tạo
                    </option>
                </select>
            </div>

            <!-- Direction -->
            <div class="col-md-4">
                <select name="direction" class="form-select">
                    <option value="asc" {{ request('direction')=='asc'?'selected':'' }}>
                        Tăng dần
                    </option>
                    <option value="desc" {{ request('direction')=='desc'?'selected':'' }}>
                        Giảm dần
                    </option>
                </select>
            </div>

            <!-- Button -->
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-search"></i> Áp dụng
                </button>

                <a href="{{ route('courses.index') }}" class="btn btn-secondary w-100">
                    Reset
                </a>
            </div>

        </form>
    </div>
</div>

<!--  DANH SÁCH KHÓA HỌC -->
<div class="row">
    @forelse($courses as $course)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">

            <!-- Ảnh -->
            @if($course->image)
                <img src="{{ asset('storage/' . $course->image) }}" 
                     class="card-img-top" 
                     style="height:180px;object-fit:cover;">
            @endif

            <div class="card-body d-flex flex-column">
                
                <!-- Tên -->
                <h5 class="card-title">{{ $course->name }}</h5>
                <small class="text-muted">{{ $course->slug }}</small>

                <!-- Giá -->
                <p class="fw-bold mt-2 text-danger">
                    {{ number_format($course->price) }} đ
                </p>

                <!-- Trạng thái -->
                <span class="badge bg-{{ $course->status == 'published' ? 'success' : 'secondary' }}">
                    {{ ucfirst($course->status) }}
                </span>

                <!-- Thống kê -->
                <div class="mt-2">
                    <small>Bài học: {{ $course->lessons_count }}</small><br>
                    <small>Học viên: {{ $course->enrollments_count }}</small>
                </div>

                <!-- Action -->
                <div class="mt-auto pt-3">
                    @if(!$course->trashed())
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning w-100 mb-2">
                            <i class="fas fa-edit"></i> Sửa
                        </a>

                        <form action="{{ route('courses.destroy', $course) }}" method="POST"
                              onsubmit="return confirm('Xóa khóa học này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger w-100">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    @else
                        <form action="{{ route('courses.restore', $course->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success w-100">
                                <i class="fas fa-undo"></i> Khôi phục
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @empty
        <div class="col-12 text-center">
            <p>Chưa có khóa học nào.</p>
        </div>
    @endforelse
</div>

<!--  PAGINATION -->
{{ $courses->links() }}

@endsection