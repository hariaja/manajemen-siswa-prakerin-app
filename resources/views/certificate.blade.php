<!DOCTYPE html>
<html>
<head>
	<title>Sertifikat Seminar</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			text-align: center;
			background-color: #f5f5f5;
		}
		h1 {
			margin-top: 50px;
			font-size: 48px;
			color: #333;
		}
		p {
			margin-top: 20px;
			font-size: 24px;
			color: #666;
		}
		.certificate {
			margin: 50px auto;
			max-width: 800px;
			background-color: #fff;
			padding: 50px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
		}
		.signature {
			margin-top: 50px;
		}
		.border {
			border-top: 2px solid #333;
			margin-top: 50px;
			padding-top: 20px;
			font-size: 20px;
			color: #333;
		}
		.footer {
			margin-top: 50px;
			font-size: 16px;
			color: #666;
		}
		.logo {
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<div class="certificate">
		<img src="{{ asset('assets/images/polikami.png') }}" alt="Logo Seminar" class="logo">
		<h1>Sertifikat Seminar</h1>
		<p>Diberikan Kepada:</p>
		<p><strong>Nama Peserta</strong></p>
		<p>atas partisipasinya dalam seminar:</p>
		<p><strong>Judul Seminar</strong></p>
		<p>yang diadakan pada tanggal:</p>
		<p><strong>Tanggal Seminar</strong></p>
		<div class="signature">
			<p>Tanda Tangan Pemateri</p>
			<p>Nama Pemateri</p>
		</div>
		<div class="border">Sebagai tanda bukti partisipasi</div>
		<div class="footer">Sertifikat ini diterbitkan oleh <strong>Nama Penyelenggara Seminar</strong></div>
	</div>
</body>
</html>