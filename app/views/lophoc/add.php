<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="form-card">
    <h2 class="form-title">Thêm Lớp học Mới</h2>

    <?php if (isset($data['errors']['general'])): ?>
        <div class="general-error">
            <?php echo htmlspecialchars($data['errors']['general']); ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="malop">Mã Lớp <span style="color: var(--danger);">*</span></label>
            <input type="text" id="malop" name="malop" placeholder="VD: 68PM34" required value="<?php echo htmlspecialchars($_POST['malop'] ?? ''); ?>">
            <?php if (isset($data['errors']['malop'])): ?>
                <div class="error-message"><?php echo htmlspecialchars($data['errors']['malop']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="tenlop">Tên Lớp <span style="color: var(--danger);">*</span></label>
            <input type="text" id="tenlop" name="tenlop" placeholder="VD: Lớp Công nghệ phần mềm 68 PM 34" required value="<?php echo htmlspecialchars($_POST['tenlop'] ?? ''); ?>">
            <?php if (isset($data['errors']['tenlop'])): ?>
                <div class="error-message"><?php echo htmlspecialchars($data['errors']['tenlop']); ?></div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <a href="<?php echo $baseUrl; ?>/lophoc" class="btn-cancel">Hủy</a>
            <button type="submit">Lưu thông tin</button>
        </div>
    </form>
</div>
