<?php 
    $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $student = $data['student'];
?>
<div class="form-card">
    <h2 class="form-title">Chỉnh sửa Thông tin Sinh viên</h2>

    <?php if (isset($data['errors']['general'])): ?>
        <div class="general-error">
            <?php echo htmlspecialchars($data['errors']['general']); ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="masv">Mã Sinh Viên <span style="color: var(--danger);">*</span></label>
                <input type="text" id="masv" name="masv" required value="<?php echo htmlspecialchars($_POST['masv'] ?? $student['masv']); ?>">
                <?php if (isset($data['errors']['masv'])): ?>
                    <div class="error-message"><?php echo htmlspecialchars($data['errors']['masv']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="hoten">Họ và Tên <span style="color: var(--danger);">*</span></label>
                <input type="text" id="hoten" name="hoten" required value="<?php echo htmlspecialchars($_POST['hoten'] ?? $student['hoten']); ?>">
                <?php if (isset($data['errors']['hoten'])): ?>
                    <div class="error-message"><?php echo htmlspecialchars($data['errors']['hoten']); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="gioitinh">Giới Tính</label>
                <select id="gioitinh" name="gioitinh">
                    <option value="">Chọn giới tính</option>
                    <?php 
                        $currentGender = $_POST['gioitinh'] ?? $student['gioitinh'] ?? '';
                    ?>
                    <option value="Nam" <?php echo $currentGender === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($currentGender === 'Nữ' || $currentGender === 'Nu') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $currentGender === 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ngaysinh">Ngày Sinh</label>
                <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo htmlspecialchars($_POST['ngaysinh'] ?? $student['ngaysinh'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="lop">Lớp</label>
                <input type="text" id="lop" name="lop" placeholder="VD: 68PM34" value="<?php echo htmlspecialchars($_POST['lop'] ?? $student['lop'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="diemtb">Điểm Trung Bình</label>
                <input type="number" id="diemtb" name="diemtb" step="0.01" min="0" max="10" placeholder="0.00 - 10.00" value="<?php echo htmlspecialchars($_POST['diemtb'] ?? $student['diemtb'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-actions">
            <a href="<?php echo $baseUrl; ?>/sinhvien" class="btn-cancel">Hủy</a>
            <button type="submit">Cập nhật thông tin</button>
        </div>
    </form>
</div>
