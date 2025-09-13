<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_logo extends Member_Controller {
    private $kode_menu = 'user-logo-login';
	private $kelompok = 'pengaturan';
	private $url = 'manager/pengaturan_logo';

    public function __construct(){
        parent::__construct();
        $this->load->model('Setting_model');
        // Pastikan entry menu & akses tersedia agar muncul di sidebar
        $this->_ensure_menu();
        parent::cek_akses($this->kode_menu); // optional: ensure menu permission
    }

    private function _ensure_menu(){
        // Cek apakah kode_menu sudah ada di user_menu
        if(!$this->db->where('kode_menu', $this->kode_menu)->get('user_menu')->num_rows()){
            // Taruh di bawah parent pengaturan yang sama dengan Pengaturan ZYACBT jika ada
            $parent = 'user-zyacbt'; // fallback top-level jika parent tidak ada
            $parent_exists = $this->db->where('kode_menu', $parent)->get('user_menu')->num_rows();
            if(!$parent_exists){
                // Jika parent tidak ada, jadikan top-level (parent kosong)
                $parent = '';
            }
            $this->db->insert('user_menu', [
                'kode_menu' => $this->kode_menu,
                'nama_menu' => 'Logo Login',
                'url'       => 'manager/pengaturan_logo',
                'icon'      => 'fa fa-image',
                'parent'    => $parent,
                'tipe'      => 1,
                'urutan'    => 995
            ]);
        }
        // Pastikan hak akses untuk level current user tersedia
        if(method_exists($this,'access')){ // jaga-jaga
            $level = $this->access->get_level();
        }else{
            $level = isset($this->access)? $this->access->get_level() : 'admin';
        }
        if(!$this->db->where('kode_menu',$this->kode_menu)->where('level',$level)->get('user_akses')->num_rows()){
            // Kolom add & edit berdasarkan pola di Users_model
            $this->db->insert('user_akses', [
                'kode_menu' => $this->kode_menu,
                'level'     => $level,
                'add'       => 1,
                'edit'      => 1
            ]);
        }
    }

    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        $data['current_logo'] = $this->Setting_model->get('login_logo', '');
        $this->template->display_admin($this->kelompok.'/pengaturan_logo_view', 'Pengaturan Logo Login', $data);
    }

    public function upload(){
        if(empty($_FILES['logo']['name'])){
            echo json_encode(['status'=>0,'pesan'=>'File belum dipilih']);
            return;        }
        $config['upload_path'] = FCPATH.'public/uploads/logo/';
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0755, true);
        }
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['max_size'] = 1024; // 1MB
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('logo')){
            echo json_encode(['status'=>0,'pesan'=>$this->upload->display_errors('','')]);
            return;        }
        $data = $this->upload->data();

        // Optional resize (keep under 400px width)
        if($data['image_width']>400){
            $this->load->library('image_lib');
            $conf_resize = [
                'image_library' => 'gd2',
                'source_image' => $data['full_path'],
                'maintain_ratio' => TRUE,
                'width' => 400
            ];
            $this->image_lib->initialize($conf_resize);
            @$this->image_lib->resize();
        }

        $relative = 'public/uploads/logo/'.$data['file_name'];
        $this->Setting_model->set('login_logo', $relative);
        echo json_encode(['status'=>1,'pesan'=>'Logo diperbarui','path'=>base_url($relative)]);
    }
}
