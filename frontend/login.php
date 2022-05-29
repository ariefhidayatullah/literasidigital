<?php
session_start();

require 'function.php';
include 'include/_header.php';

$result1 = mysqli_query($conn, "SELECT * FROM user");

if (isset($_POST["register"])) {
	if (registrasi($_POST) === 0) {
		echo "<script> alert('Selamat bergabung, dan silahkan login terlebih dahulu');</script>";
	} else {
		echo mysqli_error($conn);
	}
}

if (isset($_POST["submit"])) {
	$email = $_POST["email"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
	$query = mysqli_num_rows($result);

	if ($query == 1) {
		$reesult = mysqli_query($conn, "SELECT * FROM user WHERE password='$password'");
		$queery = mysqli_num_rows($reesult);

		if ($queery == 1) {
			$row = mysqli_fetch_array($result);
			$_SESSION["LOGIN"] = $row['email'];
			echo "<script> alert(' anda berhasil login, selamata berbelanja !');</script>";
echo "<script> location='index';</script>";
		} else {
			echo "<script> alert('password salah!');</script>";
			echo "<script> location='login';</script>";
		}
	} else {
		echo "<script> alert('email tidak terdaftar !');</script>";
		echo "<script> location='login';</script>";
	}
}
?>


<div class="wrapper" id="wrapper">

	<?php include 'include/navbar.php'; ?>


	<div class="ht__bradcaump__area bg-image--1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="bradcaump__inner text-center">
						<h2 class="bradcaump-title">My Account</h2>
						<nav class="bradcaump-content">
							<a class="breadcrumb_item" href="index">Home</a>
							<span class="brd-separetor">/</span>
							<span class="breadcrumb_item active">My Account</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>


	<section class="my_account_area pt--80 pb--55 bg--white">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12">
					<div class="my__account__wrapper">
						<h3 class="account__title">Masuk</h3>
						<?php if (isset($error)) : ?>
							<p style="color : red; font-style:italic">
								username / password salah
							</p>
						<?php endif; ?>
						<form class="user" action="" method="POST">
							<div class="account__form">
								<div class="input__box">
									<label>Email address / Username<span>*</span></label>
									<input type="text" id="emaill" name="email" placeholder="Masukkan email atau username anda..." required="" autofocus>
								</div>
								<div class="input__box">
									<label>Password<span>*</span></label>
									<input type="password" id="passwordd" name="password" required placeholder="Masukkan password anda">
								</div>
								<div class="form__btn">
									<button type="submit" name="submit">Login</button>
								</div>
							</div>
						</form>
					</div>
					<div id="accordion" class="wn_accordion" role="tablist">
						<div class="card">
							<div class="acc-header" role="tab" id="headingOne">
								<h5>
									<a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">bagaimana cara mendaftar sebagai pelanggan?</a>
								</h5>
							</div>
							<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">dengan cara mengisi data diri di kanan yang bertuliskan registrasi</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="acc-header" role="tab" id="headingTwo">
							<h5>
								<a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
									bagaimana cara login ? </a>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">dengan mengisi data email dan password anda dengan benar </div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="my__account__wrapper">
						<h3 class="account__title">Registrasi</h3>
						<form action="" method="post">
							<div class="account__form space-between">
								<div class="datadiri">
									<div class="input__box">
										<label>nama : <span>*</span></label>
										<input type="text" name="nama_user" id="nama_user" placeholder="Masukkan nama anda..." autofocus>
										<small class="nama_user" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" name="email" id="email" placeholder="Masukkan email anda..." autofocus>
										<small class="email" style="color: red;"></small>
										<small class="email1 text-success"></small>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="password" id="password" placeholder="Masukkan password anda...">
										<small class="password" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label>konfirmasi Password <span>*</span></label>
										<input type="password" name="password2" id="password2" placeholder="konfirmasi password anda...">
										<small class="password2" style="color: red;"></small>
									</div>
									<div class="form__btn">
										<button class="selanjutnya" type="button">SELANJUTNYA</button>
									</div>
								</div>
								<div class="datauser">
									<div class="input__box">
										<label>no hp <span>*</span></label>
										<input type="text" name="nohp_user" id="nohp_user" placeholder="Masukkan no hp anda..." required="" maxlength="12" autofocus>
										<small class="nohp_user" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label for="alamat">Alamat <span>*</span></label>
										<input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat anda..." required="" autofocus>
										<small class="alamat" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label for="kodepos">Kode pos <span>*</span></label>
										<input type="text" name="kodepos" id="kodepos" placeholder="Masukkan kode pos anda..." required="" maxlength="12" autofocus>
										<small class="kodepos" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label>jenis kelamin <span>*</span></label>
										<input type="text" name="jenis_kelamin" id="jenis_kelamin" placeholder="Masukkan jenis kelamin anda..." required="" maxlength="12" autofocus>
										<small class="jenis_kelamin" style="color: red;"></small>
									</div>
									<div class="input__box">
										<label for="Provinsi">Provinsi <span>*</span></label>
										<select name="provinsi" id="provinsi" class="form-control" required></select>
									</div>
									<div class="input__box">
										<label for="kabupaten">Kabupaten <span>*</span></label>
										<select name="kabupaten" id="kabupaten" class="form-control" required></select>
									</div>
									<div class="input__box">
										<label for="kecamatan">Kecamatan <span>*</span></label>
										<select name="kecamatan" id="kecamatan" class="form-control" required></select>
									</div>
									<div class="form__btn">
										<button type="submit" name="register">Register</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$(document).ready(function() {
		$('.datauser').hide();
		// Validasi Nama Lengkap
		$('#nama_user').on('keyup', function() {
			var regex = /^[a-z A-Z]+$/;
			if (regex.test(this.value) !== true) {
				this.value = this.value.replace(/[^a-zA-Z]+/, '');
			} else if ($(this).val().length < 5) {
				$('.nama_user').text('Anda Yakin Nama Anda Terdiri Dari ' + $(this).val().length + ' Huruf?');
			} else {
				$('.nama_user').text('');
			}
			if ($(this).val().length == 0) {
				$('.nama_user').text('Nama Harus Di isi!');
			}
		});

		// validasi email
		$('#email').on('keyup', function() {
			var valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (!this.value.match(valid)) {
				$('.email').text('Isi Email dengan Benar!');
				email = false;
			}
			<?php foreach ($result1 as $pelanggan) : ?>
				else if ($(this).val() == "<?= $pelanggan['email']; ?>") {
					$('.email').text('Email Sudah Terdaftar!');
					$('.email1').text('');
					email = false;
				}
			<?php endforeach; ?>
			else {
				$('.email').text('');
				$('.email1').text('Email dapat digunakan');
				email = true;
			}
		});

		// validasi nohp
		$('#nohp_user').on('keyup', function() {
			var regex = /^[0-9]+$/;
			if (regex.test(this.value) !== true) {
				this.value = this.value.replace(/[^0-9]+/, '');
			} else {
				$('.nohp_user').text('');
			}

			if ($(this).val().length < 12) {
				$('.nohp_user').text('maksimal 12 angka!');
				nohp_user = false;
			} else {
				$('.nohp_user').text('');
				nohp_user = true;
			}

		});

		// validasi kata sandi
		$('#password').on('keyup', function() {
			var regex = /[a-z]/g;
			var upperCaseLetters = /[A-Z]/g;
			var numbers = /[0-9]/g;

			if ($(this).val().length < 8) {
				$('.password').text('Password Minimal 8 digit (huruf besar dan huruf kecil, dan angka)');
				password = false;
			} else {
				if (regex.test(this.value) !== true) {
					$('.password').text('Password harus berisi huruf kecil');
					password = false;
				} else {
					if (upperCaseLetters.test(this.value) !== true) {
						$('.password').text('Password harus berisi huruf besar');
						password = false;
					} else {
						if (numbers.test(this.value) !== true) {
							$('.password').text('Password harus berisi angka');
							password = false;
						} else {
							$('.password').text('');
							password = true;
						}
					}
				}
			}

		});
		$('#password2').on('keyup', function() {
			if ($(this).val() != $('#password').val()) {
				$('.password2').text('Password Tidak Sama');
				password2 = false;
			} else {
				$('.password2').text('');
				password2 = true;
			}
		});

		$('.selanjutnya').on('click', function() {
			if ($('#nama_user').val() === '') {
				$('.nama_user').text('Nama Harus Di isi!');
			} else if ($('#email').val() === '') {
				$('.email').text('Email Harus Di isi!');
			} else if (email == false) {
				$('.email').text('Isi Email dengan Benar!');
			} else if ($('#password').val() === '') {
				$('.password').text('Password Harus Di Isi!');
			} else if ($('#password2').val() === '') {
				$('.password2').text('Password Harus Di Isi!');
			} else if (password2 == false) {
				$('.password2').text('Password Harus sama');
			} else if (password == false) {
				$('.password1').text('Password Minimal 8 Digit (huruf besar dan huruf kecil, dan angka)');
			} else {
				$('.judul').text('Akun Masuk');
				$('.datadiri').hide();
				$('.datauser').show();
			}
		});

		// validasi kode pos
		$('#kodepos').on('keyup', function() {
			var regex = /^[0-9]+$/;
			if (regex.test(this.value) !== true) {
				this.value = this.value.replace(/[^0-9]+/, '');
			} else {
				$('.kodepos').text('');
			}

			if ($(this).val().length < 5) {
				$('.kodepos').text('minimal 5 angka!');
			} else {
				$('.kodepos').text('');
			}

		});


		// Validasi jenis kelamin
		$('#jenis_kelamin').on('keyup', function() {
			var regex = /^[L  P l  p]+$/;
			if (regex.test(this.value) !== true) {
				this.value = this.value.replace(/[^L P]+/, '');
			} else {
				$('.jenis_kelamin').text('');
			}
			if ($(this).val().length == 0) {
				$('.jenis_kelamin').text('laki laki (L) atau perempuan (P)!');
			}
		});


		$("#provinsi").append('<option value="">Pilih</option>');
		$("#kabupaten").html('');
		$("#kecamatan").html('');
		$("#kabupaten").append('<option value="">Pilih</option>');
		$("#kecamatan").append('<option value="">Pilih</option>');
		url = 'include/get_provinsi.php';
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(result) {
				for (var i = 0; i < result.length; i++)
					$("#provinsi").append('<option value="' + result[i].id_prov + '">' + result[
						i].nama_prov + '</option>');
			}
		});
	});
	$("#provinsi").change(function() {
		var id_prov = $("#provinsi").val();
		var url = 'include/get_kabupaten.php?id_prov=' + id_prov;
		$("#kabupaten").html('');
		$("#kecamatan").html('');
		$("#kabupaten").append('<option value="">Pilih</option>');
		$("#kecamatan").append('<option value="">Pilih</option>');
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(result) {
				for (var i = 0; i < result.length; i++)
					$("#kabupaten").append('<option value="' + result[i].id_kabkot + '">' + result[
						i].nama_kabkot + '</option>');
			}
		});
	});
	$("#kabupaten").change(function() {
		var id_kabkot = $("#kabupaten").val();
		var url = 'include/get_kecamatan.php?id_kabkot=' + id_kabkot;
		$("#kecamatan").html('');
		$("#kecamatan").append('<option value="">Pilih</option>');
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function(result) {
				for (var i = 0; i < result.length; i++)
					$("#kecamatan").append('<option value="' + result[i].id_kec + '">' + result[
						i].nama_kec + '</option>');
			}
		});

	});
</script>

<?php
include 'include/_footer.php';
?>