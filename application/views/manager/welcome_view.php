<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Selamat Datang
            <small>di Halaman Login Administrator <?php if (!empty($site_name)) { echo $site_name; } ?></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="callout" style="background-color: #f8d7da; border-left: 5px solid #dc3545; color: #721c24; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 20px;">
            <h4 style="margin-top: 0;">Informasi</h4>
            <p>
                Selamat datang di Halaman Login Aplikasi Computer Based-Test. Untuk memulai silahkan melakukan 
                proses Login dengan menggunakan username dan password yang sudah dimiliki.
            </p>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- Login Box -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 1px solid #e0e0e0;">
                    <div class="box-header with-border" style="border-bottom: 1px solid #ccc; border-top-left-radius: 15px; border-top-right-radius: 15px; background: #f1f1f1;">
                        <h3 class="box-title">Login Operator</h3>
                    </div>
                    
                    <?php echo form_open('welcome/login', 'id="form-login" class="form-horizontal"'); ?>
                    <div class="box-body" style="padding: 20px;">
                        <div id="form-pesan"></div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" style="border-radius: 10px;" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="border-radius: 10px;" />
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; background: #f9f9f9; padding: 15px;">
                        <button type="submit" id="btn-login" class="btn btn-info pull-right" style="border-radius: 8px; padding: 8px 20px; margin-left: 10px;">Login</button>
                        <a href="<?php echo site_url(); ?>/" class="btn btn-default pull-right" style="border-radius: 8px; padding: 8px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            🔙 Kembali ke Login Siswa
                        </a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </section>
</div>

<!-- Modal Proses -->
<div class="modal" id="modal-proses" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-body">
                Data Sedang diproses...
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script type="text/javascript">
    $(function () {
        $('#username').focus();

        $('#btn-login').click(function () {
            $('#form-login').submit();
        });

        $('#form-login').submit(function () {
            $("#modal-proses").modal('show');
            $.ajax({
                url: "<?php echo site_url(); ?>/manager/welcome/login",
                type: "POST",
                data: $('#form-login').serialize(),
                cache: false,
                success: function (respon) {
                    var obj = $.parseJSON(respon);
                    if (obj.status == 1) {
                        window.open("<?php echo site_url(); ?>/manager/dashboard", "_self");
                    } else {
                        $('#form-pesan').html(pesan_err(obj.error));
                        $("#modal-proses").modal('hide');
                    }
                }
            });

            return false;
        });
    });
</script>
