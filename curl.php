<?php 
	// Menarik data dari kawalcorona

	// Fungsi htt_request
	function http_request($url){
		//membuat curl
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		// aktifkan fungsi tranfer nilai string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		//Settting agar di localhost bisa jalan
		//mematikan ssl verify(https)
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// menampung nilai ke variabel

		$output = curl_exec($ch);

		// tutup curl
		curl_close($ch);

		// mengembalikan hasil curl
		return $output;
	}

	//memanggil fungsi http request(url)
	$data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");

	// ubah format ke Json
	$data = json_decode($data, TRUE);

	//tampung jumlah data
	$jumlah = count($data);

	$nomor = 1;
	for($i = 0; $i < $jumlah; $i++){
		$hasil = $data[$i]['attributes'];
?>
		<tr>
			<td><?=$nomor++ ?></td>
			<td><?=$hasil['Provinsi'] ?></td>
			<td><?=$hasil['Kasus_Posi'] ?></td>
			<td><?=$hasil['Kasus_Semb'] ?></td>
			<td><?=$hasil['Kasus_Meni'] ?></td>
		</tr>
	<?php 
	}
 ?>