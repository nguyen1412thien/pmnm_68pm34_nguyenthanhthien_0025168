<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="form-card">
    <h2 class="form-title">Thêm Sinh viên Mới</h2>

    <?php if (isset($data['errors']['general'])): ?>
        <div class="general-error">
            <?php echo htmlspecialchars($data['errors']['general']); ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="masv">Mã Sinh Viên <span style="color: var(--danger);">*</span></label>
                <input type="text" id="masv" name="masv" placeholder="VD: SV001" required value="<?php echo htmlspecialchars($_POST['masv'] ?? ''); ?>">
                <?php if (isset($data['errors']['masv'])): ?>
                    <div class="error-message"><?php echo htmlspecialchars($data['errors']['masv']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="hoten">Họ và Tên <span style="color: var(--danger);">*</span></label>
                <input type="text" id="hoten" name="hoten" placeholder="VD: Nguyễn Văn A" required value="<?php echo htmlspecialchars($_POST['hoten'] ?? ''); ?>">
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
                    <option value="Nam" <?php echo (isset($_POST['gioitinh']) && $_POST['gioitinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo (isset($_POST['gioitinh']) && $_POST['gioitinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo (isset($_POST['gioitinh']) && $_POST['gioitinh'] === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ngaysinh">Ngày Sinh</label>
                <input type="date" id="ngaysinh" name="ngaysinh" value="<?php echo htmlspecialchars($_POST['ngaysinh'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="lop">Lớp (Tên tự do)</label>
                <input type="text" id="lop" name="lop" placeholder="VD: 68PM34" value="<?php echo htmlspecialchars($_POST['lop'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="malop">Chọn Lớp Học (Mã Lớp)</label>
                <select id="malop" name="malop">
                    <option value="">-- Chọn Lớp --</option>
                    <?php foreach ($data['classes'] as $cls): ?>
                        <option value="<?php echo htmlspecialchars($cls['malop']); ?>" <?php echo (isset($_POST['malop']) && $_POST['malop'] === $cls['malop']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cls['malop'] . ' - ' . $cls['tenlop']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="diemtb">Điểm Trung Bình</label>
                <input type="number" id="diemtb" name="diemtb" step="0.01" min="0" max="10" placeholder="0.00 - 10.00" value="<?php echo htmlspecialchars($_POST['diemtb'] ?? ''); ?>">
            </div>
            <div class="form-group">
                <!-- empty for layout grid alignment -->
            </div>
        </div>

        <div class="form-actions">
            <a href="<?php echo $baseUrl; ?>/sinhvien" class="btn-cancel">Hủy</a>
            <button type="submit">Lưu thông tin</button>
        </div>
    </form>
</div>
