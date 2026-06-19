<?php

class SinhVienModel
{
    private $db;

    public function __construct()
    {
        $database = new DB();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM sinhvien ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function countAll($search = [])
    {
        $sql = "SELECT COUNT(*) as total FROM sinhvien WHERE 1=1";
        $params = [];

        if (!empty($search['keyword'])) {
            $sql .= " AND (masv LIKE :keyword_masv OR hoten LIKE :keyword_hoten)";
            $params['keyword_masv'] = '%' . $search['keyword'] . '%';
            $params['keyword_hoten'] = '%' . $search['keyword'] . '%';
        }

        if (!empty($search['lop_filter'])) {
            $sql .= " AND (lop = :lop_filter OR malop = :malop_filter)";
            $params['lop_filter'] = $search['lop_filter'];
            $params['malop_filter'] = $search['lop_filter'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return (int)($result['total'] ?? 0);
    }

    public function existsMasv($masv)
    {
        $stmt = $this->db->prepare("SELECT id FROM sinhvien WHERE masv = :masv");
        $stmt->execute(['masv' => $masv]);
        return (bool)$stmt->fetch();
    }

    public function existsMasvExcept($masv, $id)
    {
        $stmt = $this->db->prepare("SELECT id FROM sinhvien WHERE masv = :masv AND id != :id");
        $stmt->execute(['masv' => $masv, 'id' => $id]);
        return (bool)$stmt->fetch();
    }

    public function getPaged($limit, $offset, $search = [])
    {
        $sql = "SELECT * FROM sinhvien WHERE 1=1";
        $params = [];

        if (!empty($search['keyword'])) {
            $sql .= " AND (masv LIKE :keyword_masv OR hoten LIKE :keyword_hoten)";
            $params['keyword_masv'] = '%' . $search['keyword'] . '%';
            $params['keyword_hoten'] = '%' . $search['keyword'] . '%';
        }

        if (!empty($search['lop_filter'])) {
            $sql .= " AND (lop = :lop_filter OR malop = :malop_filter)";
            $params['lop_filter'] = $search['lop_filter'];
            $params['malop_filter'] = $search['lop_filter'];
        }

        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM sinhvien WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO sinhvien (masv, hoten, gioitinh, ngaysinh, lop, malop, diemtb) VALUES (:masv, :hoten, :gioitinh, :ngaysinh, :lop, :malop, :diemtb)");
        return $stmt->execute([
            'masv' => $data['masv'],
            'hoten' => $data['hoten'],
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],
            'lop' => $data['lop'],
            'malop' => $data['malop'],
            'diemtb' => $data['diemtb']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE sinhvien SET masv = :masv, hoten = :hoten, gioitinh = :gioitinh, ngaysinh = :ngaysinh, lop = :lop, malop = :malop, diemtb = :diemtb WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'masv' => $data['masv'],
            'hoten' => $data['hoten'],
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],
            'lop' => $data['lop'],
            'malop' => $data['malop'],
            'diemtb' => $data['diemtb']
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM sinhvien WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
