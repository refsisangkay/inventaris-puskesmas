<?php

class Crud extends Mysql {
	public function test()
	{
		return "test";
	}

	public function login($username, $password) {

		$query = $this->query("select * from `pengguna` where `nama_pengguna`='$username' AND `sandi`='$password'");

		$cek = $this->row($query);

		if($cek->nama_pengguna == $username && $cek->sandi == $password){
			return true;
		}else {
			return false;
		}

	}

	public function getUserByUsername($username) {

		$query = $this->query("select * from `pengguna` where `nama_pengguna`='$username'");

		$cek = $this->row($query);

		if($query->num_rows>0){
			return $cek;
		}else {
			return "";
		}

	}

	public function getAlatByID($id)
	{
		return $this->query("select `alat_kesehatan`.*,`detail_alat`.* from `alat_kesehatan` join `detail_alat` on `detail_alat`.`id_alat`=`alat_kesehatan`.`id_alat` where `alat_kesehatan`.`id_alat`='$id'");
	}

	public function getAlatKesehatan()
	{
		return $this->query("select `alat_kesehatan`.*,`detail_alat`.* from `alat_kesehatan` join `detail_alat` on `detail_alat`.`id_alat`=`alat_kesehatan`.`id_alat`");
	}


public function cariAlatKesehatan($id)
	{
		return $this->query("select `alat_kesehatan`.*,`detail_alat`.* from `alat_kesehatan` join `detail_alat` on `detail_alat`.`id_alat`=`alat_kesehatan`.`id_alat` where `detail_alat`.`nama_alat` like '%$id%'");
	}


	public function getAlatMasuk() {

		return $this->query("SELECT `alat_masuk`.*,`transaksi`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_masuk` JOIN `transaksi` ON `transaksi`.`id_transaksi`=`alat_masuk`.`id_transaksi` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_masuk`.`id_alat`JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat`");

	}

	public function cariAlatMasuk($query) {

		return $this->query("SELECT `alat_masuk`.*,`transaksi`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_masuk` JOIN `transaksi` ON `transaksi`.`id_transaksi`=`alat_masuk`.`id_transaksi` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_masuk`.`id_alat` JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` WHERE `detail_alat`.`nama_alat` like '%$query%' OR `alat_kesehatan`.`id_alat` like '%$query%'");

	}

	public function getAlatKeluar() {

		return $this->query("SELECT `alat_keluar`.*,`transaksi`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_keluar` JOIN `transaksi` ON `transaksi`.`id_transaksi`=`alat_keluar`.`id_transaksi` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_keluar`.`id_alat` JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat`");

	}

	public function cariAlatKeluar($query) {

		return $this->query("SELECT `alat_keluar`.*,`transaksi`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_keluar` JOIN `transaksi` ON `transaksi`.`id_transaksi`=`alat_keluar`.`id_transaksi` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_keluar`.`id_alat` JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` WHERE `detail_alat`.`nama_alat` like '%$query%' OR `alat_kesehatan`.`id_alat` like '%$query%'");

	}

	public function getAlatRusak() {

		return $this->query("SELECT `alat_rusak`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_rusak` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_rusak`.`id_alat` JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat`");

	}

	public function cariAlatRusak($query) {

		return $this->query("SELECT `alat_rusak`.*,`alat_kesehatan`.*,`detail_alat`.* FROM `alat_rusak` JOIN `alat_kesehatan` ON `alat_kesehatan`.`id_alat`=`alat_rusak`.`id_alat` JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` WHERE `detail_alat`.`nama_alat` like '%$query%' OR `alat_kesehatan`.`id_alat` like '%$query%'");

	}

	public function getStokAlat() {

		return $this->query("SELECT `alat_kesehatan`.*,`alat_masuk`.*,`detail_alat`.*, sum(`alat_masuk`.`jumlah_masuk`) as `jumlah_awal` FROM `alat_kesehatan` JOIN `alat_masuk` On `alat_masuk`.`id_alat`=`alat_kesehatan`.`id_alat`JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` GROUP BY `detail_alat`.`id_alat`");

	}

	public function cariStokAlat($query) {

		return $this->query("SELECT `alat_kesehatan`.*,`alat_masuk`.*,`detail_alat`.*, sum(`alat_masuk`.`jumlah_masuk`) as `jumlah_awal` FROM `alat_kesehatan`JOIN `alat_masuk` On `alat_masuk`.`id_alat`=`alat_kesehatan`.`id_alat`JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` WHERE `detail_alat`.`nama_alat` like '%$query%' GROUP BY `detail_alat`.`id_alat`");

	}

	public function getStokAlatMenipis() {

		return $this->query("SELECT `alat_kesehatan`.*,`alat_masuk`.*,`detail_alat`.* FROM `alat_kesehatan` JOIN `alat_masuk` On `alat_masuk`.`id_alat`=`alat_kesehatan`.`id_alat`JOIN `detail_alat` ON `detail_alat`.`id_alat`= `alat_kesehatan`.`id_alat` WHERE `alat_kesehatan`.`stok_alat` <= 5 GROUP BY `detail_alat`.`id_alat`");

	}
}