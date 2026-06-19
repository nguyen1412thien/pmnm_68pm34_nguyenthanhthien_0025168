<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
<div class="card">
    <div class="card-header">
        <h2>Danh sách Lớp học</h2>
        <a href="<?php echo $baseUrl; ?>/lophoc/add" class="btn btn-primary">
            + Thêm Lớp học
        </a>
    </div>

    <div class="table-responsive">
        <?php if (empty($data['classes'])): ?>
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p>Chưa có lớp học nào trong danh sách.</p>
                <a href="<?php echo $baseUrl; ?>/lophoc/add" class="btn btn-primary">+ Thêm lớp học đầu tiên</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã Lớp</th>
                        <th>Tên Lớp</th>
                        <th style="text-align: right;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['classes'] as $class): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($class['id']); ?></td>
                            <td style="font-weight: 600; color: var(--primary);"><?php echo htmlspecialchars($class['malop']); ?></td>
                            <td style="font-weight: 500;"><?php echo htmlspecialchars($class['tenlop']); ?></td>
                            <td style="text-align: right;">
                                <a href="<?php echo $baseUrl; ?>/lophoc/edit/<?php echo $class['id']; ?>" class="btn-action btn-edit" title="Sửa">
                                    ✏️
                                </a>
                                <a href="<?php echo $baseUrl; ?>/lophoc/delete/<?php echo $class['id']; ?>" class="btn-action btn-delete" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này? Tất cả sinh viên thuộc lớp sẽ được cập nhật.');">
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
            $totalClasses = $data['totalClasses'] ?? 0;
            $limit = $data['limit'] ?? 5;
            $offset = ($currentPage - 1) * $limit;
            ?>
            <div class="pagination-container">
                <div class="pagination-info">
                    Hiển thị từ <?php echo ($totalClasses > 0) ? ($offset + 1) : 0; ?> đến <?php echo min($offset + $limit, $totalClasses); ?> trong số <?php echo $totalClasses; ?> lớp học
                </div>
                <div class="pagination">
                    <!-- Nút Trước -->
                    <?php if ($currentPage > 1): ?>
                        <a href="<?php echo $baseUrl; ?>/lophoc/index/<?php echo $currentPage - 1; ?>" class="pagination-link">&laquo; Trước</a>
                    <?php else: ?>
                        <span class="pagination-link disabled">&laquo; Trước</span>
                    <?php endif; ?>

                    <!-- Các trang số -->
                    <?php 
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    if ($startPage > 1) {
                        echo '<a href="' . $baseUrl . '/lophoc/index/1" class="pagination-link">1</a>';
                        if ($startPage > 2) {
                            echo '<span class="pagination-link disabled">...</span>';
                        }
                    }

                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $activeClass = ($i === $currentPage) ? ' active' : '';
                        echo '<a href="' . $baseUrl . '/lophoc/index/' . $i . '" class="pagination-link' . $activeClass . '">' . $i . '</a>';
                    }

                    if ($endPage < $totalPages) {
                        if ($endPage < $totalPages - 1) {
                            echo '<span class="pagination-link disabled">...</span>';
                        }
                        echo '<a href="' . $baseUrl . '/lophoc/index/' . $totalPages . '" class="pagination-link">' . $totalPages . '</a>';
                    }
                    ?>

                    <!-- Nút Sau -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?php echo $baseUrl; ?>/lophoc/index/<?php echo $currentPage + 1; ?>" class="pagination-link">Sau &raquo;</a>
                    <?php else: ?>
                        <span class="pagination-link disabled">Sau &raquo;</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
