@extends('layouts.master')

@section('content')
<h2>Thêm khóa học mới</h2>
@include('components.alert')

<div class="card">
    <div class="card-body">
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên khóa học <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                
            </div>

            <div class="mb-3">
                <label class="form-label">Giá (VND) <span class="text-danger">*</span></label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                       value="{{ old('price') }}" min="0.01" step="0.01" required>
                
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh khóa học</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
               
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status')=='draft'?'selected':'' }}>Draft</option>
                    <option value="published" {{ old('status')=='published'?'selected':'' }}>Published</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Lưu khóa học</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection