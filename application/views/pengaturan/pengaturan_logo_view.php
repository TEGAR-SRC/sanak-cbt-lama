<section class="content-header">
  <h1>Pengaturan Logo Login</h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Upload Logo Baru</h3>
        </div>
        <div class="box-body">
          <div id="logo-alert"></div>
          <form id="form-logo" enctype="multipart/form-data">
            <div class="form-group">
              <label>Pilih Gambar (jpg/png/webp, max 1MB)</label>
              <input type="file" name="logo" id="logo" class="form-control" accept="image/*" required />
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
            </div>
          </form>
          <hr />
          <p><strong>Preview Saat Ini:</strong></p>
          <div id="logo-preview" style="padding:12px; border:1px solid #ddd; border-radius:8px; background:#fafafa;">
            <?php if(!empty($current_logo)){ ?>
              <img src="<?php echo base_url($current_logo); ?>" style="max-width:250px; height:auto;" />
            <?php } else { ?>
              <em>Belum ada logo khusus. Menggunakan default.</em>
            <?php } ?>
          </div>
          <p style="margin-top:10px; font-size:12px; color:#666;">Disarankan lebar maksimal 400px agar tampilan optimal.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(function(){
  $('#form-logo').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $('#logo-alert').html('');
    $.ajax({
      url: '<?php echo site_url('manager/pengaturan_logo/upload'); ?>',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function(){
        $('#logo-alert').html('<div class="alert alert-info">Mengupload...</div>');
      },
      success: function(res){
        try{ var obj = JSON.parse(res); }catch(e){ obj={status:0,pesan:'Respon tidak valid'}; }
        if(obj.status==1){
          $('#logo-alert').html('<div class="alert alert-success">'+obj.pesan+'</div>');
          $('#logo-preview').html('<img src="'+obj.path+'" style="max-width:250px; height:auto;" />');
        }else{
          $('#logo-alert').html('<div class="alert alert-danger">'+obj.pesan+'</div>');
        }
      },
      error: function(){
        $('#logo-alert').html('<div class="alert alert-danger">Terjadi kesalahan server</div>');
      }
    });
  });
});
</script>
