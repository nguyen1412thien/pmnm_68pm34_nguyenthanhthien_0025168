<?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>
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
