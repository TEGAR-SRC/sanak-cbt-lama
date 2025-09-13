<div class="container">
    
<!-- Bagian Header Bersih -->
<section class="custom-header">
  <div class="header-box">
    <div class="header-content">
      <div class="title-group">
        <h2 class="main-title">L-SCHOOL CBT SYSTEM</h2>
        <span class="sub-title">Ujian Online Berbasis AI Protection</span>
        <br><strong class="desc-title">WARNING !...... </strong>
        <br><strong class="desc-title">SYSTEM AUTO LOGOUT/BLOCKED</strong>
        <p>Apabila peserta keluar dari halaman ujian yang sedang berlangsung dan pastikan perangkat anda tidak terhubung dengan aplikasi AI (Chat GPT) untuk menghindari sistem pemblokiran akses ujian</p>
      </div>
      <div class="breadcrumb-group">
        <ul class="breadcrumb">
          <li><i class="fa fa-home"></i> Home</li>
          <li>Selamat Datang</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<style>
/* Bersihkan background luar */
.custom-header {
  padding: 0;
  background: none;
  display: flex;
  justify-content: center;
}

/* Hanya kotak putih dengan rounded dan shadow */
.header-box {
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
  padding: 24px 30px;
  width: 100%;
  max-width: 1200px;
  margin: 20px;
}

/* Konten dalam box */
.header-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
}

.title-group {
  max-width: 70%;
}
.main-title {
  font-size: 24px;
  font-weight: bold;
  color: #0073b7;
  margin: 0;
}
.sub-title {
  font-size: 16px;
  color: #888;
  margin-top: 4px;
  display: block;
}
.desc-title {
  font-size: 14px;
  color: #555;
  margin-top: 8px;
}

/* Breadcrumb */
.breadcrumb-group {
  text-align: right;
}
.breadcrumb {
  list-style: none;
  padding: 0;
  margin: 0;
}
.breadcrumb li {
  display: inline-block;
  font-size: 14px;
  color: #888;
  margin-left: 6px;
}
.breadcrumb li:first-child {
  color: #333;
}
.breadcrumb li::before {
  content: "/";
  margin: 0 6px;
  color: #ccc;
}
.breadcrumb li:first-child::before {
  content: none;
}

/* Responsif */
@media screen and (max-width: 768px) {
  .header-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 20px;
  }
  .title-group {
    max-width: 100%;
  }
  .breadcrumb-group {
    text-align: left;
    width: 100%;
  }
}
</style>


  <!-- Main content -->
  <section class="content">
    <?php echo form_open('welcome/login', 'id="form-login" class="form-horizontal"'); ?>

    <!-- LOGIN CARD -->
    <div class="row" style="display: flex; justify-content: center; align-items: center; min-height: 80vh; margin: 0; padding-top: 30px;">
      <div class="login-box" style="
        background: #fff;
        padding: 40px 30px;
        border-radius: 24px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 420px;
        text-align: center;
      ">

        <!-- Logo Besar -->
        <div style="margin-bottom: 18px;">
          <?php
            // $login_logo diset dari controller (Welcome@index) jika tersedia
            $logo_src = !empty($login_logo) ? base_url($login_logo) : 'https://cbt1.edupus.id/edupus.jpg';
          ?>
          <img src="<?php echo $logo_src; ?>" alt="Logo" style="max-width: 180px; height: auto;">
        </div>

        <!-- Judul Login (restore simpler card heading for visibility) -->
        <div style="background:#f9f9f9; padding:14px; margin-bottom:25px; box-shadow:0 4px 12px rgba(0,0,0,0.06); border-radius:16px;">
          <h3 style="margin:0; font-weight:600; font-size:24px; color:#2b5f56; letter-spacing:.5px;">Login Siswa</h3>
        </div>

        <!-- Deskripsi -->
        <p style="margin-bottom: 18px; color: #444; font-size: 15px;">
          Masukkan Username dan Password
        </p>

        <!-- Input Username -->
        <div style="margin-bottom: 18px;">
          <input type="text" id="username" name="username" class="form-control" placeholder="Username"
            style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1px solid #ccc; font-size: 15px;">
        </div>

        <!-- Input Password -->
        <div style="margin-bottom: 18px;">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password"
            style="width: 100%; padding: 12px 14px; border-radius: 12px; border: 1px solid #ccc; font-size: 15px;">
        </div>

        <!-- Show Password -->
        <div style="text-align: left; margin-bottom: 24px;">
          <label style="font-size: 14px;">
            <input type="checkbox" id="show-password"> Tampilkan Password
          </label>
        </div>

        <!-- Tombol Login -->
        <div style="margin-bottom: 20px;">
          <button type="submit" class="btn btn-primary btn-block"
            style="width: 100%; padding: 12px; border-radius: 12px; background-color: #CD5656; border: none; font-size: 16px;">
            Login
          </button>
        </div>

        <!-- Info Box -->
        <div class="callout login-info" style="border-radius:14px; padding:18px 20px; margin-bottom:26px;">
          <h4 style="margin:0 0 4px 0; font-weight:600;">Informasi</h4>
          <p style="margin:0; font-size:14px;">Jika ada kendala hubungi Operator</p>
        </div>

  <!-- (Divider removed to simplify and improve focus on buttons) -->

        <div class="operator-box" style="background:#FFFFFF; padding:22px 26px 26px; border-radius:20px; box-shadow:0 8px 22px rgba(0,0,0,0.06); text-align:center; width:100%;">
          <h5 style="margin:0 0 18px 0; font-weight:600; font-size:20px; color:#2b5f56;">Login Operator</h5>
          <a href="<?php echo site_url(); ?>/manager/" class="btn btn-primary" style="padding:10px 26px; border-radius:30px; font-size:15px;">
            👨‍💻 Masuk Sebagai Operator
          </a>
        </div>
      </div>
    </div>
    </form>
  </section>

</div>


<!-- SCRIPT LOGIN -->
<script type="text/javascript">
  function showpassword() {
    var x = document.getElementById("password");
    x.type = (x.type === "password") ? "text" : "password";
  }

  $(function () {
    $('#username').focus();

    $('#show-password').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    $('#show-password').on('ifChanged', function () {
      showpassword();
    });

    $('#form-login').submit(function () {
      $("#modal-proses").modal('show');
      $.ajax({
        url: "<?php echo site_url(); ?>/welcome/login",
        type: "POST",
        data: $('#form-login').serialize(),
        cache: false,
        success: function (respon) {
          var obj = $.parseJSON(respon);
          if (obj.status == 1) {
            window.open("<?php echo site_url(); ?>/tes_dashboard", "_self");
          } else {
            $('#form-pesan').html(pesan_err(obj.error));
            $("#modal-proses").modal('hide');
            $('#username').focus();
          }
        }
      });

      return false;
    });
  });
</script>
