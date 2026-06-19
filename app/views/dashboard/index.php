<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="welcome-section">
    <h2>Chào mừng bạn quay trở lại!</h2>
    <p>Bạn đã đăng nhập thành công vào hệ thống quản trị.</p>
</div>

<div class="grid">
    <a href="<?php echo $baseUrl; ?>/lophoc" class="card">
        <div class="card-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
        </div>
        <h3>Quản lý Lớp học</h3>
        <p>Xem và chỉnh sửa danh sách các lớp học hiện có trong hệ thống. Thực hiện thêm mới, chỉnh sửa mã lớp, tên lớp hoặc xóa lớp học.</p>
        <div class="card-action">
            Truy cập ngay <span>→</span>
        </div>
    </a>

    <a href="<?php echo $baseUrl; ?>/sinhvien" class="card">
        <div class="card-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>
        <h3>Quản lý Sinh viên</h3>
        <p>Xem danh sách sinh viên lớp 68PM34. Thực hiện các hành động thêm mới, chỉnh sửa thông tin chi tiết hoặc xóa sinh viên.</p>
        <div class="card-action">
            Truy cập ngay <span>→</span>
        </div>
    </a>
</div>