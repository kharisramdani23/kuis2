<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jabatan_model');
        $this->load->model('Pegawai_model');

        // Konfigurasi Upload
        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 999999;
        $config['max_width']            = 2560;
        $config['max_height']           = 1600;

    
        $this->load->library('upload', $config);
    }

    public function index()
    {
        $pegawai = $this->Pegawai_model->list();
                $this->load->database();
    $jumlah_data = $this->Pegawai_model->jumlah_data();
    $this->load->library('pagination');
    $config['base_url'] = base_url().'index.php/pegawai/index/';
    $config['total_rows'] = $jumlah_data;
     $config['per_page'] = "3";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // get books list
        $data['pegawai'] = $this->Pegawai_model->get_books($config["per_page"], $data['page'], NULL);
        
        $data['pagination'] = $this->pagination->create_links();
        
   // $data = [
    //    'title' => 'Blog Sparadox :: Data Pegawai',
   //     'pegawai' => $this->Pegawai_model->data($config['per_page'], $from)
 //   ];
        $this->load->view('pegawai/index', $data);
    }
    
public function search(){
  // get search string
        $search = ($this->input->post("nama"))? $this->input->post("nama") : "NIL";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url("pagination/pegawai/$search");
        $config['total_rows'] = $this->Pegawai_model->get_books_count($search);
        $config['per_page'] = "5";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get books list
        $data['pegawai'] = $this->Pegawai_model->get_books($config['page_items'], $data['page'], $search);

        $data['pagination'] = $this->pagination->create_links();

        //load view
        $this->load->view('pegawai',$data);
}

    public function create($error='')
    {
        $jabatan = $this->Jabatan_model->list();
        $data = [
            'error' => $error,
            'data' => $jabatan
        ];
        $this->load->view('pegawai/create', $data);
    }

    public function show($id)
    {
        $pegawai = $this->Pegawai_model->show($id);
        $data = [
            'data' => $pegawai
        ];
        $this->load->view('pegawai/show', $data);
    }
    
    public function store()
    {
        // Ambil value 
        $nama = $this->input->post('nama');
        $nim = $this->input->post('nim');
        $jurusan = $this->input->post('jurusan');
        $jabatan = $this->input->post('jabatan');

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
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'kode' => $jabatan,
                    'foto' => $this->upload->data('file_name')
                    ];
                $result = $this->Pegawai_model->insert($data);
                
                if ($result)
                {
                    redirect(pegawai);
                }
                else
                {
                    $error = array('error' => 'Gagal');
                    $this->load->view('pegawai/create', $error);
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
        $pegawai = $this->Pegawai_model->show($id);
        $jabatan = $this->Jabatan_model->list();
        $data = [
            'data' => $pegawai,
            'datajab' => $jabatan,
            'error' => $error
        ];
        $this->load->view('pegawai/edit', $data);
      
    }

    public function update($id)
    {
        //Ambil Value
        $id=$this->input->post('id');
        $nama = $this->input->post('nama');
        $nim = $this->input->post('nim');
        $jurusan = $this->input->post('jurusan');
        $jabatan = $this->input->post('jabatan');

        // Validasi Nama dan Jabatan
        $dataval = [
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'jabatan' => $jabatan
            ];
        $errorval = $this->validate($dataval);

        if ($errorval==false)
        {
            if ( ! $this->upload->do_upload('foto'))
            {
                $data = [
                    'nama' => $nama,
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'kode' => $jabatan
                    ];
                $result = $this->Pegawai_model->update($id,$data);

                if ($result)
                {
                    redirect('pegawai');
                }
                else
                {
                    $data = array('error' => 'Gagal');
                    $this->load->view('pegawai/edit', $data);
                }
            }
            else
            {
                $data = [
                    'nama' => $nama,
                    'nim' => $nim,
                    'jurusan' => $jurusan,
                    'kode' => $jabatan,
                    'foto' => $this->upload->data('file_name')
                    ];
                $result = $this->Pegawai_model->update($id,$data);
                
                if ($result)
                {
                    redirect('pegawai');
                }
                else
                {
                    $data = array('error' => 'Gagal');
                    $this->load->view('pegawai/edit', $data);
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
        $pegawai = $this->Pegawai_model->show($id);

        delete_files(FCPATH.'assets/uploads/'.$pegawai->foto);
        
        $this->Pegawai_model->delete($id);

        redirect('pegawai');
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
