<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 20px;">
    <h1 style="font-weight:700; margin:0; font-size:22px; letter-spacing:.5px;">
        WELCOME TO COMPUTER BASED TEST
        <small style="display:block; margin-top:4px; font-size:13px; font-weight:600; color:#2b5f56; letter-spacing:.5px;">
            EDUKASI PERPUSTAKAN DIGITAL (EDUPUS CBT )
        </small>
    </h1>
	<ol class="breadcrumb" style="background: transparent; margin-top: 10px;">
		<li><a href="<?php echo site_url(); ?>/manager"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Informasi Box -->
    <div class="box box-default collapsed-box shadow-box rounded-box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-info-circle"></i> Informasi</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body">
            Ujian online CBT Untuk kebutuhan ujian online sekolah.
        </div>
    </div>

    <!-- Callout Info -->
	<div class="callout callout-info shadow-box rounded-box">
    	<h4><i class="fa fa-lightbulb-o"></i> Informasi</h4>
        <p>Ini adalah area administratif Assessment CBT, dengan platform user-friendly untuk membuat, mengelola dan melaksanakan ujian online.</p>
    </div>

    <!-- Konfigurasi System -->
    <div class="box box-default shadow-box rounded-box collapsed-box" id="konfigurasi-box" style="border:1px solid #2b5f56;">
        <div class="box-header with-border" style="background:#2b5f56; color:#fff;">
            <h3 class="box-title" style="margin:0; font-weight:600; display:flex; gap:8px; align-items:center;">
                <i class="fa fa-cogs" style="color:#5ae16c;"></i>
                <span class="konfigurasi-label">Konfigurasi System</span>
            </h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" title="Buka / Tutup" id="toggle-konfigurasi"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body" style="background:#e1f9e5; color:#2b5f56;">
            <div class="row">
                <div class="col-md-4">
                    <strong><u>Waktu Server</u></strong><br />
                    <b><?php if(!empty($waktu_server)){ echo $waktu_server; } ?></b><br />
                    Pastikan waktu server sesuai dengan waktu saat ini.
                </div>
                <div class="col-md-4">
                    <strong><u>Konfigurasi Upload PHP</u></strong><br />
                    POST_MAX_SIZE = <?php if(!empty($post_max_size)){ echo $post_max_size; } ?><br />
                    UPLOAD_MAX_FILESIZE = <?php if(!empty($upload_max_filesize)){ echo $upload_max_filesize; } ?>
                </div>
                <div class="col-md-4">
                    <strong><u>Folder Upload</u></strong><br />
                    uploads = <?php if(!empty($dir_public_uploads)){ echo $dir_public_uploads; } ?><br />
                    public/uploads = <?php if(!empty($dir_uploads)){ echo $dir_uploads; } ?><br />
                    Pastikan kedua folder bersifat Writeable.
                </div>
            </div>
        </div>
    </div>

    <!-- Petunjuk Penggunaan (collapsible) -->
    <div class="box box-danger box-solid shadow-box rounded-box collapsed-box" id="petunjuk-box" style="border:1px solid #2b5f56;">
        <div class="box-header with-border" style="background:#2b5f56; color:#fff;">
        	<h3 class="box-title" style="font-weight:600; display:flex; gap:8px; align-items:center;">
                <i class="fa fa-question-circle" style="color:#5ae16c;"></i>
                <span class="petunjuk-label">Petunjuk Penggunaan</span>
            </h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Buka / Tutup" id="toggle-petunjuk"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body" style="background:#e1f9e5; color:#2b5f56;">
        	<dl>
        		<dt><strong>Data Modul</strong></dt>
                <dd>
                	Mengelola modul, topik, soal, dan file.
                	<ol>
                		<li>Modul</li>
                		<li>Topik</li>
                		<li>Soal</li>
                		<li>Import Soal Word</li>
						<li>Import Soal Spreadsheet</li>
                		<li>Daftar Soal</li>
                		<li>File Manager</li>
                	</ol>
                </dd>

                <dt><strong>Data Peserta</strong></dt>
                <dd>
                	Mengatur peserta dan grup.
                	<ol>
                		<li>Daftar Group</li>
                		<li>Daftar Peserta</li>
                		<li>Import Data Peserta</li>
						<li>Cetak Kartu</li>
                	</ol>
                </dd>

                <dt><strong>Data Tes</strong></dt>
                <dd>
                	Mengelola tes, evaluasi dan hasil.
                	<ol>
                		<li>Tambah Tes</li>
                		<li>Daftar Tes</li>
                		<li>Evaluasi Tes</li>
                		<li>Hasil Tes</li>
                		<li>Token</li>
                	</ol>
                </dd>

				<dt><strong>Laporan</strong></dt>
                <dd>
                	Analisis butir soal & rekap hasil.
                	<ol>
                		<li>Analisis Butir Soal</li>
                        <li>Rekap Hasil Tes</li>
                	</ol>
                </dd>

                <dt><strong>Tool</strong></dt>
                <dd>
                    Backup, export-import soal, file pendukung.
                    <ol>
                        <li>Backup Data</li>
                        <li>Export Import Soal</li>
                    </ol>
                </dd>
            </dl>
        </div>
    </div>
</section>

<!-- Custom Style (Disarankan pindahkan ke file CSS eksternal) -->
<style>
.shadow-box {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}
.rounded-box {
    border-radius: 12px !important;
    overflow: hidden;
}
.box {
    margin-bottom: 24px;
}
.box-header {
    background-color: #f5f5f5;
    border-radius: 12px 12px 0 0;
    padding: 12px 18px;
}
.box-body {
    padding: 18px;
    font-size: 14px;
    color: #333;
}
/* Override danger box agar pakai tema hijau */
#petunjuk-box.box-danger.box-solid>.box-header {background:#2b5f56 !important;}
#petunjuk-box .box-body a { color:#2b5f56; font-weight:600; }
#petunjuk-box.collapsed-box .box-header .fa-plus:before { content:"\f067"; }
#petunjuk-box:not(.collapsed-box) .box-header .fa-plus:before { content:"\f068"; }
.petunjuk-label {background:#5ae16c; color:#000; padding:4px 10px; border-radius:4px; font-size:13px; letter-spacing:.3px; box-shadow:0 1px 2px rgba(0,0,0,.15);} 
/* Konfigurasi System collapsible */
#konfigurasi-box.box-default>.box-header {background:#2b5f56 !important;}
#konfigurasi-box .konfigurasi-label {background:#5ae16c; color:#000; padding:4px 10px; border-radius:4px; font-size:13px; letter-spacing:.3px; box-shadow:0 1px 2px rgba(0,0,0,.15);} 
#konfigurasi-box.collapsed-box .box-header .fa-plus:before { content:"\f067"; }
#konfigurasi-box:not(.collapsed-box) .box-header .fa-plus:before { content:"\f068"; }
.callout-info {
    background-color: #e6f4ff;
    border-left-color: #2196f3;
}
.callout h4 {
    margin-top: 0;
}
dl {
    margin-bottom: 0;
}
dt {
    margin-top: 15px;
    font-weight: 600;
}
dd {
    margin-left: 0;
}
</style>
