<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* ZYA CBT
* Achmad Lutfi
* achmdlutfi@gmail.com
* achmadlutfi.wordpress.com
*/
class Welcome extends CI_Controller {
	private $kelompok = 'ujian';
	private $url = 'welcome';

	function __construct(){
		parent:: __construct();
		$this->load->model('cbt_konfigurasi_model');
		$this->load->library('access_tes');
		$this->load->library('user_agent');
		$this->load->model('cbt_konfigurasi_model');
	}
    
	public function index(){
		$data['url'] = $this->url;
		$data['timestamp'] = strtotime(date('Y-m-d H:i:s'));
		if ($this->agent->is_browser()){
            if($this->agent->browser()=='Internet Explorer' ){
                $this->template->display_user('blokbrowser_view', 'Browser yang didukung');
            }else{
				$akses_cbt = 1;
				if($this->agent->is_mobile()){
					$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_mobile_lock_xambro', 1);
					if($query->row()->konfigurasi_isi=="ya"){
						$agent = $this->agent->agent_string();
						if(strpos($agent, 'ZYACBT')==false){
							$akses_cbt = 0;
						}
					}
				}
				if($akses_cbt==1){
					if(!$this->access_tes->is_login()){
						$data['link_login_operator'] = "tidak";
						$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'link_login_operator', 1);
						if($query_konfigurasi->num_rows()>0){
							$data['link_login_operator'] = $query_konfigurasi->row()->konfigurasi_isi;
						}
						
						$data['cbt_keterangan'] = "Ujian Online Berbasis Komputer";
						$query_konfigurasi = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
						if($query_konfigurasi->num_rows()>0){
							$data['cbt_keterangan'] = $query_konfigurasi->row()->konfigurasi_isi;
						}
						
						$this->template->display_user($this->kelompok.'/welcome_view', 'Selamat Datang', $data);
					}else{
						redirect('tes_dashboard');
					}					
				}else{
					$this->template->display_user('lockmobile_view', 'Exam Browser');
				}
            }
        }else{
            $this->template->display_user('blokbrowser_view', 'Browser yang didukung');
        }
	}

	function login(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username','required|strip_tags');
        $this->form_validation->set_rules('password', 'Password','required|strip_tags');
        if($this->form_validation->run() == TRUE){
            $this->form_validation->set_rules('token','token','callback_check_login');
            if($this->form_validation->run() == FALSE){
                //Jika login gagal
                $status['status'] = 0;
                $status['error'] = validation_errors();
            }else{
                //Jika sukses
                // Tambahkan pengecekan status tesuser
                $username = $this->input->post('username',TRUE);
                $this->load->model('cbt_user_model');
                $user = $this->cbt_user_model->get_by_kolom_limit('user_name', $username, 1);
                if($user->num_rows()>0){
                    $user_id = $user->row()->user_id;
                    $this->load->model('cbt_tes_user_model');
                    $tes = $this->cbt_tes_user_model->get_by_user_status($user_id);
                    if($tes->num_rows()>0){
                        foreach($tes->result() as $t){
                            if($t->tesuser_status == 4){
                                $status['status'] = 0;
                                $status['error'] = 'Anda sudah menyelesaikan ujian, tidak bisa login lagi.';
                                echo json_encode($status);
                                return;
                            }
                            // Jika ada tes status 1/3, langsung set ke 4 (selesai)
                            if($t->tesuser_status == 1 || $t->tesuser_status == 3){
                                $this->cbt_tes_user_model->update('tesuser_id', $t->tesuser_id, ['tesuser_status' => 4]);
                            }
                        }
                    }
                }
                $status['status'] = 1;
            }
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }
        echo json_encode($status);
    }
    
    function logout(){
        // Tambahkan pengecekan status tesuser
        $this->load->model('cbt_user_model');
        $this->load->model('cbt_tes_user_model');
        $username = $this->access_tes->get_username();
        $user = $this->cbt_user_model->get_by_kolom_limit('user_name', $username, 1);
        if($user->num_rows()>0){
            $user_id = $user->row()->user_id;
            $tes = $this->cbt_tes_user_model->get_by_user_status($user_id);
            if($tes->num_rows()>0){
                foreach($tes->result() as $t){
                    if(($t->tesuser_status == 3 || $t->tesuser_status == 1) && !empty($t->tesuser_creation_time)){
                        // Update status jadi selesai hanya jika sudah pernah dimulai
                        $this->cbt_tes_user_model->update('tesuser_id', $t->tesuser_id, ['tesuser_status' => 4]);
                    }
                }
            }
        }
        $this->access_tes->logout();
        redirect('welcome');
    }
	
	function check_login(){	
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		
		$login = $this->access_tes->login($username, $password, $this->input->ip_address());
		if($login==1){
			return TRUE;
		}else if($login==2){
			$this->form_validation->set_message('check_login','Password yang dimasukkan salah');
			return FALSE;
		}else{
			$this->form_validation->set_message('check_login','Username yang dimasukkan tidak dikenal');
			return FALSE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */