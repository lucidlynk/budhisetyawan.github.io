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
        $ap=$this->db->query("SELECT COUNT(noka) as jml FROM apbd WHERE periode='JULI' AND tahun='2022'")->getRow();
        $kis=number_format($ap, 0, '', '.');
        $data=[
            'apbd'=>$kis

        ];
        dd($data);
        return view('dashboard/index',$data);
    }
}
