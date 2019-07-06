<?php 

	function PopulateForm()
	{

		$CI = &get_instance();

		$post = array();

		foreach(array_keys($_POST) as $key){

			$post[$key] = $CI->input->post($key);

		}
		if ($post == '' or is_null($post)) {
			return 'NULL';
		} else {
			return $post;
		}

	}

	function get_prodi($kd)
	{
		$CI = &get_instance();
		$CI->dbsia = $CI->load->database('sia', TRUE);
		$a = $CI->dbsia->query("SELECT prodi from tbl_jurusan_prodi where kd_prodi = '".$kd."'")->row()->prodi;
		return $a;
	}
	
	function getuker($kd)
	{
		$CI =& get_instance();

		$uk = $CI->db->query("SELECT unit_kerja from tb_ukerja where kd_ukerja = '".$kd."'")->row()->unit_kerja;
		return $uk;
	}

	function get_barang($kd)
	{
		$CI =& get_instance();

		$uk = $CI->db->query("SELECT nm_barang from tb_barang where kd_barang = '".$kd."'")->row()->nm_barang;
		return $uk;
	}

	function getName($u)
	{
		$CI = &get_instance();
		$usr = $CI->db->where('userid', $u)->get('tbl_regist')->row();
		if ($usr->nm_belakang == '' || is_null($usr->nm_belakang)) {
            $nav_name = $usr->nm_depan;
        } else {
            $nav_name = $usr->nm_depan.' '.$usr->nm_belakang;
        }
        return $nav_name;
	}

	function datestrip($date)
	{
		$tahun = substr($date,0,4);
		$bulan = substr($date,4,2);
		$hari = substr($date,6,2);
		return $tahun . '-' . $bulan . '-' . $hari;
	}
	function dateIdn($date)
	{
		$BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 	$split = explode('-', $date);
		return $split[2] . ' ' . $BulanIndo[ (int)$split[1] ] . ' ' . $split[0];
	}
	function datenoSpace($date)
	{
		$BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 	$split = explode('-', $date);
		return $split[0] . '' . $split[1] . '' . $split[2];
	}
	function datetimeIdn($date)
	{
		$BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 	$split = explode(' ', $date);
	 	$spli = explode('-', $split[0]);
		return  $split[1] . ' / ' . $spli[2] . ' ' . $BulanIndo[ (int)$spli[1] ] . ' ' . $spli[0];
	}

	function dateRmw($date)
	{
		$BulanIndo = array("","I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
	 	$split = explode('-', $date);
		return $split[2] . ' ' . $BulanIndo[ (int)$split[1] ] . ' ' . $split[0];
	}

	function getEmail($u)
	{
		$CI = &get_instance();
		$cek = $CI->db->where('userid',$u)->get('tbl_regist')->row()->email;
		return $cek;
	}

	function complete($tbl,$fld,$key,$fldcom,$keycom)
	{
		$CI = &get_instance();
		$cek = $CI->db->where($fld, $key)->where($fldcom, $keycom)->get($tbl)->num_rows();
		if ($cek > 0) {
			$res = 'Lengkap';
		} else {
			$res = 'Belum Lengkap';
		}
		return $res;
	}

	function getCamp($c)
	{
		if ($c == 'bks') {
			$camp = 'BEKASI';
		} else {
			$camp = 'JAKARTA';
		}
		return $camp;
	}


	function programType($p)
	{
		if ($p == '1') {
			$pro = 'Strata satu';
		} else {
			$pro = 'Strata dua';
		}
		return $pro;
	}

	function alasan($s)
	{
		if ($s == 'DBS') {
			$pro = 'Distribusi DBS';
		} elseif ($s == 'KLINIK') {
			$pro = 'Distribusi Klinik Swasta';
		} elseif ($s == 'PLKB') {
			$pro = 'Distribusi UPTD PLKB';
		} elseif ($s == 'PUSKEC') {
			$pro = 'Distribusi Puskesmas Kecamatan';
		} elseif ($s == 'PUSKEL') {
			$pro = 'Distribusi Puskesmas Kelurahan';
		} elseif ($s == 'RSP') {
			$pro = 'Distribusi Rumah Sakit Pemerintah';
		} elseif ($s == 'RSS') {
			$pro = 'Distribusi Rumah Sakit Swasta';
		} elseif ($s == 'IKB') {
			$pro = 'Distribusi Institusi KB';
		} elseif ($s == 'RSK') {
			$pro = 'Rusak';
		} else {
			$pro = '-';
		}
		return $pro;
	}
	
	function statND($nd)
	{
		if ($nd == null) {
			$pro = 'Menunggu Pengajuan';
		} elseif ($nd == '1') {
			$pro = 'Menunggu Persetujuan';
		} elseif ($nd == '11') {
			$pro = 'Menunggu Revisi';
		} elseif ($nd == '2') {
			$pro = 'Sudah Disetujui';
		}
		return $pro;
	}

	function myUrlEncode($string)
	{
	    $entities = array('%21','%20', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	    $replacements = array('!',' ', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
	    return str_replace($entities, $replacements, urlencode($string));
	}

	function myEncode($e,$type)
	{
		$en = array('0','1','2','3','4','5','6','7','8','9');
		$re = array('N','o','P','L','B','l','m','X','y','z');
		if ($type) {
			return str_replace($en, $re, $e);
		} elseif (!$type) {
			return str_replace($re, $en, $e);
		}
	}

	function validHumas($u,$t)
	{
		$CI = &get_instance();
		$val = $CI->db->select('valid')->from('tbl_file')->where('userid',$u)->where('tipe',$t)->get();

		if ($val->result() == TRUE) {
			if ($val->row()->valid == 1) {
				$prt = 'Sesuai';
			} elseif ($val->row()->valid == 0) {
				$prt = 'Tidak Sesuai';
			} elseif ($val->row()->valid == 2) {
				$prt = 'Belum Divalidasi';
			}
			return $prt;
		} else {
			$prt = '-';
			return $prt;
		}
	}

	function debug($value='')
	{
		echo "<pre>";
		print_r($value);
		die();
	}
 ?>