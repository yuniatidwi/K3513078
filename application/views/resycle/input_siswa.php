<html>
	<head>
		<title>Input data</title>
	</head>
	<body>
		<h2>Input data</h2>
		<?php echo form_open('siswa/input');?>
		Nama : <?php echo form_input('nama');?><br>
		Alamat :<?php echo form_input('alamat');?><br>
		Jenis Kelamin :
		Laki - laki <?php echo form_radio('jenis_kelamin','L');?>
		Perempuan <?php echo form_radio('jenis_kelamin','P');?><br>
		Tanggal lahir :<?php echo form_input('tanggal_lahir');?><br>
		<?php echo form_submit('submit','submit')?>
		<?php echo form_close();?>
		<br>
		<?php
		if (!empty($submit) ) {
			echo "nama :".$nama."<br>";
			echo "alamat :".$alamat."<br>";
			echo "jenis_kelamin :".$jenis_kelamin."<br>";
			echo "tanggal lahir :".$tanggal_lahir."<br>";
		}?>
	</body>
</html>
