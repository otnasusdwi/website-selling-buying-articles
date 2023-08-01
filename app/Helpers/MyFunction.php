<?php

function tgl_indo($booking_date){
	$timestamp = strtotime($booking_date);
	$tanggal = date("Y-m-d", $timestamp );
	$jam = date("H:i:s", $timestamp );
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0] . ' ' . $jam;
}

function format_uang($angka){ 
	$hasil =  number_format($angka,0, ',' , '.'); 
	return $hasil;
}

function pricing($angka){ 
	$hasil =  number_format($angka,0, ',' , ''); 
	return $hasil;
}

function numberInvoice($id, $tanggal) {
	$timestamp = strtotime($tanggal);
	$bulan = date("m", $timestamp );
	$year = date("Y", $timestamp );

	switch ($bulan) {
		case '1':
		$month = 'I';
		break;
		case '2':
		$month = 'II';
		break;
		case '3':
		$month = 'III';
		break;
		case '4':
		$month = 'IV';
		break;
		case '5':
		$month = 'V';
		break;
		case '6':
		$month = 'VI';
		break;
		case '7':
		$month = 'VII';
		break;
		case '8':
		$month = 'VIII';
		break;
		case '9':
		$month = 'IX';
		break;
		case '10':
		$month = 'X';
		break;
		case '11':
		$month = 'XI';
		break;
		default:
		$month = 'XII';
		break;
	}

	$number = $id."/Tulizin/".$month."/".$year;
	return $number;
}

function prosentase(){ 
	$prosentase = App\Models\Fee::pluck('prosentase')->first();
	if (isset($prosentase)) {
		return $prosentase / 100;
	}else{
		return 20 / 100;
	}
}

function profileTulizin(){
	$data = [
		"alamat" 	=> "Jl. Urip Sumoharjo No.65, Klitren, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55222",
		"email"		=> "finance@tulizin.com",
		"no_telp"	=> "08133322244"
	];

	return $data;
}



function checkAvailable($deadline)
{
	$now = date('Y-m-d H:i:s');
	$max = date('Y-m-d H:i:s', strtotime($deadline. ' - 2 days'));
	if ($now >= $max) {
		return 0;
	}else{
		return 1;
	}
}