<?php

class sinhvien extends Controller
{
    public $middlewares = ['AuthMiddleware'];

    public function index($page = 1)
    {
        $page = (int)$page;
        if ($page < 1) {
            $page = 1;
        }

        $limit = 5;
        $offset = ($page - 1) * $limit;

        $sinhVienModel = $this->model('SinhVienModel');
        $totalStudents = $sinhVienModel->countAll();
        $totalPages = (int)ceil($totalStudents / $limit);

        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
            $offset = ($page - 1) * $limit;
        }

        $students = $sinhVienModel->getPaged($limit, $offset);

        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'students' => $students,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalStudents' => $totalStudents,
            'limit' => $limit
        ];

        $this->view('sinhvien/index', $data, 'layoutmaster');
    }

    public function add()
    {
        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = trim($_POST['masv'] ?? '');
            $hoten = trim($_POST['hoten'] ?? '');
            $gioitinh = trim($_POST['gioitinh'] ?? '');
            $ngaysinh = trim($_POST['ngaysinh'] ?? '');
            $lop = trim($_POST['lop'] ?? '');
            $diemtb = trim($_POST['diemtb'] ?? '');

            // Validation
            if (empty($masv)) {
                $data['errors']['masv'] = 'Mã sinh viên không được để trống';
            }
            if (empty($hoten)) {
                $data['errors']['hoten'] = 'Họ tên không được để trống';
            }

            if (empty($data['errors'])) {
                $sinhVienModel = $this->model('SinhVienModel');
                if ($sinhVienModel->existsMasv($masv)) {
                    $data['errors']['masv'] = 'Mã sinh viên này đã tồn tại';
                } else {
                    $success = $sinhVienModel->create([
                        'masv' => $masv,
                        'hoten' => $hoten,
                        'gioitinh' => $gioitinh ?: null,
                        'ngaysinh' => $ngaysinh ?: null,
                        'lop' => $lop ?: null,
                        'diemtb' => $diemtb !== '' ? (float)$diemtb : null
                    ]);

                    if ($success) {
                        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                        header('Location: ' . $baseUrl . '/sinhvien');
                        exit;
                    } else {
                        $data['errors']['general'] = 'Có lỗi xảy ra khi tạo sinh viên';
                    }
                }
            }
        }

        $this->view('sinhvien/add', $data, 'layoutmaster');
    }

    public function edit($id = null)
    {
        if (!$id) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/sinhvien');
            exit;
        }

        $sinhVienModel = $this->model('SinhVienModel');
        $student = $sinhVienModel->getById($id);

        if (!$student) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/sinhvien');
            exit;
        }

        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'student' => $student,
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masv = trim($_POST['masv'] ?? '');
            $hoten = trim($_POST['hoten'] ?? '');
            $gioitinh = trim($_POST['gioitinh'] ?? '');
            $ngaysinh = trim($_POST['ngaysinh'] ?? '');
            $lop = trim($_POST['lop'] ?? '');
            $diemtb = trim($_POST['diemtb'] ?? '');

            // Validation
            if (empty($masv)) {
                $data['errors']['masv'] = 'Mã sinh viên không được để trống';
            }
            if (empty($hoten)) {
                $data['errors']['hoten'] = 'Họ tên không được để trống';
            }

            if (empty($data['errors'])) {
                if ($sinhVienModel->existsMasvExcept($masv, $id)) {
                    $data['errors']['masv'] = 'Mã sinh viên này đã tồn tại ở sinh viên khác';
                } else {
                    $success = $sinhVienModel->update($id, [
                        'masv' => $masv,
                        'hoten' => $hoten,
                        'gioitinh' => $gioitinh ?: null,
                        'ngaysinh' => $ngaysinh ?: null,
                        'lop' => $lop ?: null,
                        'diemtb' => $diemtb !== '' ? (float)$diemtb : null
                    ]);

                    if ($success) {
                        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                        header('Location: ' . $baseUrl . '/sinhvien');
                        exit;
                    } else {
                        $data['errors']['general'] = 'Có lỗi xảy ra khi cập nhật sinh viên';
                    }
                }
            }
        }

        $this->view('sinhvien/edit', $data, 'layoutmaster');
    }

    public function delete($id = null)
    {
        if ($id) {
            $sinhVienModel = $this->model('SinhVienModel');
            $sinhVienModel->delete($id);
        }
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseUrl . '/sinhvien');
        exit;
    }
}
