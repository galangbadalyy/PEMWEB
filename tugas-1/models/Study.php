<?php
class Study
{
    private $koneksi;
    private string $table = 'studies';

    public function __construct()
    {
        global $dbh;
        $this->koneksi = $dbh;
        $this->ensureTable();
    }

    private function ensureTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(120) NOT NULL,
            institution VARCHAR(120) NOT NULL,
            year VARCHAR(9) NOT NULL,
            description TEXT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $this->koneksi->exec($sql);
    }

    public function index()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->koneksi->query($sql);
    }

    public function getStudy($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO {$this->table} (title, institution, year, description) VALUES (?,?,?,?)";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function ubah($data)
    {
        $sql = "UPDATE {$this->table} SET title=?, institution=?, year=?, description=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute([$id]);
    }
}

