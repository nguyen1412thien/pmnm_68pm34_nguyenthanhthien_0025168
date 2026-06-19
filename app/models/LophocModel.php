<?php

class LophocModel
{
    private $db;

    public function __construct()
    {
        $database = new DB();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM lophoc ORDER BY malop ASC");
        return $stmt->fetchAll();
    }

    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM lophoc");
        $result = $stmt->fetch();
        return (int)($result['total'] ?? 0);
    }

    public function existsMalop($malop)
    {
        $stmt = $this->db->prepare("SELECT id FROM lophoc WHERE malop = :malop");
        $stmt->execute(['malop' => $malop]);
        return (bool)$stmt->fetch();
    }

    public function existsMalopExcept($malop, $id)
    {
        $stmt = $this->db->prepare("SELECT id FROM lophoc WHERE malop = :malop AND id != :id");
        $stmt->execute(['malop' => $malop, 'id' => $id]);
        return (bool)$stmt->fetch();
    }

    public function getPaged($limit, $offset)
    {
        $stmt = $this->db->prepare("SELECT * FROM lophoc ORDER BY malop ASC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM lophoc WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO lophoc (malop, tenlop) VALUES (:malop, :tenlop)");
        return $stmt->execute([
            'malop' => $data['malop'],
            'tenlop' => $data['tenlop']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE lophoc SET malop = :malop, tenlop = :tenlop WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'malop' => $data['malop'],
            'tenlop' => $data['tenlop']
        ]);
    }

    public function delete($id)
    {
        // First check if there's any student referencing this malop
        // We can just set their malop to null or keep them
        // Let's delete the class directly or set referencing students' malop to null
        $class = $this->getById($id);
        if ($class) {
            $stmtUpdate = $this->db->prepare("UPDATE sinhvien SET malop = NULL WHERE malop = :malop");
            $stmtUpdate->execute(['malop' => $class['malop']]);
            
            $stmt = $this->db->prepare("DELETE FROM lophoc WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        }
        return false;
    }
}
