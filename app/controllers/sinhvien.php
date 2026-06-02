<?php

class sinhvien extends Controller
{
    public $middlewares = ['AuthMiddleware'];

    public function index()
    {
        $sinhVienModel = $this->model('SinhVien');
        $students = $sinhVienModel->getAll();

        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'students' => $students
        ];

        $this->view('sinhvien/index', $data);
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
                $sinhVienModel = $this->model('SinhVien');
                // Check if masv already exists
                $db = (new DB())->getConnection();
                $stmt = $db->prepare("SELECT id FROM sinhvien WHERE masv = :masv");
                $stmt->execute(['masv' => $masv]);
                if ($stmt->fetch()) {
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

        $this->view('sinhvien/add', $data);
    }

    public function edit($id = null)
    {
        if (!$id) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/sinhvien');
            exit;
        }

        $sinhVienModel = $this->model('SinhVien');
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
                // Check if another student has the same masv
                $db = (new DB())->getConnection();
                $stmt = $db->prepare("SELECT id FROM sinhvien WHERE masv = :masv AND id != :id");
                $stmt->execute(['masv' => $masv, 'id' => $id]);
                if ($stmt->fetch()) {
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

        $this->view('sinhvien/edit', $data);
    }

    public function delete($id = null)
    {
        if ($id) {
            $sinhVienModel = $this->model('SinhVien');
            $sinhVienModel->delete($id);
        }
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseUrl . '/sinhvien');
        exit;
    }
}
