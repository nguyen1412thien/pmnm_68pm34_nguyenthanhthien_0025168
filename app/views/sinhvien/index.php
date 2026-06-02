<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sinh viên</title>
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
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
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

        a.btn {
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
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid #c7d2fe;
            color: #c7d2fe;
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        .card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fafafa;
        }

        .card-header h2 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            padding: 1rem 1.5rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-male {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .badge-female {
            background-color: #fce7f3;
            color: #be185d;
        }

        .badge-other {
            background-color: #f1f5f9;
            color: #475569;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.15s ease;
            font-size: 0.875rem;
        }

        .btn-edit {
            background-color: #fef3c7;
            color: #d97706;
            margin-right: 0.5rem;
        }

        .btn-edit:hover {
            background-color: #fde68a;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background-color: #fecaca;
            transform: scale(1.05);
        }

        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state svg {
            width: 4rem;
            height: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state p {
            margin: 0 0 1.5rem 0;
            font-size: 1rem;
        }

        .score-good {
            color: var(--success);
            font-weight: 600;
        }

        .score-average {
            color: var(--warning);
            font-weight: 600;
        }

        .score-bad {
            color: var(--danger);
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
    <header>
        <h1>Hệ Thống Quản Lý</h1>
        <div class="header-actions">
            <span class="user-info">Xin chào, <?php echo htmlspecialchars($data['username']); ?></span>
            <a href="<?php echo $baseUrl; ?>/dashboard" class="btn btn-secondary">Dashboard</a>
            <a href="<?php echo $baseUrl; ?>/login/logout" class="btn btn-danger">Đăng xuất</a>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Danh sách Sinh viên</h2>
                <a href="<?php echo $baseUrl; ?>/sinhvien/add" class="btn btn-primary">
                    + Thêm Sinh viên
                </a>
            </div>

            <div class="table-responsive">
                <?php if (empty($data['students'])): ?>
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p>Chưa có sinh viên nào trong danh sách.</p>
                        <a href="<?php echo $baseUrl; ?>/sinhvien/add" class="btn btn-primary">+ Thêm sinh viên đầu tiên</a>
                    </div>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Mã SV</th>
                                <th>Họ Tên</th>
                                <th>Giới Tính</th>
                                <th>Ngày Sinh</th>
                                <th>Lớp</th>
                                <th>Điểm TB</th>
                                <th style="text-align: right;">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['students'] as $student): ?>
                                <tr>
                                    <td style="font-weight: 600; color: var(--primary);"><?php echo htmlspecialchars($student['masv']); ?></td>
                                    <td style="font-weight: 500;"><?php echo htmlspecialchars($student['hoten']); ?></td>
                                    <td>
                                        <?php 
                                            $gender = trim($student['gioitinh']);
                                            if (strcasecmp($gender, 'Nam') === 0) {
                                                echo '<span class="badge badge-male">Nam</span>';
                                            } elseif (strcasecmp($gender, 'Nữ') === 0 || strcasecmp($gender, 'Nu') === 0) {
                                                echo '<span class="badge badge-female">Nữ</span>';
                                            } else {
                                                echo '<span class="badge badge-other">' . htmlspecialchars($gender ?: 'Chưa rõ') . '</span>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $student['ngaysinh'] 
                                                ? date('d/m/Y', strtotime($student['ngaysinh'])) 
                                                : '<span style="color: var(--text-muted)">-</span>'; 
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($student['lop'] ?: '-'); ?></td>
                                    <td>
                                        <?php 
                                            if ($student['diemtb'] !== null) {
                                                $score = (float)$student['diemtb'];
                                                $class = 'score-average';
                                                if ($score >= 8.0) $class = 'score-good';
                                                elseif ($score < 5.0) $class = 'score-bad';
                                                echo '<span class="' . $class . '">' . number_format($score, 2) . '</span>';
                                            } else {
                                                echo '<span style="color: var(--text-muted)">-</span>';
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <a href="<?php echo $baseUrl; ?>/sinhvien/edit/<?php echo $student['id']; ?>" class="btn-action btn-edit" title="Sửa">
                                            ✏️
                                        </a>
                                        <a href="<?php echo $baseUrl; ?>/sinhvien/delete/<?php echo $student['id']; ?>" class="btn-action btn-delete" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
