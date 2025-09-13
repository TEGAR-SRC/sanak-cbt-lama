<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Pengaturan Sistem
		<small>Melakukan pengaturan Identitas Assessment CBT</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(); ?>/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Pengaturan Sistem</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-12">
			<?php echo form_open($url.'/simpan','id="form-pengaturan"'); ?>
                <div class="box">
                    <div class="box-header with-border">
    					<div class="box-title">Daftar Pengaturan Sistem</div>
                    </div><!-- /.box-header -->

                    <div class="box-body form-horizontal">
						<div id="form-pesan"></div>
                        <div class="form-group">
							<label class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="zyacbt-nama" name="zyacbt-nama" >
                                <p class="help-block">
									Nama Pelaksana Assessment CBT.<br />
                                    Digunakan sebagai identitas pelaksanaan Tes.
								</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Keterangan</label>
                            <div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="zyacbt-keterangan" name="zyacbt-keterangan" >
                                <p class="help-block">
									Keterangan Pelaksana bisa diisi dengan Slogan ataupun Alamat dari Organisasi.
								</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Link Login Operator</label>
                            <div class="col-sm-8">
								<select class="form-control input-sm" id="zyacbt-link-login" name="zyacbt-link-login">
									<option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
								</select>
                                <p class="help-block">
									Menampilkan Link <b>Log In Operator</b> pada Halaman login user.
								</p>
							</div>
						</div>
						<div class="form-group">
						<!-- Removed Lock Mobile Exam Browser field -->
						<div class="form-group">
							<label class="col-sm-4 control-label">Informasi ke Peserta Tes</label>
                            <div class="col-sm-8">
								<input type="hidden" name="zyacbt-informasi" id="zyacbt-informasi" >
								<textarea class="textarea" id="zyacbt_informasi" name="zyacbt_informasi" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                <p class="help-block">
									Informasi yang diberikan ke peserta tes di Dashboard Peserta Tes
								</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">Welcome Line (ID)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="welcome-line-id" name="welcome-line-id" placeholder="Selamat Datang" />
								<p class="help-block">Teks baris pertama di bawah logo (Bahasa Indonesia).</p>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Welcome Line (EN)</label>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="welcome-line-en" name="welcome-line-en" placeholder="WELCOME TO COMPUTER BASED TEST" />
								<p class="help-block">Teks baris kedua di bawah logo (Bahasa Inggris / opsional).</p>
							</div>
						</div>

							<hr />
							<div class="form-group">
								<label class="col-sm-4 control-label">Logo Login Siswa</label>
								<div class="col-sm-8">
									<div id="logo-alert"></div>
									<div style="margin-bottom:8px;">
										<input type="file" id="logo-file" accept="image/*" class="form-control input-sm" />
									</div>
									<button type="button" id="btn-upload-logo" class="btn btn-default btn-sm"><i class="fa fa-upload"></i> Upload Logo</button>
									<button type="button" id="btn-hapus-logo" class="btn btn-danger btn-sm" style="display:none;"><i class="fa fa-trash"></i> Hapus</button>
									<p class="help-block">Format: jpg/png/webp, maks 1MB, lebar ideal ≤ 400px.</p>
									<div id="logo-preview" style="padding:10px; border:1px solid #ddd; border-radius:6px; background:#fafafa; display:inline-block; max-width:260px;">
										<?php if(!empty($current_logo)){ ?>
											<img src="<?php echo base_url($current_logo); ?>" style="max-width:240px; height:auto;" />
										<?php } else { ?>
											<em>Belum ada logo khusus</em>
										<?php } ?>
									</div>
								</div>
							</div>
                    </div>
					<div class="box-footer">
						<button type="submit" id="btn-simpan" class="btn btn-primary pull-right">Simpan Pengaturan</button>
					</div>
                </div>
			</form>
        </div>
    </div>
</section><!-- /.content -->



<script lang="javascript">
	function load_data(){
		$("#modal-proses").modal('show');
		$.getJSON('<?php echo site_url().'/'.$url; ?>/get_pengaturan_zyacbt', function(data){
			if(data.data==1){
				$('#zyacbt-nama').val(data.cbt_nama);
				$('#zyacbt-keterangan').val(data.cbt_keterangan);
				$('#zyacbt-link-login').val(data.link_login_operator);
				$('#zyacbt_informasi').val(data.cbt_informasi);
				$('#zyacbt-informasi').val('');
				// set welcome lines
				$('#welcome-line-id').val(data.welcome_line_id || 'Selamat Datang');
				$('#welcome-line-en').val(data.welcome_line_en || 'WELCOME TO COMPUTER BASED TEST');
			}
			$("#modal-proses").modal('hide');
		});
	}

    $(function(){
		CKEDITOR.replace('zyacbt_informasi');
		
		load_data();

		// Tampilkan tombol hapus jika sudah ada logo
		<?php if(!empty($current_logo)){ ?>
		$('#btn-hapus-logo').show();
		<?php } ?>

		$('#btn-upload-logo').click(function(){
			var file = $('#logo-file')[0].files[0];
			if(!file){
				$('#logo-alert').html('<div class="alert alert-warning" style="margin-top:8px;">Pilih file dulu.</div>');
				return;
			}
			var fd = new FormData(); fd.append('logo', file);
			$('#logo-alert').html('<div class="alert alert-info" style="margin-top:8px;">Mengupload...</div>');
			$.ajax({
				url: '<?php echo site_url($url.'/upload_logo'); ?>',
				type: 'POST', data: fd, processData:false, contentType:false,
				success: function(res){
					try{ var o = JSON.parse(res); }catch(e){ o={status:0,pesan:'Respon tidak valid'}; }
					if(o.status==1){
						$('#logo-alert').html('<div class="alert alert-success" style="margin-top:8px;">'+o.pesan+'</div>');
						$('#logo-preview').html('<img src="'+o.path+'" style="max-width:240px; height:auto;" />');
						$('#btn-hapus-logo').show();
					}else{
						$('#logo-alert').html('<div class="alert alert-danger" style="margin-top:8px;">'+o.pesan+'</div>');
					}
				},
				error: function(){
					$('#logo-alert').html('<div class="alert alert-danger" style="margin-top:8px;">Gagal koneksi server</div>');
				}
			});
		});

		$('#btn-hapus-logo').click(function(){
			if(!confirm('Hapus logo khusus?')) return;
			// Reset tampilan (hapus manual di DB jika ingin benar-benar kosong)
			$('#logo-preview').html('<em>Belum ada logo khusus</em>');
			$('#btn-hapus-logo').hide();
			$('#logo-alert').html('<div class="alert alert-info" style="margin-top:8px;">Logo direset (hapus record login_logo di tabel app_setting untuk final).</div>');
		});
        $('#form-pengaturan').submit(function(){
            $("#modal-proses").modal('show');
			$('#zyacbt-informasi').val(CKEDITOR.instances.zyacbt_informasi.getData());
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan",
                    type:"POST",
                    data:$('#form-pengaturan').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
    });
</script>