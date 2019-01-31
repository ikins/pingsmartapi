<?php
namespace common\components;
use yii\base\Component;

class AlgoFunction extends Component{
	
	function getTgl($day){
		$result=substr($day,8,2)."-".substr($day,5,2)."-".substr($day,0,4);
		return $result;
	}

	//return indonesian format from mysql date format
	//2014-01-03 --> 03/01/2014
	function normalize($day)
	{
		$result=substr($day,8,2)."/".substr($day,5,2)."/".substr($day,0,4);
		return $result;
	}
	
	//return indonesian format from mysql date format
	//2014-01-03 --> Minggu 03 Januari 2014
	function tglIndo($tgl){
		date_default_timezone_set("Asia/Jakarta");
		$date = date_create_from_format('Y-m-d H:i:s', $tgl);
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$hari = $array_hari[date_format($date,'N')];
		$tanggal = date_format($date,'j');
		$bulan = $array_bulan[date_format($date,'n')];
		$tahun = date_format($date,'Y');
		return "$hari, $tanggal $bulan $tahun";
		
	}

	//return indonesian detail format from mysql date format
	//2014-01-03 06:11:21 --> Minggu 03 Januari 2014 06:11
	function tglIndoDetail($tgl){
		date_default_timezone_set("Asia/Jakarta");
		$date = date_create_from_format('Y-m-d H:i:s', $tgl);
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$hari = $array_hari[date_format($date,'N')];
		$tanggal = date_format($date,'j');
		$bulan = $array_bulan[date_format($date,'n')];
		$tahun = date_format($date,'Y');
		return "$hari, $tanggal $bulan $tahun ".date_format($date,'H:i');
	}

	//return indonesian detail format from mysql date format
	//2014-01-03 06:11:21 --> 03 Januari 2014 06:11
	function tglIndoOnly($tgl){
		date_default_timezone_set("Asia/Jakarta");
		$date = date_create_from_format('Y-m-d H:i:s', $tgl);
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$tanggal = date_format($date,'j');
		$bulan = $array_bulan[date_format($date,'n')];
		$tahun = date_format($date,'Y');
		return "$tanggal $bulan $tahun ".date_format($date,'H:i');
	}

	//return indonesian detail format from mysql date format
	//2014-01-03 --> 03 Januari 2014
	function tglIndoNoTime($tgl){
		date_default_timezone_set("Asia/Jakarta");
		$date = date_create_from_format('Y-m-d', $tgl);
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$tanggal = date_format($date,'j');
		$bulan = $array_bulan[date_format($date,'n')];
		$tahun = date_format($date,'Y');
		return "$tanggal $bulan $tahun";
	}


	//return indonesian format from today date
	//2014-01-03 --> Minggu 03 Januari 2014
	function showToday(){
		date_default_timezone_set("Asia/Jakarta");
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$hari = $array_hari[date('N')];
		$tanggal = date('j');
		$bulan = $array_bulan[date('n')];
		$tahun = date('Y');
		return "$hari, $tanggal  $bulan  $tahun";
	}
	
	//create dinamyc splitter for div space
	function renderSplit($height){echo"<div id=\"split\" style=\"height:".$height."px;clear:both;\"></div>";}
	//create dinamyc separator
	function renderSep($height){echo"<div id=\"sep$height\" style=\"height:".$height."px;clear:both;border-bottom: 1px solid #eee;\"></div>";}
	function renderSepBot($top,$bottom){echo"<div id=\"sep$top\" style=\"height:".$top."px;clear:both;border-bottom: 1px solid #eee;margin-bottom:".$bottom."px;\"></div>";}
	function renderSplitNoMobile($height){echo"<div id=\"split\" style=\"height:".$height."px;clear:both;\" class=\"nomobile\"></div>";}

	function genSEO($text){
		$patterns = array(
			'/&/'             => 'dan',
			'/:/'			  => '',
			'/;/'			  => '',
			'/[^[:alpha:]]+/' => '_' // Anything *but* a character to underscore
			);
			return strtolower(preg_replace(array_keys($patterns), array_values($patterns), $text));
		}
		
