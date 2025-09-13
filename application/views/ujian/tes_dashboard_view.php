<div class="container">
	<!-- Content Header (Page header) -->
	<!-- Tambahkan di bagian <head> jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .content-header {
        background: #fff;
        border-radius: 16px;
        padding: 24px 32px;
        margin-bottom: 24px;
        box-shadow: 0 10px 24px rgba(0,0,0,0.05);
    }

    .content-header h1 {
        font-size: 24px;
        font-weight: 700;
        color: #0073b7;
        margin-bottom: 10px;
    }

    .content-header small {
        font-size: 16px;
        color: #888;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 14px;
    }

    .breadcrumb > li {
        display: inline-block;
        color: #0073b7;
    }

    .breadcrumb > li + li:before {
        content: "/";
        padding: 0 6px;
        color: #aaa;
    }

    .callout {
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        padding: 20px;
        background-color: #e8f4fc;
        margin-bottom: 24px;
        color: #31708f;
    }

    .box {
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .box-header {
        background-color: #00a65a;
        color: #fff;
        padding: 16px 24px;
        font-size: 18px;
        font-weight: 600;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .box-body {
        padding: 24px;
    }

    table.dataTable {
        width: 100% !important;
        border-collapse: collapse;
        border-radius: 12px;
        overflow: hidden;
        background-color: #fff;
    }

    table.dataTable thead {
        background-color: #f1f1f1;
    }

    table.dataTable th, 
    table.dataTable td {
        padding: 12px 16px;
        text-align: left;
    }

    @media (max-width: 768px) {
        .content-header {
            padding: 16px;
        }

        .box-body {
            padding: 16px;
        }

        table.dataTable th, 
        table.dataTable td {
            padding: 10px;
        }
    }
</style>

    <section class="content-header">
    	<h1>
    		SELAMAT DATANG <?php if(!empty($nama)){ echo $nama; } if(!empty($group)){ echo ' | '.$group; } ?>
            <small>di Ujian Online Berbasis Komputer</small>
        </h1>
        <br><strong class="desc-title">WARNING !...... </strong>
        <br><strong class="desc-title">SYSTEM  AUTO  LOGOUT/BLOCKED</strong>
        <p>Apabila keluar dari halaman ujian di anggap selesai/menyontek</p>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">dashboard</li>
        </ol>
	</section>

	<!-- Main content -->
    <section class="content">
		<?php
			if(!empty($informasi)){
				?>
				<div class="callout callout-info">
                    <h4>Informasi</h4>
                    <?php 
					echo $informasi
					?>
                </div>
				<?php
			}else{
				?>
				<div class="callout callout-info">
					<h4>Informasi</h4>
					<p>Silahkan pilih Tes yang diikuti dari daftar tes yang tersedia dibawah ini. Apabila tes tidak muncul, silahkan menghubungi Operator yang bertugas.</p>
				</div>
				<?php
			}
		?>
        <div class="box box-danger box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Tes</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table-tes" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th class="all">Tes</th>
                            <th>Waktu Mulai Tes</th>
                            <th>Waktu Selesai Tes</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <th class="all">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>   
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
    $(function () {
        $('#table-tes').DataTable({
                  "paging": true,
                  "iDisplayLength":25,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true
         });   
    });
</script>