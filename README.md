# 📚 COURSE MANAGEMENT SYSTEM (Laravel)

## 📌 Giới thiệu

Hệ thống **Quản lý khóa học trực tuyến (Course Management System)** được xây dựng bằng Laravel.

Ứng dụng cho phép:

* Quản lý khóa học
* Quản lý bài học trong khóa học
* Quản lý học viên đăng ký
* Dashboard thống kê
* Tìm kiếm, lọc & sắp xếp nâng cao

---

## ⚙️ Yêu cầu hệ thống

* PHP >= 8.1
* Composer
* MySQL / MariaDB
* Node.js (tuỳ chọn)
* Laravel >= 10

---

## 🚀 Hướng dẫn cài đặt & chạy project

### 1. Clone project

```bash
git clone <repo-url>
cd course-management
```

---

### 2. Cài đặt thư viện

```bash
composer install
```

---

### 3. Tạo file môi trường

```bash
cp .env.example .env
```

---

### 4. Cấu hình database

Mở file `.env` và chỉnh:

```env
DB_DATABASE=course_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Tạo key ứng dụng

```bash
php artisan key:generate
```

---

### 6. Chạy migration

```bash
php artisan migrate
```

---

### 7. Tạo storage link (hiển thị ảnh)

```bash
php artisan storage:link
```

---

### 8. Chạy server

```bash
php artisan serve
```

👉 Truy cập:

```
http://127.0.0.1:8000
```

---

## 🧱 Cấu trúc project

```
app/
 ├── Models/
 │    ├── Course.php
 │    ├── Lesson.php
 │    ├── Student.php
 │    └── Enrollment.php
 │
 ├── Http/
 │    ├── Controllers/
 │    │    ├── CourseController.php
 │    │    ├── LessonController.php
 │    │    └── EnrollmentController.php
 │    │
 │    └── Requests/
 │         └── CourseRequest.php

resources/views/
 ├── courses/
 ├── lessons/
 ├── enrollments/
 └── layouts/master.blade.php

database/migrations/
 ├── create_courses_table.php
 ├── create_lessons_table.php
 ├── create_students_table.php
 └── create_enrollments_table.php
```

---

## 🔗 Quan hệ dữ liệu

* 1 Course → nhiều Lesson
* 1 Course → nhiều Enrollment
* 1 Student → nhiều Enrollment
* Course ↔ Student (Many-to-Many qua bảng enrollments)

---

## ✨ Chức năng chính

### 📘 Quản lý khóa học

* Thêm / sửa / xóa (Soft Delete)
* Khôi phục khóa học
* Upload ảnh
* Tự sinh slug
* Hiển thị số bài học & học viên

---

### 🎬 Quản lý bài học

* Thêm bài học theo khóa học
* Sắp xếp theo `order`
* Hiển thị theo từng khóa học

---

### 👨‍🎓 Quản lý đăng ký học

* Đăng ký khóa học
* Không cho trùng học viên trong cùng khóa
* Hiển thị danh sách học viên
* Tổng số học viên

---

### 📊 Dashboard

Hiển thị:

* Tổng số khóa học
* Tổng số học viên
* Tổng doanh thu
* Khóa học nhiều học viên nhất
* 5 khóa học mới nhất

---

## 🔍 Tính năng nâng cao

### 🔎 Tìm kiếm nâng cao

* Theo tên khóa học
* Theo giá (min → max)
* Theo trạng thái (draft / published)

---

### 🔃 Lọc & sắp xếp

* Theo giá
* Theo số học viên
* Theo ngày tạo

---

### 📈 Thống kê

* Doanh thu theo khóa học
* Tổng số học viên mỗi khóa

---

## ⚡ Tối ưu hệ thống

### Eloquent Optimization

```php
Course::with('lessons', 'enrollments')
```

👉 Tránh lỗi **N+1 Query**

---

### Scope sử dụng

```php
scopePublished()
scopePriceBetween()
```

---

## 🧪 Validation

Sử dụng Form Request:

```
app/Http/Requests/CourseRequest.php
```

Bao gồm:

* required
* numeric
* image upload
* validate status
* validate slug unique

---

## 📌 Lưu ý

* Slug được tự động sinh từ tên khóa học
* Soft Delete sử dụng:

```php
withTrashed()
restore()
```

* Ảnh lưu tại:

```
storage/app/public
```

---

## 🧪 Tài khoản test (nếu có)

Bạn có thể tự thêm dữ liệu qua:

* Trang Courses
* Trang Lessons
* Trang Enrollments

---

## 🎯 Demo nhanh

```bash
php artisan serve
```

👉 Mở trình duyệt:

```
http://localhost:8000
```

---

## ✅ Checklist hoàn thành

✔ CRUD Course
✔ CRUD Lesson
✔ Enrollment Management
✔ Dashboard thống kê
✔ Search + Filter + Sort
✔ Soft Delete + Restore
✔ Quan hệ Eloquent
✔ Validation (Form Request)
✔ Scope + Optimization

---

## 👨‍💻 Tác giả

* Sinh viên: Trần Đỗ Minh Hải
* Môn học: Laravel / Web Development

---

## 🚀 Ghi chú thêm

Bạn có thể nâng cấp thêm:

* Seeder dữ liệu mẫu
* API REST
* Phân quyền (Admin/User)
* Upload video thay vì link

---