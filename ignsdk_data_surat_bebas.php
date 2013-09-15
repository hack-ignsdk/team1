<?php 
	mysql_connect('localhost', 'root', '');
	mysql_select_db('tes');

	$nim = $_GET['nim'];

	$query_mahasiswa = mysql_query("SELECT * FROM member WHERE member_id='$nim'");
	$query_kepala = mysql_query("SELECT * FROM member WHERE member_type_id='2'");

	$query_library_name = mysql_query("SELECT setting_value WHERE setting_name='library_name'");
	$query_sub_library_name = mysql_query("SELECT setting_value WHERE setting_name='library_subname'");

	$mahasiswa = mysql_fetch_assoc($query_mahasiswa);
	$kepala = mysql_fetch_assoc($query_kepala);

	$library_name = mysql_result($query_library_name, 0);
	$list = explode('"', $library_name);
	$library_name = strtoupper($list(1));

	$sub_library_name = mysql_result($query_sub_library_name, 0);
	$list = explode('"', $sub_library_name);
	$sub_library_name = strtoupper($list(1));
?>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="qrc:///js/jquery.js"></script>
	<script type="text/javascript" src="qrc:///js/ign.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tahun').html((new Date).getFullYear());

			var d = new Date();
			var strDate = d.getDate() + " - " + (d.getMonth()+1) + " - " + d.getFullYear();

			$('#tanggal').html(strDate);

			$('#print').click(function(){
				window.print();
			});

			$('#kembali').click(function(){
				ign.back();
			});
		});
	</script>
	<style type="text/css">
		body{
			width: 21cm;
    		min-height: 29.7cm;
    		height: 29.7cm;
		}

		#header{
			min-height: 130px;
			border-bottom: solid 5px #000;
		}

		#header img{
			width:2.5cm;
			float:left;
		}

		#judul{
			text-align: center;
			padding-top: 15px;
		}

		#judul_atas{
			font-size: 20px;
		}

		#judul_tengah{
			font-size: 30px;
		}

		#judul_bawah{
			font-size: 25px;
		}

		#judul_konten{
			text-align: center;
			font-size: 25px;
			margin-top: 10px;
		}

		#nomor_surat{
			text-align: center;
			margin-bottom: 20px;
		}

		#kepala, #mahasiswa{
			padding-left: 30px;
			margin-bottom: 20px;
		}

		#konten{
			padding-left: 2cm;
			padding-right: 2cm;
		}

		#tanda_tangan{
			float: right;
			width: 8cm;
			margin-top: 40px;
		}

		#tanda_tangan img{
			height: 80px;
			margin-left: 100px;
		}

		#nama_kota{
			text-align: center;
		}

		#nama_kepala_perpus{
			font-weight: bold;
			text-decoration: underline;
		}

		#penandatangan{
			text-align: center;
		}

		label{
			width:60px;
			display: block;
			float: left;
		}
	</style>
	<style type="text/css" >
		@media print
		  {
		   #tombol
		   {
		   	display: none;
		   }
		  }
	</style>
</head>
<body>
	<div id="tombol">
		<input type="button" id="print" value="Cetak">
		<input type="button" id="kembali" value="Kembali">
	</div>	 
	<div id="header">
		<img src="images/logo.jpg">
		<div id="judul">
			<div id="judul_atas">KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</div>
			<div id="judul_tengah"><?php echo $library_name?></div>
			<div id="judul_bawah"><?php echo $sub_library_name?></div>
		</div>
	</div>
	<div id="konten">
		<div id="judul_konten">SURAT KERETANGAN BEBAS PUSTAKA</div>
		<div id="nomor_surat">Nomor : ......../......../<span id="tahun"></span></div>
		Yang bertanda tangan di bawah ini :<br>
		<div id="kepala">
			<label>Nama</label>: <span><?php echo $kepala['member_name']?></span><br>
			<label>NIP</label>: <span><?php echo $kepala['member_id']?></span><br>
			<label>Jabatan</label>: <span>Kepala Perpustakaan</span>
		</div>
		Dengan ini menerangkan bahwa : <br>
		<div id="mahasiswa">
			<label>Nama</label>: <span><?php echo $mahasiswa['member_name']?></span><br>
			<label>NIM</label>: <span><?php echo $mahasiswa['member_id']?></span><br>
			<label>Prodi</label>: <span><?php echo $mahasiswa['inst_name']?></span>
		</div>
		Adalah anggota <?php echo $library_name ?>, yang telah menyelesaikan hak dan kewajibannya terhadap perpustakaan. Yang bersangkutan telah mengembalikan semua peminjaman buku dan koleksi bahan perpustakaan lainnya serta telah menyelesaikan segala urusan yang berkaitan dengan <?php echo $library_name ?>. <br><br>
		Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya. 

		<div id="tanda_tangan">
			<div id="nama_kota">
				Yogyakarta, <span id="tanggal"></span><br>
				Kepala Perpustakaan <?php echo $library_name ?>
			</div>
				<img src="ttd.jpg">
			<div id="penandatangan">
				<span id="nama_kepala_perpus"><?php echo $kepala['member_name']?></span><br>
				NIP. <span id="nip_kepala"><?php echo $kepala['member_id']?></span>
			</div>
		</div>
	</div>
</body>
</html>