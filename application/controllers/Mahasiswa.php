<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Mahasiswa_model');

        // Konfigurasi Upload
        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 999999999;
        $config['max_width']            = 2560;
        $config['max_height']           = 1600;

        $this->load->library('upload', $config);
    }

    public function index()
    {
        $mahasiswa = $this->Mahasiswa_model->list();

        $data = [
                    'title' => 'Blog Sparadox :: Data Mahasiswa',
                    'mahasiswa' => $mahasiswa,
                ];

        
        $this->load->view('mahasiswa/index', $data);
    }

    public function create($error='')
    {
        $kelas = $this->Kelas_model->list();
        $data = [
            'error' => $error,
            'data' => $kelas
        ];
        $this->load->view('mahasiswa/create', $data);
    }

    public function show($id)
    {
        $mahasiswa = $this->Mahasiswa_model->show($id);
        $data = [
            'data' => $mahasiswa
        ];
        $this->load->view('mahasiswa/show', $data);
    }
    
    public function store()
    {
        // Ambil value 
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');

        // Validasi Nama dan Jabatan
        $dataval = $nama;
        $errorval = $this->validate($dataval);

        // Pesan Error atau Upload
        if ($errorval==false)
        {
            // Percobaan Upload
            if ( ! $this->upload->do_upload('foto'))
            {
                $error = $this->upload->display_errors();
                $this->create($error);
            }
            else
            {
                // Insert data
                $data = [
                    'nama' => $nama,
                    'kode' => $kelas,
                    'foto' => $this->upload->data('file_name')
                    ];
                $result = $this->Mahasiswa_model->insert($data);
                
                if ($result)
                {
                    redirect(pegawai);
                }
                else
                {
                    $error = array('error' => 'Gagal');
                    $this->load->view('mahasiswa/create', $error);
                }
            }
        }
        else
        {
            $error = validation_errors();
            $this->create($error);
        }
    }

    public function edit($id,$error='')
    {
      // TODO: tampilkan view edit data
        $mahasiswa = $this->Mahasiswa_model->show($id);
        $kelas = $this->Kelas_model->list();
        $data = [
            'data' => $mahasiswa,
            'datajab' => $kelas,
            'error' => $error
        ];
        $this->load->view('kelas/edit', $data);
      
    }

    public function update($id)
    {
        //Ambil Value
        $id=$this->input->post('id');
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');

        // Validasi Nama dan Jabatan
        $dataval = [
            'nama' => $nama,
            'kelas' => $kelas
            ];
        $errorval = $this->validate($dataval);

        if ($errorval==false)
        {
            if ( ! $this->upload->do_upload('foto'))
            {
                $data = [
                    'nama' => $nama,
                    'kode' => $kelas
                    ];
                $result = $this->Mahasiswa_model->update($id,$data);

                if ($result)
                {
                    redirect('mahasiswa');
                }
                else
                {
                    $data = array('error' => 'Gagal');
                    $this->load->view('mahasiswa/edit', $data);
                }
            }
            else
            {
                $data = [
                    'nama' => $nama,
                    'kode' => $kelas,
                    'foto' => $this->upload->data('file_name')
                    ];
                $result = $this->Mahasiswa_model->update($id,$data);
                
                if ($result)
                {
                    redirect('mahasiswa');
                }
                else
                {
                    $data = array('error' => 'Gagal');
                    $this->load->view('mahasiswa/edit', $data);
                }
            }
        }
        else
        {
            $error = validation_errors();
            $this->edit($id,$error);
        }

        
    }

    public function destroy($id)
    {
        $mahasiswa = $this->Mahasiswa_model->show($id);

        delete_files(FCPATH.'assets/uploads/'.$mahasiswa->foto);
        
        $this->Mahasiswa_model->delete($id);

        redirect('mahasiswa');
    }

    public function validate($dataval)
    {
        // Validasi Nama dan Jabatan
        $rules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|callback_alpha_space'
            ]
          ];

        $this->form_validation->set_rules($rules);

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

/* End of file Controllername.php */
