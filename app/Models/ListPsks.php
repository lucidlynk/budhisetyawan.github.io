<?php

namespace App\Models;

use CodeIgniter\Model;

class ListPsks extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'psks';
    protected $primaryKey       = 'id_psks';
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

    public function getPsks($id=false)
    {
        if($id == false){
            return $this->findAll();
        }
        return $this->where(['id_psks'=>$id])->first();
    }

    public function getPsksByRekap()
    {
        $this->db      = \Config\Database::connect();
        $this->db->query('SET SESSION sql_mode = "TRADITIONAL"');
        $q = $this->db->query("SELECT DISTINCT(nama_psks),COUNT(nama)AS jumlah,(SELECT COUNT(jk) FROM tb_psks WHERE tb_psks.id_pks=psks.id_psks AND tb_psks.jk='1') AS Pria, (SELECT COUNT(jk) FROM tb_psks WHERE tb_psks.id_pks=psks.id_psks AND tb_psks.jk='2') AS Wanita FROM psks LEFT JOIN tb_psks ON tb_psks.id_pks=psks.id_psks GROUP BY nama_psks ORDER BY nama_psks ASC;");
        $rekap = $q->getResultArray();
        return $rekap;
    }

    public function getDownload()
    {
        $this->db      = \Config\Database::connect();
        $q = $this->db->query("SELECT * FROM tb_psks INNER JOIN psks ON psks.id_psks=tb_psks.id_pks;");
        $dl = $q->getResultArray();
        return $dl;
    }

    public function getTotal()
    {
        $this->db      = \Config\Database::connect();
        $qt = $this->db->query("SELECT COUNT(nik) as total FROM tb_psks");
        $total = $qt->getRow();
        return $total;
    }

    public function getPria()
    {
        $this->db      = \Config\Database::connect();
        $qp = $this->db->query("SELECT COUNT(nik) as pria FROM tb_psks where jk='1'");
        $pria = $qp->getRow();
        return $pria;
    }

    public function getWanita()
    {
        $this->db      = \Config\Database::connect();
        $qw = $this->db->query("SELECT COUNT(nik) as wanita FROM tb_psks where jk='2'");
        $wanita = $qw->getRow();
        return $wanita;
    }
}
