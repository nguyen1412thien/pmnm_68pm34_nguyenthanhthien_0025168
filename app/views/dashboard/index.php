<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hệ thống Quản lý</title>
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            font-weight: 500;
            color: #c7d2fe;
            font-size: 0.95rem;
        }

        a.btn-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            text-decoration: none;
            background-color: var(--danger);
            color: white;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }

        a.btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        .container {
            max-width: 1000px;
            margin: 3.5rem auto;
            padding: 0 1.5rem;
        }

        .welcome-section {
            margin-bottom: 3rem;
        }

        .welcome-section h2 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.025em;
        }

        .welcome-section p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #c7d2fe;
        }

        .card-icon {
            background-color: #e0e7ff;
            color: var(--primary);
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .card-icon svg {
            width: 2rem;
            height: 2rem;
        }

        .card h3 {
            margin: 0 0 0.75rem 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 0 0 1.5rem 0;
            flex-grow: 1;
        }

        .card-action {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: gap 0.2s ease;
        }

        .card:hover .card-action {
            gap: 0.75rem;
        }
    </style>
</head>
<body>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
    <header>
        <h1>Hệ Thống Quản Lý</h1>
        <div class="header-actions">
            <span class="user-info">Xin chào, <?php echo htmlspecialchars($data['username']); ?></span>
            <a href="<?php echo $baseUrl; ?>/login/logout" class="btn-danger">Đăng xuất</a>
        </div>
    </header>

    <div class="container">
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
    </div>
</body>
</html>