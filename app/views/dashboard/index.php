<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="welcome-section">
    <h2>Chào mừng bạn quay trở lại!</h2>
    <p>Bạn đã đăng nhập thành công vào hệ thống quản trị.</p>
</div>

<div class="grid">
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