	//create dual span in div element with simetrical divider
	function duoSpan($text){
		$str=substr($text,0,strlen($text)/2);
		$str2=substr($text,strlen($text)/2,strlen($text));
		return "$str<span class='blue'>$str2</span>";
		}


	/**
	 * trims text to a space then adds ellipses if desired
	 * @param string $input text to trim
	 * @param int $length in characters to trim to
	 * @param bool $ellipses if ellipses (...) are to be added
	 * @param bool $strip_html if html tags are to be stripped
	 * @return string
	 */	
	function trim_text($input, $length, $ellipses = true, $strip_html = true) {
		//strip tags, if desired
		if ($strip_html) {
			$input = strip_tags($input);
		}
	  
		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {
			return $input;
		}
	  
		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);
	  
		//add ellipses (...)
		if ($ellipses) {
			$trimmed_text .= '...';
		}
	  
		return $trimmed_text;
	}

	 function IndoCurr($number){
		return number_format($number, 2, ',', '.');
	 }
	function CreateMeta(){
		echo '
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="'.METADESC.'" />
		<meta name="keywords" content="'.METAKEY.'" />
		<meta name="author" content="'.METAAUTH.'"/>
		<meta name="copyright" content="'.METARIGHT.'"/>
		<link href="favicon.ico" rel="shortcut icon" />';
	}

	function ShowException($title,$contents){
		echo "<div class='alert alert-warning'>
				<strong>".$title."</strong><br/>".$contents."</div>";
		
	}

	function ModulDisabled(){
		if(isset($_SERVER['HTTP_REFERER'])){$back=$_SERVER['HTTP_REFERER'];}else{$back=URL;}
		echo "<title>Modul tidak aktif</title>
				<div class='page-wrapper'>
					<div class='container'>
						<ol class='breadcrumb'>
							<li><a href='<?php echo URL;?>/index.php'>Beranda</a></li>
							<li class='active'>Modul Not Active</li>
						</ol>
						<div class='row'>
							<div class='col-sm-12'>
								<div class='alert alert-warning'>Halaman yang Anda tuju belum diaktifkan. Silakan hubungi Administrator<br/><a href=". $back.">Kembali Ke Halaman Sebelumnya</a></div>
							</div>
						</div>
					</div>
				</div>";
	}

	function notifyError($title,$message){
		echo "<title>$title</title><div class='alert alert-warning'><h5>$title</h5>$message</div>";
	}

	function notifyDanger($title,$message){
		echo "<title>$title</title><div class='alert alert-danger'><h5>$title</h5>$message</div>";
	}

	function notifyInfo($title,$message){
		echo "<title>$title</title><div class='alert alert-info'><h5>$title</h5>$message</div>";
	}
	function notifySuccess($title,$message){
		echo "<title>$title</title><div class='alert alert-success'><h5>$title</h5>$message</div>";
	}

	function getMimeType($filename){
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$ext = strtolower($ext);
			$mime_types=array(
				"pdf" => "application/pdf",
				"txt" => "text/plain",
				"html" => "text/html",
				"htm" => "text/html",
				"exe" => "application/octet-stream",
				"zip" => "application/zip",
				"doc" => "application/msword",
				"xls" => "application/vnd.ms-excel",
				"ppt" => "application/vnd.ms-powerpoint",
				"gif" => "image/gif",
				"png" => "image/png",
				"jpeg"=> "image/jpg",
				"jpg" =>  "image/jpg",
				"php" => "text/plain",
				"csv" => "text/csv",
				"xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
				"pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
				"docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
			);

			if(isset($mime_types[$ext])){return $mime_types[$ext];} else {return 'application/octet-stream';}
		}
		
	function cleanFileName($rawname){
		$str=preg_replace('/\s+/', '_', $rawname);
		return preg_replace("([^\w\s\d\-_~,;:\[\]\(\).])", '', strtolower($str));
		
		//return	preg_replace("/[^a-z0-9\.]/",'', strtolower($rawname));
		
	}
	
	
}





?>