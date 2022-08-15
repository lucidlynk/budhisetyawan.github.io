<?php

namespace App\Controllers;
use App\Models\PmksModel;

class Dashboard extends BaseController
{
    protected $db, $builder,$pmksModel;
    public function __construct()
    {
        helper('form');
        $this->pmksModel = new PmksModel();
        $this->db      = \Config\Database::connect();
    }
    public function index()
    {
        $data=[
            'apbd'=>$this->db->query("SELECT FORMAT( COUNT(noka), 0) as jml FROM apbd WHERE periode='AGUSTUS' AND tahun='2022'")->getRow(),
            'tampildata' => $this->pmksModel->getRekap(),
            'tittle' => 'Dashboard'

        ];
        // dd($data);
        return view('dashboard/index',$data);
    }
}
