<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $db, $builder,$pmksModel;
    public function __construct()
    {
        helper('form');
        $this->db      = \Config\Database::connect();
    }
    public function index()
    {
        $data=[
            'apbd'=>$this->db->query("SELECT COUNT(noka) FROM apbd WHERE periode='JULI' AND tahun='2022'")->getRow()

        ];
        dd($data);
        return view('dashboard/index',$data);
    }
}
