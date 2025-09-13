<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet as PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Wrapper sederhana agar migrasi dari PHPExcel ke PhpSpreadsheet mudah.
 * Pemakaian sebelumnya: $this->load->library('excel'); -> diganti $this->load->library('spreadsheet');
 * Akses workbook baru: $ss = $this->spreadsheet->create();
 */
class Spreadsheet {
    /** @var PhpSpreadsheet */
    public $workbook;

    public function __construct() {
        // Pastikan composer autoload tersedia satu level di atas application
        $autoload1 = FCPATH.'vendor/autoload.php';
        $autoload2 = APPPATH.'vendor/autoload.php';
        if (file_exists($autoload1)) { require_once $autoload1; }
        elseif (file_exists($autoload2)) { require_once $autoload2; }
    }

    /** Buat workbook baru */
    public function create(): PhpSpreadsheet {
        $this->workbook = new PhpSpreadsheet();
        return $this->workbook;
    }

    /** Load template xlsx */
    public function load($path): PhpSpreadsheet {
        $this->workbook = IOFactory::load($path);
        return $this->workbook;
    }

    /** Output ke browser sebagai XLSX */
    public function output($filename) {
        if(!$this->workbook) { $this->create(); }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($this->workbook);
        $writer->save('php://output');
    }
}
