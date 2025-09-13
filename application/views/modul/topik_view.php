<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Topik
		<small>Daftar topik, penambahan topik, pengubahan topik, dan penghapusan topik berdasarkan Modul</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Topik</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="box">
				<div class="box-header with-border">
					<div class="box-title">Pilih Modul</div>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Modul</label>
						<div id="data-kelas">
							<select name="modul" id="modul" class="form-control input-sm">
								<?php if(!empty($select_modul)){ echo $select_modul; } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<p>Pilih modul terlebih dahulu untuk menampilkan dan menambah topik</p>
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="box">
				<div class="box-header with-border">
					<div class="box-title">Daftar Topik</div>
					<div class="box-tools pull-right">
						<a id="btn-tambah-topik" style="cursor: pointer;" onclick="tambah()">Tambah Topik</a>
					</div>
				</div>
				<div class="box-body">
					<?php echo form_open($url.'/hapus_daftar_topik','id="form-hapus"'); ?>
					<input type="hidden" name="check" id="check" value="0">
					<table id="table-topik" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th class="all">Nama Topik</th>
								<th>Deskripsi</th>
								<th>Jml. Soal</th>
								<th>Status</th>
								<th class="all">Action</th>
								<th class="all"></th>
							</tr>
						</thead>
					</table>
					</form>
				</div>
				<div class="box-footer">
					<button type="button" id="btn-edit-hapus" class="btn btn-primary">Hapus</button>
					<button type="button" id="btn-edit-pilih" class="btn btn-default pull-right">Pilih Semua</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tambah -->
	<div class="modal" id="modal-tambah" data-backdrop="static">
		<?php echo form_open($url.'/tambah','id="form-tambah"'); ?>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Topik</h4>
				</div>
				<div class="modal-body">
					<div id="form-pesan"></div>
					<div class="form-group">
						<label>Nama Topik</label>
						<input type="hidden" name="tambah-modul-id" id="tambah-modul-id">
						<input type="text" class="form-control" id="tambah-topik" name="tambah-topik" placeholder="Nama Topik">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<input type="text" class="form-control" id="tambah-deskripsi" name="tambah-deskripsi" placeholder="Deskripsi Topik">
					</div>
					<div class="form-group">
						<label>Status</label>
						<input type="text" class="form-control" id="tambah-status" name="tambah-status" value="AKTIF" readonly>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
		</form>
	</div>

	<!-- Modal Edit dan Hapus -->
	<div class="modal" id="modal-edit" data-backdrop="static">
		<?php echo form_open($url.'/edit','id="form-edit"'); ?>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Topik</h4>
				</div>
				<div class="modal-body">
					<div id="form-pesan-edit"></div>
					<input type="hidden" id="edit-id" name="edit-id">
					<input type="hidden" id="edit-modul-id" name="edit-modul-id">
					<input type="hidden" id="edit-pilihan" name="edit-pilihan">
					<input type="hidden" id="edit-topik-asli" name="edit-topik-asli">
					<div class="form-group">
						<label>Nama Topik</label>
						<input type="text" class="form-control" id="edit-topik" name="edit-topik">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<input type="text" class="form-control" id="edit-deskripsi" name="edit-deskripsi">
					</div>
					<div class="form-group">
						<label>Status</label>
						<input type="text" class="form-control" id="edit-status" name="edit-status" value="AKTIF" readonly>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="edit-hapus" class="btn btn-danger">Hapus</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</section>



<script lang="javascript">
    function refresh_table(){
        $('#table-topik').dataTable().fnReloadAjax();
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-topik').val('');
        $('#tambah-modul-id').val('');
        $('#tambah-deskripsi').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-topik').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-topik').val(data.topik);
                $('#edit-topik-asli').val(data.topik);
                $('#edit-deskripsi').val(data.deskripsi);
				$('#edit-modul-id').val('');
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
        $('#btn-edit-pilih').click(function(event) {
            if($('#check').val()==0) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
                $('#check').val('1');
            }else{
                $(':checkbox').each(function() {
                    this.checked = false;
                });
                $('#check').val('0');
            }
        });

        $("#modul").change(function(){
            refresh_table();
        });

        $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_topik",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
                            notify_success(obj.pesan);
                            $('#check').val('0');
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        $('#form-edit').submit(function(){
			$('#edit-modul-id').val($('#modul').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-edit").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#form-tambah').submit(function(){
            $('#tambah-modul-id').val($('#modul').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-tambah").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-topik').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "modul", "value": $('#modul').val()} );
                  }
         });          
    });
</script>