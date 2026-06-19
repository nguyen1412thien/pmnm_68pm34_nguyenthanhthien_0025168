<?php

class lophoc extends Controller
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

        $lophocModel = $this->model('LophocModel');
        $totalClasses = $lophocModel->countAll();
        $totalPages = (int)ceil($totalClasses / $limit);

        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages;
            $offset = ($page - 1) * $limit;
        }

        $classes = $lophocModel->getPaged($limit, $offset);

        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'classes' => $classes,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalClasses' => $totalClasses,
            'limit' => $limit
        ];

        $this->view('lophoc/index', $data, 'layoutmaster');
    }

    public function add()
    {
        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');

            // Validation
            if (empty($malop)) {
                $data['errors']['malop'] = 'Mã lớp không được để trống';
            }
            if (empty($tenlop)) {
                $data['errors']['tenlop'] = 'Tên lớp không được để trống';
            }

            if (empty($data['errors'])) {
                $lophocModel = $this->model('LophocModel');
                if ($lophocModel->existsMalop($malop)) {
                    $data['errors']['malop'] = 'Mã lớp này đã tồn tại';
                } else {
                    $success = $lophocModel->create([
                        'malop' => $malop,
                        'tenlop' => $tenlop
                    ]);

                    if ($success) {
                        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                        header('Location: ' . $baseUrl . '/lophoc');
                        exit;
                    } else {
                        $data['errors']['general'] = 'Có lỗi xảy ra khi tạo lớp học';
                    }
                }
            }
        }

        $this->view('lophoc/add', $data, 'layoutmaster');
    }

    public function edit($id = null)
    {
        if (!$id) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/lophoc');
            exit;
        }

        $lophocModel = $this->model('LophocModel');
        $class = $lophocModel->getById($id);

        if (!$class) {
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header('Location: ' . $baseUrl . '/lophoc');
            exit;
        }

        $data = [
            'username' => $_SESSION['username'] ?? 'User',
            'class' => $class,
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');

            // Validation
            if (empty($malop)) {
                $data['errors']['malop'] = 'Mã lớp không được để trống';
            }
            if (empty($tenlop)) {
                $data['errors']['tenlop'] = 'Tên lớp không được để trống';
            }

            if (empty($data['errors'])) {
                if ($lophocModel->existsMalopExcept($malop, $id)) {
                    $data['errors']['malop'] = 'Mã lớp này đã tồn tại ở lớp khác';
                } else {
                    $success = $lophocModel->update($id, [
                        'malop' => $malop,
                        'tenlop' => $tenlop
                    ]);

                    if ($success) {
                        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                        header('Location: ' . $baseUrl . '/lophoc');
                        exit;
                    } else {
                        $data['errors']['general'] = 'Có lỗi xảy ra khi cập nhật lớp học';
                    }
                }
            }
        }

        $this->view('lophoc/edit', $data, 'layoutmaster');
    }

    public function delete($id = null)
    {
        if ($id) {
            $lophocModel = $this->model('LophocModel');
            $lophocModel->delete($id);
        }
        $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header('Location: ' . $baseUrl . '/lophoc');
        exit;
    }
}
