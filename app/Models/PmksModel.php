<?php

namespace App\Models;

use CodeIgniter\Model;

class PmksModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pmks';
    protected $primaryKey       = 'id_pmks';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPmks($id=false)
    {
        if($id == false){
            return $this->findAll();
        }
        return $this->where(['id_pmks'=>$id])->first();
    }

    public function getPmksByRekap()
    {
        $this->db      = \Config\Database::connect();
        $this->db->query('SET SESSION sql_mode = "TRADITIONAL"');
        $q = $this->db->query("SELECT DISTINCT(nama_pmks),COUNT(nama)AS jumlah,(SELECT COUNT(jk) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks AND ppks.jk='1') AS Pria, (SELECT COUNT(jk) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks AND ppks.jk='2') AS Wanita FROM pmks LEFT JOIN ppks ON ppks.id_pmks=pmks.id_pmks GROUP BY nama_pmks ORDER BY nama_pmks ASC;");
        // $q = $this->db->query("SELECT DISTINCT(nama_pmks),(SELECT COUNT(nama) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks) AS jumlah, (SELECT COUNT(jk) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks AND ppks.jk='1') AS Pria, (SELECT COUNT(jk) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks AND ppks.jk='2') AS Wanita FROM pmks LEFT JOIN ppks ON ppks.id_pmks=pmks.id_pmks;");
        $rekap = $q->getResultArray();
        return $rekap;
    }

    public function getDownload()
    {
        $this->db      = \Config\Database::connect();
        $q = $this->db->query("SELECT * FROM ppks INNER JOIN pmks ON pmks.id_pmks=ppks.id_pmks;");
        $dl = $q->getResultArray();
        return $dl;
    }

    public function getTotal()
    {
        $this->db      = \Config\Database::connect();
        $qt = $this->db->query("SELECT COUNT(nik) as total FROM ppks");
        $total = $qt->getRow();
        return $total;
    }

    public function getPria()
    {
        $this->db      = \Config\Database::connect();
        $qp = $this->db->query("SELECT COUNT(nik) as pria FROM ppks where jk='1'");
        $pria = $qp->getRow();
        return $pria;
    }

    public function getWanita()
    {
        $this->db      = \Config\Database::connect();
        $qw = $this->db->query("SELECT COUNT(nik) as wanita FROM ppks where jk='2'");
        $wanita = $qw->getRow();
        return $wanita;
    }

    public function getRekap()
    {
        $this->db      = \Config\Database::connect();
        $this->db->query('SET SESSION sql_mode = "TRADITIONAL"');
        $q = $this->db->query("SELECT DISTINCT(nama_pmks),COUNT(nama)AS jumlah FROM pmks LEFT JOIN ppks ON ppks.id_pmks=pmks.id_pmks GROUP BY nama_pmks ORDER BY jumlah ASC;");
        // $q = $this->db->query("SELECT DISTINCT(nama_pmks),(SELECT COUNT(nama) FROM ppks WHERE ppks.id_pmks=pmks.id_pmks) AS jumlah FROM pmks LEFT JOIN ppks ON ppks.id_pmks=pmks.id_pmks ORDER BY jumlah DESC;");
        $rekap = $q->getResultArray();
        return $rekap;
    }
}
