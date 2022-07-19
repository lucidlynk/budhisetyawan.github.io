<?php

namespace App\Controllers;

use App\Models\ApbdModel;
use App\Models\UsulkisModel;
use App\Models\PrioritasModel;

class Peserta extends BaseController
{
    protected $apbdModel,$db, $builder;
    public function __construct()
    {
        helper('form');
        $this->apbdModel= new ApbdModel();
        $this->usulkisModel= new UsulkisModel();
        $this->prioritasModel= new PrioritasModel();
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('disabilitas');
    }

    public function disabilitas()
    {
        $data=[
            'tittle' => 'Disabiltas',
            'func' => 'search'
        ];
        return view('program/disabilitas',$data);
    }

    public function search()
    {
        $id= $this->request->getVar('nama');
        
        $data=[
            'tittle' => 'Disabilitas'
        ];
        $q = $this->db->query("SELECT * FROM disabilitas where nik={$id};");
        $data['tampil'] = $q->getResultArray();
        // dd($data);
        return view('program/hasil',$data);
    }

    public function dtks()
    {
        $data=[
            'tittle' => 'DTKS',
            'func' => 'dtkssearch'
        ];
        return view('program/dtks',$data);
    }

    public function dtkssearch()
    {
        $id= $this->request->getVar('nama');
        
        $data=[
            'tittle' => 'DTKS'
        ];
        // $q = $this->db->query("SELECT * FROM dtks where nik={$id};");
        $q = $this->db->query("SELECT dtks.nik AS dnik,dtks.id_dtks AS ddtks, dtks.nama AS dnama,pkh.nama AS pnama,tahap AS ptahap,dtks.kecamatan AS dkec,dtks.desa AS ddesa FROM dtks LEFT JOIN pkh ON dtks.nik=pkh.nik where dtks.nik={$id};");
        $data['tampil'] = $q->getResultArray();
        // dd($data);
        return view('program/hasildtks',$data);
    }

    public function usul()
    {
        $data=[
            'tittle' => 'Usulan KIS',
            'tampildata' => '',
            'validation'=> \Config\Services::validation() 
        ];
        return view('kis/DataUsulan',$data);
    }

    public function cek_usul()
    {
        $tgl_awal=$this->request->getVar('tanggal_awal');
        $tgl_akhir = $this->request->getVar('tanggal_akhir');
        $data=[
            'tittle' => 'Usulan KIS',
            // 'tampildata' => $this->usulkisModel->findAll()
        ];
        
        if ($tgl_awal AND $tgl_akhir) {
            
        
        if (user()->id==8) {
            //fungsi untuk deleteall berdasarkan lampiran berkas
            $q = $this->db->query("SELECT DISTINCT berkas,usul_kis.created_at AS pengajuan, COUNT(id_usul) AS jml, username FROM usul_kis INNER JOIN users ON usul_kis.userid=users.id GROUP BY berkas ORDER BY usul_kis.created_at DESC  LIMIT 0, 10;");
            $data['tampilhapus'] = $q->getResultArray();
            //tampilan datatable
            $this->builder->select('id_usul,usul_kis.userid as uid,username,noka,kk,nik,nama,pisat,tmp_lahir,tgl_lahir,jk,usul_kis.status as stts,alamat,kd_pos,kecamatan,desa,ket,file,berkas,usulid');
            $this->builder->join('users', 'usul_kis.userid = users.id');
            $this->builder->join('prioritas', 'usul_kis.id_usul = prioritas.usulid', 'left');
            $this->builder->where('usul_kis.created_at >=',$tgl_awal);
            $this->builder->where('usul_kis.created_at <=',$tgl_akhir);
        }else{
            //fungsi untuk deleteall berdasarkan lampiran berkas
            $idk=user()->id;
            $q = $this->db->query("SELECT DISTINCT berkas,usul_kis.created_at AS pengajuan, COUNT(id_usul) AS jml FROM usul_kis INNER JOIN users ON usul_kis.userid=users.id WHERE users.id={$idk} GROUP BY berkas ORDER BY usul_kis.created_at DESC LIMIT 0, 10;");
            $data['tampilhapus'] = $q->getResultArray();
            //tampilan datatable
            $this->builder->select('id_usul,usul_kis.userid as uid,username,noka,kk,nik,nama,pisat,tmp_lahir,tgl_lahir,jk,usul_kis.status as stts,alamat,kd_pos,kecamatan,desa,ket,file,berkas,usulid');
            $this->builder->join('users', 'usul_kis.userid = users.id');
            $this->builder->join('prioritas', 'usul_kis.id_usul = prioritas.usulid', 'left');
            $this->builder->where('usul_kis.created_at >=',$tgl_awal);
            $this->builder->where('usul_kis.created_at <=',$tgl_akhir);
            $this->builder->where('usul_kis.userid',user()->id);
        }
        $query = $this->builder->get();
        $data['tampildata']= $query->getResult();
        }else {
            $data['tampildata']= '';
        }
        return view('kis/DataUsulan',$data);
    }
    public function update() {
        // $id= $this->request->getPost('tgl_lahir');
        // dd($id);
        $this->usulkisModel->save([
            'id_usul' => $this->request->getPost('id'),
            'noka' => $this->request->getPost('noka'),
            'kk' => $this->request->getPost('kk'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'tmp_lahir' => $this->request->getPost('tmp_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        ]); 
        session()->setFlashdata('pesan','Data berhasil diubah');
        return redirect()->to('/kis/usul');
    }

    public function delete($id)
    {
        $this->builder->delete(['id_usul' => $id]);
        session()->setFlashdata('pesan','Data berhasil dihapus');
        return redirect()->to('/kis/usul');
    }

    public function deleteall(){
        // if(is_array($id)){
        //     $this->db->where_in('id', $id);
        // }else{
        //     $this->db->where('id', $id);
        // }
        // $delete = $this->db->delete($this->tblName);
        // return $delete?true:false;
        $chk= $this->request->getPost('hapus');
        //dd($chk);
        if($chk != "Open this select menu"){
        unlink('file/'.$chk);
        $this->builder->delete(['berkas' => $chk]);
        session()->setFlashdata('pesan',' Data berhasil dihapus');
        }else{
            session()->setFlashdata('error',' Data yang di hapus tidak ada');
        }
        return redirect()->to('/kis/usul');
    }

    public function vip(){
        if (!$this->validate([
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,application/pdf]',
                'errors' => [
                    'uploaded' => 'Lampiran File Upload Masih Kosong',
                    'max_size' => 'Ukuran Lampiran File terlalu besar',
                    'mime_in' => 'Lampiran yang ada pilih bukan pdf'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

            //pdf
            $filebaru= $this->request->getFile('file');
         
            //generate nama file random
            $namaFile= $filebaru->getRandomName();
            //upload gamabar
            $filebaru->move('file',$namaFile);
            
            
        
            $data = [
                'jenis' => $this->request->getPost('jenis'),
                'ket' => $this->request->getPost('ket'),
                'file' => $namaFile,
                'usulid' => $this->request->getPost('id')
            ];
            
            $this->prioritasModel->save($data);
            
            
        
        session()->setFlashdata('pesan',' Data berhasil ditambahkan ke usulan Prioritas');
        return redirect()->to('kis/usul');
    }

    public function batal($id)
    {
        
        $file=$this->prioritasModel->getPrioritas($id);
        $this->prioritasModel->delete(['id' => $file['id']]);
        unlink('file/'.$file['file']);
        session()->setFlashdata('pesan','Permohonan Prioritas usulan dibatalkan');
        return redirect()->to('/kis/usul');
    }

    
}
