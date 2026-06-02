<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: white;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        a.btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            background-color: transparent;
            border: 1px solid #c7d2fe;
            color: #c7d2fe;
        }

        a.btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .container {
            max-width: 650px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border);
            padding: 2.5rem;
        }

        .card-title {
            margin-top: 0;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 550;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 0.95rem;
            color: var(--text-main);
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.825rem;
            margin-top: 0.375rem;
            font-weight: 500;
        }

        .form-actions {
            margin-top: 2.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        button[type="submit"] {
            padding: 0.75rem 1.75rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-cancel {
            padding: 0.75rem 1.75rem;
            background-color: white;
            border: 1px solid var(--border);
            color: var(--text-muted);
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background-color: #f1f5f9;
            color: var(--text-main);
        }

        .general-error {
            background-color: #fef2f2;
            border: 1px solid #fca5a5;
            color: #b91c1c;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
    <header>
        <h1>Hệ Thống Quản Lý</h1>
        <a href="<?php echo $baseUrl; ?>/sinhvien" class="btn-secondary">← Trở về danh sách</a>
    </header>

    <div class="container">
        <div class="card">
            <h2 class="card-title">Thêm Sinh viên Mới</h2>

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
                        <label for="lop">Lớp</label>
                        <input type="text" id="lop" name="lop" placeholder="VD: 68PM34" value="<?php echo htmlspecialchars($_POST['lop'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="diemtb">Điểm Trung Bình</label>
                        <input type="number" id="diemtb" name="diemtb" step="0.01" min="0" max="10" placeholder="0.00 - 10.00" value="<?php echo htmlspecialchars($_POST['diemtb'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?php echo $baseUrl; ?>/sinhvien" class="btn-cancel">Hủy</a>
                    <button type="submit">Lưu thông tin</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
