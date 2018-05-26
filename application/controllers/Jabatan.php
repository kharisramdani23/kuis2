<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model');
    }

    public function index()
    {
        $jabatan = $this->Jabatan_model->list();

        $data = [
                    'title' => 'Pemrograman Web Framework :: Data Jabatan',
                    'jabatan' => $jabatan,
                ];
        $this->load->view('jabatan/index', $data);
    }

    public function create()
    {
        $error = array('error' => ' ' );
        $this->load->view('jabatan/create', $error);
    }

    public function store()
    {
        // Ambil value 
        $jabatan = $this->input->post('jabatan');

        // Validasi Nama dan Jabatan
        $dataval = $jabatan;
        $errorval = $this->validate($dataval);

        // Pesan Error atau Upload
        if ($errorval==false)
        {
            
            // Insert data
            $data = [
                'gelar' => $jabatan,
                ];
            $result = $this->Jabatan_model->insert($data);
            
            if ($result)
            {
                redirect(jabatan);
            }
            else
            {
                $error = array('error' => 'Gagal');
                $this->load->view('jabatan/create', $error);
            }
        }
        else
        {
            $error = ['error' => validation_errors()];
            $this->load->view('jabatan/create', $error);
        }
    }

    public function edit($kode,$error='')
    {
      // TODO: tampilkan view edit data
        $jabatan = $this->Jabatan_model->show($kode);
        $data = [
            'data' => $jabatan,
            'error' => $error
        ];
        $this->load->view('jabatan/edit', $data);
      
    }

    public function update($id)
    {
        //Ambil Value
        $kode=$this->input->post('kode');
        $jabatan = $this->input->post('jabatan');

        // Validasi Nama dan Jabatan
        $dataval = $jabatan;
        $errorval = $this->validate($dataval);

        if ($errorval==false)
        {
            $data = [ 'gelar' => $this->input->post('jabatan') ];
            $result = $this->Jabatan_model->update($kode,$data);

            if ($result)
            {
                redirect('jabatan');
            }
            else
            {
                $data = array('error' => 'Gagal');
                $this->load->view('jabatan/edit', $data);
            }
        }
        else
        {
            $error = validation_errors();
            $this->edit($kode,$error=' ');
        }

        
    }

    public function destroy($kode)
    {
        $jabatan = $this->Jabatan_model->show($kode);
        $data = [ 'data' => $jabatan ];
        $this->Jabatan_model->delete($kode);
        redirect('jabatan');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Jabatan
        $this->form_validation->set_rules('jabatan','Jabatan','trim|required|callback_alpha_space');

        if (! $this->form_validation->run())
        { return true; }
        else
        { return false; }
    } 

    public function alpha_space($str)
    {
        return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
    }
}