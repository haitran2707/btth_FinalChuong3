<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Khóa học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white min-vh-100 p-3" style="width: 250px;">
        <h4 class="mb-4">Course CMS</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('courses.index') }}"><i class="fas fa-book"></i> Khóa học</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('lessons.index') }}"><i class="fas fa-book-open"></i> Bài học</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('enrollments.index') }}"><i class="fas fa-user-graduate"></i> Đăng ký</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>