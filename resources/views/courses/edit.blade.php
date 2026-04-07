@extends('layouts.master')

@section('content')
<h2>Chỉnh sửa khóa học: <span class="text-primary">{{ $course->name }}</span></h2>
@include('components.alert')

<div class="card">
    <div class="card-body">
        <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tên khóa học <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $course->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá (VND) <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control" value="{{ old('price', $course->price) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>
                @if($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" class="img-thumbnail mb-2" width="200">
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Chọn ảnh mới để thay thế</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="draft" {{ $course->status=='draft'?'selected':'' }}>Draft</option>
                    <option value="published" {{ $course->status=='published'?'selected':'' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật khóa học</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection