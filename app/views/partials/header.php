<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title'] ?? 'Hệ thống Quản lý'; ?></title>
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
            display: flex;
            flex-direction: column;
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
            width: 100%;
            box-sizing: border-box;
        }

        .card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        /* Table styles */
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

        /* Form Layouts */
        .form-card {
            background-color: var(--surface);
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border);
            padding: 2.5rem;
            max-width: 650px;
            margin: 0 auto;
        }

        .form-title {
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 2rem;
            background-color: #fafafa;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .pagination {
            display: flex;
            gap: 0.375rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            height: 2.25rem;
            padding: 0 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-main);
            background-color: white;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination-link:hover:not(.disabled):not(.active) {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
        }

        .pagination-link.active {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            cursor: default;
        }

        .pagination-link.disabled {
            color: #cbd5e1;
            background-color: #f8fafc;
            border-color: var(--border);
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Dashboard specific styles */
        .welcome-section {
            background: linear-gradient(135deg, #4f46e5 0%, #312e81 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 1rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .welcome-section h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.875rem;
            font-weight: 700;
        }
        .welcome-section p {
            margin: 0;
            color: #c7d2fe;
            font-size: 1.05rem;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .grid a.card {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            transition: all 0.3s ease;
        }
        .grid a.card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--primary);
        }
        .card-icon {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 0.75rem;
            background-color: #e0e7ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .card-icon svg {
            width: 1.75rem;
            height: 1.75rem;
        }
        .grid .card h3 {
            margin: 0 0 0.75rem 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }
        .grid .card p {
            margin: 0 0 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
            flex-grow: 1;
        }
        .card-action {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
        }
        .card-action span {
            transition: transform 0.2s ease;
        }
        .grid a.card:hover .card-action span {
            transform: translateX(4px);
        }
    </style>
</head>
<body>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
    <header>
        <h1>Hệ Thống Quản Lý</h1>
        <div class="header-actions">
            <span class="user-info">Xin chào, <?php echo htmlspecialchars($data['username'] ?? 'User'); ?></span>
            <a href="<?php echo $baseUrl; ?>/dashboard" class="btn btn-secondary">Dashboard</a>
            <a href="<?php echo $baseUrl; ?>/lophoc" class="btn btn-secondary">Quản lý Lớp</a>
            <a href="<?php echo $baseUrl; ?>/sinhvien" class="btn btn-secondary">Quản lý SV</a>
            <a href="<?php echo $baseUrl; ?>/login/logout" class="btn btn-danger">Đăng xuất</a>
        </div>
    </header>
