<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="card">
    <div class="card-header">
        <h2>Danh sách Sinh viên</h2>
        <a href="<?php echo $baseUrl; ?>/sinhvien/add" class="btn btn-primary">
            + Thêm Sinh viên
        </a>
    </div>

    <!-- Form tìm kiếm nâng cao -->
    <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--border); background-color: #fafafa;">
        <form method="GET" action="<?php echo $baseUrl; ?>/sinhvien/index" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: flex-end;">
            <div style="flex: 1; min-width: 250px;">
                <label for="keyword" style="display: block; margin-bottom: 0.375rem; font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">Tìm kiếm (MSSV, Họ Tên)</label>
                <input type="text" id="keyword" name="keyword" placeholder="Nhập MSSV hoặc Họ tên..." value="<?php echo htmlspecialchars($data['keyword'] ?? ''); ?>" style="width: 100%; padding: 0.625rem 0.75rem; border: 1px solid var(--border); border-radius: 0.375rem; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div style="width: 250px;">
                <label for="lop_filter" style="display: block; margin-bottom: 0.375rem; font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">Lọc theo Lớp</label>
                <select id="lop_filter" name="lop_filter" style="width: 100%; padding: 0.625rem 0.75rem; border: 1px solid var(--border); border-radius: 0.375rem; font-size: 0.9rem; background-color: white; box-sizing: border-box;">
                    <option value="">-- Tất cả các lớp --</option>
                    <?php foreach ($data['classes'] as $cls): ?>
                        <option value="<?php echo htmlspecialchars($cls['malop']); ?>" <?php echo (isset($data['lop_filter']) && $data['lop_filter'] === $cls['malop']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cls['malop'] . ' - ' . $cls['tenlop']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" style="padding: 0.625rem 1.5rem; background-color: var(--primary); color: white; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s; height: 40px; display: inline-flex; align-items: center;">
                Tìm kiếm
            </button>
            <?php if (!empty($data['keyword']) || !empty($data['lop_filter'])): ?>
                <a href="<?php echo $baseUrl; ?>/sinhvien/index" style="padding: 0.625rem 1.5rem; background-color: #e2e8f0; color: var(--text-main); border: none; border-radius: 0.375rem; font-weight: 500; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; height: 40px; box-sizing: border-box;">
                    Xóa lọc
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="table-responsive">
        <?php if (empty($data['students'])): ?>
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p>Chưa có sinh viên nào khớp với điều kiện tìm kiếm.</p>
                <a href="<?php echo $baseUrl; ?>/sinhvien/add" class="btn btn-primary">+ Thêm sinh viên mới</a>
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
                        <th>Mã Lớp</th>
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
                                    $gender = trim($student['gioitinh'] ?? '');
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
                            <td style="font-weight: 600; color: #475569;"><?php echo htmlspecialchars($student['malop'] ?: '-'); ?></td>
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

            <?php
            $currentPage = $data['currentPage'] ?? 1;
            $totalPages = $data['totalPages'] ?? 1;
            $totalStudents = $data['totalStudents'] ?? 0;
            $limit = $data['limit'] ?? 5;
            $offset = ($currentPage - 1) * $limit;

            // Xây dựng query string cho phân trang
            $queryParams = [];
            if (!empty($data['keyword'])) {
                $queryParams['keyword'] = $data['keyword'];
            }
            if (!empty($data['lop_filter'])) {
                $queryParams['lop_filter'] = $data['lop_filter'];
            }
            $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
            ?>
            <div class="pagination-container">
                <div class="pagination-info">
                    Hiển thị từ <?php echo ($totalStudents > 0) ? ($offset + 1) : 0; ?> đến <?php echo min($offset + $limit, $totalStudents); ?> trong số <?php echo $totalStudents; ?> sinh viên
                </div>
                <div class="pagination">
                    <!-- Nút Trước -->
                    <?php if ($currentPage > 1): ?>
                        <a href="<?php echo $baseUrl; ?>/sinhvien/index/<?php echo ($currentPage - 1) . $queryString; ?>" class="pagination-link">&laquo; Trước</a>
                    <?php else: ?>
                        <span class="pagination-link disabled">&laquo; Trước</span>
                    <?php endif; ?>

                    <!-- Các trang số -->
                    <?php 
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    if ($startPage > 1) {
                        echo '<a href="' . $baseUrl . '/sinhvien/index/1' . $queryString . '" class="pagination-link">1</a>';
                        if ($startPage > 2) {
                            echo '<span class="pagination-link disabled">...</span>';
                        }
                    }

                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $activeClass = ($i === $currentPage) ? ' active' : '';
                        echo '<a href="' . $baseUrl . '/sinhvien/index/' . $i . $queryString . '" class="pagination-link' . $activeClass . '">' . $i . '</a>';
                    }

                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) {
                            echo '<span class="pagination-link disabled">...</span>';
                        }
                        echo '<a href="' . $baseUrl . '/sinhvien/index/' . $totalPages . $queryString . '" class="pagination-link">' . $totalPages . '</a>';
                    }
                    ?>

                    <!-- Nút Sau -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?php echo $baseUrl; ?>/sinhvien/index/<?php echo ($currentPage + 1) . $queryString; ?>" class="pagination-link">Sau &raquo;</a>
                    <?php else: ?>
                        <span class="pagination-link disabled">Sau &raquo;</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
