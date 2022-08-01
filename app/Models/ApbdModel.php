<?php

namespace App\Models;

use CodeIgniter\Model;

class ApbdModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'apbd';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'noka',
        'nik',
        'nama','periode','tahun'
    ];

    // Dates
    protected $useTimestamps = true;
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

    public function getApbd($id=false)
    {
        if($id == false){
            return $this->findAll();
        }
        //data where periode= JULI and tahun= 2022 AND nik= '123456789'
        // $where = array(
        //     'periode' => 'JULI',
        //     'tahun' => '2022',
        //     'nik' => $id
        // );
        // return $this->asWhere($where)->findAll();
        return $this->where(['nik'=>$id,'periode'=>'JULI','tahun'=>'2022'])->first();
    }
}
