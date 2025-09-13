<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_zyacbt extends Member_Controller {
	private $kode_menu = 'user-zyacbt';
	private $kelompok = 'pengaturan';
	private $url = 'manager/pengaturan_zyacbt';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('Setting_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
		$data['current_logo'] = $this->Setting_model->get('login_logo','');
        
        $this->template->display_admin($this->kelompok.'/pengaturan_zyacbt_view', 'Pengaturan Konfigurasi', $data);
    }

	public function upload_logo(){
		if(empty($_FILES['logo']['name'])){
			echo json_encode(['status'=>0,'pesan'=>'File belum dipilih']);
			return; }
		$config['upload_path'] = FCPATH.'public/uploads/logo/';
		if(!is_dir($config['upload_path'])){ mkdir($config['upload_path'],0755,true); }
		$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
		$config['max_size'] = 1024; // KB
		$config['file_ext_tolower'] = TRUE;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('logo')){
			echo json_encode(['status'=>0,'pesan'=>$this->upload->display_errors('','')]);
			return; }
		$data = $this->upload->data();
		if(isset($data['image_width']) && $data['image_width']>400){
			$this->load->library('image_lib');
			$conf_resize = [ 'image_library'=>'gd2','source_image'=>$data['full_path'],'maintain_ratio'=>TRUE,'width'=>400 ];
			$this->image_lib->initialize($conf_resize); @ $this->image_lib->resize();
		}
		$relative = 'public/uploads/logo/'.$data['file_name'];
		$this->Setting_model->set('login_logo',$relative);
		echo json_encode(['status'=>1,'pesan'=>'Logo diperbarui','path'=>base_url($relative)]);
	}

    function simpan(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('zyacbt-nama', 'Nama ZYACBT','required|strip_tags');
        $this->form_validation->set_rules('zyacbt-keterangan', 'Keterangan ZYACBT','required|strip_tags');
		$this->form_validation->set_rules('zyacbt-link-login', 'Link Login Operator','required|strip_tags');
		$this->form_validation->set_rules('zyacbt-mobile-lock-xambro', 'Lock Mobile Exam Browser','required|strip_tags');
		$this->form_validation->set_rules('zyacbt-informasi', 'Informasi Peserta Tes','required');
		// welcome lines optional no required rule
        
        if($this->form_validation->run() == TRUE){
            $data['konfigurasi_isi'] = $this->input->post('zyacbt-nama', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_nama', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('zyacbt-keterangan', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_keterangan', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('zyacbt-link-login', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'link_login_operator', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('zyacbt-mobile-lock-xambro', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_mobile_lock_xambro', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('zyacbt-informasi', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_informasi', $data);

			// Simpan welcome line Indonesia
			if($this->input->post('welcome-line-id', true) !== null){
				$wl_id_value = $this->input->post('welcome-line-id', true);
				$data['konfigurasi_isi'] = $wl_id_value;
				$cek = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode','welcome_line_id',1);
				if($cek->num_rows()>0){
					$this->cbt_konfigurasi_model->update('konfigurasi_kode','welcome_line_id',$data);
				}else{
					$insert = array('konfigurasi_kode'=>'welcome_line_id','konfigurasi_isi'=>$wl_id_value);
					$this->cbt_konfigurasi_model->save($insert);
				}
			}
			// Simpan welcome line English
			if($this->input->post('welcome-line-en', true) !== null){
				$wl_en_value = $this->input->post('welcome-line-en', true);
				$data['konfigurasi_isi'] = $wl_en_value;
				$cek = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode','welcome_line_en',1);
				if($cek->num_rows()>0){
					$this->cbt_konfigurasi_model->update('konfigurasi_kode','welcome_line_en',$data);
				}else{
					$insert = array('konfigurasi_kode'=>'welcome_line_en','konfigurasi_isi'=>$wl_en_value);
					$this->cbt_konfigurasi_model->save($insert);
				}
			}

            $status['status'] = 1;
			$status['pesan'] = 'Pengaturan berhasil disimpan ';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_pengaturan_zyacbt(){
    	$data['data'] = 1;
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'link_login_operator', 1);
		$data['link_login_operator'] = 'ya';
		if($query->num_rows()>0){
			$data['link_login_operator'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
		$data['cbt_nama'] = 'Computer Based-Test';
		if($query->num_rows()>0){
			$data['cbt_nama'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
		$data['cbt_keterangan'] = 'Ujian Online Berbasis Komputer';
		if($query->num_rows()>0){
			$data['cbt_keterangan'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_informasi', 1);
		$data['cbt_informasi'] = 'Silahkan pilih Tes yang diikuti dari daftar tes yang tersedia dibawah ini. Apabila tes tidak muncul, silahkan menghubungi Operator yang bertugas.';
		if($query->num_rows()>0){
			$data['cbt_informasi'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_mobile_lock_xambro', 1);
		$data['mobile_lock_xambro'] = 'ya';
		if($query->num_rows()>0){
			$data['mobile_lock_xambro'] = $query->row()->konfigurasi_isi;
		}

		// Welcome lines retrieval
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode','welcome_line_id',1);
		$data['welcome_line_id'] = ($query->num_rows()>0)? $query->row()->konfigurasi_isi : 'Selamat Datang';
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode','welcome_line_en',1);
		$data['welcome_line_en'] = ($query->num_rows()>0)? $query->row()->konfigurasi_isi : 'WELCOME TO COMPUTER BASED TEST';
		
		echo json_encode($data);
    }
}