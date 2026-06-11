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

    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM sinhvien");
        $result = $stmt->fetch();
        return (int)($result['total'] ?? 0);
    }

    public function getPaged($limit, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM sinhvien ORDER BY id DESC LIMIT :limit OFFSET :offset");
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
        $stmt = $this->db->prepare("INSERT INTO sinhvien (masv, hoten, gioitinh, ngaysinh, lop, diemtb) VALUES (:masv, :hoten, :gioitinh, :ngaysinh, :lop, :diemtb)");
        return $stmt->execute([
            'masv' => $data['masv'],
            'hoten' => $data['hoten'],
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],
            'lop' => $data['lop'],
            'diemtb' => $data['diemtb']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE sinhvien SET masv = :masv, hoten = :hoten, gioitinh = :gioitinh, ngaysinh = :ngaysinh, lop = :lop, diemtb = :diemtb WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'masv' => $data['masv'],
            'hoten' => $data['hoten'],
            'gioitinh' => $data['gioitinh'],
            'ngaysinh' => $data['ngaysinh'],
            'lop' => $data['lop'],
            'diemtb' => $data['diemtb']
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM sinhvien WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
