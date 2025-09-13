<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {
    private $table = 'app_setting';

    public function __construct(){
        // CI_Model tidak memiliki constructor eksplisit; jangan panggil parent::__construct()
        $this->_ensure_table();
    }

    private function _ensure_table(){
        if(!$this->db->table_exists($this->table)){
            $this->load->dbforge();
            $fields = [
                'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ],
                'nama' => [ 'type' => 'VARCHAR', 'constraint' => 100 ],
                'nilai' => [ 'type' => 'TEXT', 'null' => TRUE ],
                'updated_at' => [ 'type' => 'DATETIME', 'null' => TRUE ]
            ];
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->add_key('nama');
            $this->dbforge->create_table($this->table, TRUE);
            $this->db->query("CREATE UNIQUE INDEX idx_app_setting_nama ON {$this->table}(nama)");
        }
    }

    public function get($nama, $default = null){
        $row = $this->db->where('nama', $nama)->get($this->table)->row();
        return $row ? $row->nilai : $default;
    }

    public function set($nama, $nilai){
        $existing = $this->db->where('nama', $nama)->get($this->table)->row();
        $data = ['nilai' => $nilai, 'updated_at' => date('Y-m-d H:i:s')];
        if($existing){
            $this->db->where('id', $existing->id)->update($this->table, $data);
        } else {
            $data['nama'] = $nama;
            $this->db->insert($this->table, $data);
        }
    }
}
