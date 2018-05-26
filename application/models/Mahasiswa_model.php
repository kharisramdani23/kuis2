<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function list()
    {
        $query = $this->db->get('mahasiswa');
        return $query->result();
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('mahasiswa', $data);
        return $result;
    }

    public function show($id)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa'); 
        $this->db->join('kelas', 'mahasiswa.kode=kelas.kode');
        $this->db->where('id',$id);     
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data = [])
    {
        // TODO: set data yang akan di update
        // https://www.codeigniter.com/userguide3/database/query_builder.html#updating-data

        $this->db->where('id', $id);
        $this->db->update('mahasiswa', $data);
        return result;
    }
    
    public function delete($id)
    {
        // TODO: tambahkan logic penghapusan data
        $this->db->where('id', $id);

        $this->db->delete('mahasiswa');
    }
}

/* End of file ModelName.php */