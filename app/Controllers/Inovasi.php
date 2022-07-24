<?php

namespace App\Controllers;
use App\Models\InovasiModel;
use Kint\Renderer\Renderer;

class Inovasi extends BaseController
{
    protected $db, $builder, $kepesertaan,$inovasiModel;
    public function __construct()
    {
        helper('form');
        $this->inovasiModel = new InovasiModel();
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('inovasi');
        // $this->kepesertaan = $this->db->table('kepesertaan');
    }
    public function index()
    {
        $data['tittle']= 'Puskesos CGT DInsos Hadir';
        $data['artikel']= 'Articles Dinsos Melawan Lupa';
        // $this->builder->select('judul,tgl,image,link,isi,team');
        
        // $query = $this->builder->get();
        // $data['tampildata']= $query->getResult();
        // $data['tampildata']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team FROM inovasi ORDER BY id ASC")->getResult();
        $data['tampildata']=$this->inovasiModel->where('team','kepahlawanan')->orderBy('tgl','DESC')->paginate(8);
        $data['pager'] = $this->inovasiModel->pager;
        $data['hot']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' AND youtube IS NOT NULL ORDER BY RAND() LIMIT 0, 3; ")->getResult();
        $data['popular']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' ORDER BY RAND() LIMIT 0, 1; ")->getResult();
        $data['cili']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' ORDER BY RAND() LIMIT 0, 5; ")->getResult();
        // change array to object
        // $data['headline']= $query->getRow();
        // $this->kepesertaan->select('*');
        // $query2 = $this->kepesertaan->get();
        // $data['kepesertaan']= $query2->getRow();
        // dd($data);
        return view('inovasi',$data);
    }

    public function dinsos_cgt()
    {
        $data['tittle']= 'Puskesos CGT DInsos Hadir';
        $data['artikel']= 'Articles Dinsos-CGT';
        // $this->builder->select('judul,tgl,image,link,isi,team');
        
        // $query = $this->builder->get();
        // $data['tampildata']= $query->getResult();
        // $data['tampildata']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team FROM inovasi ORDER BY id ASC")->getResult();
        // $data['tampildata']=$this->inovasiModel->orderBy('tgl','DESC')->paginate(8);
        //create function get all data inovasi from database where team is dinsos cgt with paginate
        // $data['tampildata']=$this->inovasiModel->where('team','dinsos cgt')->orderBy('tgl','DESC')->paginate(8);

        $data['tampildata']=$this->inovasiModel->where('team','dinsos_cgt')->orderBy('tgl','DESC')->paginate(8);
        $data['pager'] = $this->inovasiModel->pager;
        $data['hot']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' AND youtube IS NOT NULL ORDER BY RAND() LIMIT 0, 3; ")->getResult();
        $data['popular']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' ORDER BY RAND() LIMIT 0, 1; ")->getResult();
        $data['cili']= $this->db->query("SELECT DISTINCT(judul),tgl,image,link,isi,team,youtube FROM inovasi where team='kepahlawanan' ORDER BY RAND() LIMIT 0, 5; ")->getResult();
        // change array to object
        // $data['headline']= $query->getRow();
        // $this->kepesertaan->select('*');
        // $query2 = $this->kepesertaan->get();
        // $data['kepesertaan']= $query2->getRow();
        // dd($data);
        return view('inovasi',$data);
    }
}
