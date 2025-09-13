<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Group
		<small>Daftar group, penambahan group, pengubahan group, dan penghapusan group</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Group</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
    						<div class="box-title">Daftar Group</div>
    						<div class="box-tools pull-right">
    							<div class="dropdown pull-right">
    								<a style="cursor: pointer;" onclick="tambah()">Tambah Group</a>
    							</div>
    						</div>
                    </div><!-- /.box-header -->

                    <div class="box-body">
                        <table id="table-group" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width:28px; text-align:center;">
                                        <input type="checkbox" id="select-all-group" />
                                    </th>
                                    <th>No.</th>
                                    <th>Nama Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>                        
                        <div class="clearfix" style="margin-top:10px;">
                            <button id="btn-bulk-delete" class="btn btn-danger btn-sm" disabled>
                                <i class="fa fa-trash"></i> Hapus Terpilih
                            </button>
                            <span id="bulk-info" style="margin-left:10px; font-weight:600;"></span>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="modal" id="modal-tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/tambah','id="form-tambah"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Tambah Group</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                                <label>Nama Group</label>
                                <input type="text" class="form-control" id="tambah-group" name="tambah-group" placeholder="Nama Group">
                            </div>

                            <p>NB : Group digunakan untuk mengelompokkan setiap user</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Tambah</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/edit','id="form-edit"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Edit Group</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-edit"></div>
                            <div class="form-group">
                                <label>Nama Group</label>
                                <input type="hidden" name="edit-id" id="edit-id">
                                <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                                <input type="hidden" name="edit-group-asli" id="edit-group-asli">
                                <input type="text" class="form-control" id="edit-group" name="edit-group" placeholder="Nama Group">
                            </div>

                            <p>NB : Group yang dihapus, maka semua data user akan ikut terhapus !</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-hapus" class="btn btn-default pull-left">Hapus</button>
                    <button type="button" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-group').dataTable().fnReloadAjax();
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-group').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-group').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-group').val(data.group);
                $('#edit-group-asli').val(data.group);
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
            $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });

        $('#form-edit').submit(function(){
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

        var table = $('#table-group').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true,
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"28px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"60px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                // aData: ['', No., Nama, Action]
                var nomor = aData[1];
                var nama = aData[2];
                var actionHtml = aData[3];
                var match = actionHtml.match(/edit\('([^']+)'\)/);
                var grupId = match ? match[1] : '';
                $('td:eq(0)', nRow).html('<input type="checkbox" class="chk-grup" value="'+grupId+'" />');
                $('td:eq(1)', nRow).html(nomor);
                $('td:eq(2)', nRow).html(nama);
                $('td:eq(3)', nRow).html(actionHtml);
                return nRow;
            }
         });

        // Select all handler
        $('#select-all-group').on('change', function(){
            var checked = $(this).is(':checked');
            $('.chk-grup').prop('checked', checked);
            updateBulkInfo();
        });

        // Delegated change for dynamic rows
        $('#table-group').on('change', '.chk-grup', function(){
            if(!$(this).is(':checked')){
                $('#select-all-group').prop('checked', false);
            }
            updateBulkInfo();
        });

        function updateBulkInfo(){
            var total = $('.chk-grup:checked').length;
            if(total>0){
                $('#btn-bulk-delete').prop('disabled', false);
                $('#bulk-info').text(total+ ' dipilih');
            }else{
                $('#btn-bulk-delete').prop('disabled', true);
                $('#bulk-info').text('');
            }
        }

        $('#btn-bulk-delete').click(function(e){
            e.preventDefault();
            var ids = $('.chk-grup:checked').map(function(){ return $(this).val(); }).get();
            if(ids.length===0){ return; }
            if(!confirm('Hapus '+ids.length+' group terpilih? Data user didalam group yang dihapus juga akan terhapus.')){ return; }
            $(this).prop('disabled', true);
            $.ajax({
                url: '<?php echo site_url().'/'.$url; ?>/bulk_delete',
                type: 'POST',
                data: { ids: ids },
                dataType: 'json',
                success: function(res){
                    if(res.status==1){
                        notify_success(res.pesan);
                        refresh_table();
                        $('#select-all-group').prop('checked', false);
                        $('#bulk-info').text('');
                    }else{
                        notify_error(res.pesan || 'Gagal bulk delete');
                    }
                },
                error: function(){
                    notify_error('Terjadi kesalahan koneksi');
                },
                complete: function(){
                    $('#btn-bulk-delete').prop('disabled', true);
                }
            });
        });
    });
</script>