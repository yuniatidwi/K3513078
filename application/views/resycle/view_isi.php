<p><?php echo $title;?></p>
<p><?php echo $description;?></p>
<?php echo $keyword;?>
<table border="1px">
	<thead>
		<th>Id</th>
		<th>Nim</th>
		<th>Nama</th>
		<th>Jurusan</th>
		<th>Kelas</th>
	</thead>
	<tbody>
		<?php 
		foreach ($isi as $data) {
			echo '<tr><td>'.$data->id.'</td>';
			echo '<td>'.$data->username.'</td>';
			echo '<td>'.$data->kategori.'</td>';
			echo '<td>'.$data->nama.'</td>';
			echo '<td>'.$data->alamat.'</td></tr>';
		}
		?>
	</tbody>
	<br>{elapsed_time}
</table>
