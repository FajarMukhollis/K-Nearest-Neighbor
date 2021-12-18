<?php
class KNN
{
	public $dataset; //dataset
	protected $target; //atribut target
	protected $nilai; //nilai setiap atribut
	protected $k_nearest; //nilai k nearest

	protected $nilai_konversi; //konversi atribut kategorikal menjadi nilai
	public $dataset_nilai; //hasil konversi dataset atribut kategorikal menjadi nilai
	protected $minmax; //nilai minimum dan maksimum atribut
	public $normal; //hasil normalisasi dataset
	public $jarak; //jarak (euclidean distance) data test dengan dataset
	public $nearest; //dataset yang terdekat sesuai jumlah k_nearest
	public $total; //total dataset berdasarkan klasifikasi
	public $hasil; //hasil klasifikasi

	function __construct($dataset, $target, $nilai, $k_nearest)
	{
		$this->dataset = $dataset;
		$this->target = $target;
		$this->nilai = $nilai;
		$this->k_nearest = $k_nearest;

		$this->dataset_nilai();
		$this->normal();
		$this->jarak();
		$this->nearest();
	}

	function normal()
	{
		$temp = array();
		//transpose matrik
		foreach ($this->dataset_nilai as $key => $val) {
			foreach ($val as $k => $v) {
				if ($k != $this->target) { //kecuali atribut target
					$temp[$k][$key] = $v;
				}
			}
		}
		foreach ($temp as $key => $val) {
			$this->minmax[$key]['max'] = max($val); //mencari nilai terbesar array
			$this->minmax[$key]['min'] = min($val); //mencari nilai terkecil array
		}
		$this->normal = $this->dataset_nilai;
		foreach ($this->normal as $key => $val) {
			foreach ($val as $k => $v) {
				if ($k !== $this->target)
					$this->normal[$key][$k] = $this->get_normal($v, $k);
			}
		}
	}
	function get_normal($v, $k)
	{
		//menghitung nilai normal semua atribut dengan teori min max
		//n = (v - min)/(max-min)
		return ($v - $this->minmax[$k]['min']) / ($this->minmax[$k]['max'] -  $this->minmax[$k]['min']);
	}
	function dataset_nilai()
	{
		global $ATRIBUT_NILAI;
		$this->nilai_konversi = array();
		foreach ($ATRIBUT_NILAI as $key => $val) {
			$no = 1;
			foreach ($val as $k => $v) {
				$this->nilai_konversi[$k] = $no; //memberikan nilai otomatis nilai atribut kategorikal dari 1, 2, 3, dst
				$no++;
			}
		}
		$this->dataset_nilai = array();
		foreach ($this->dataset as $key => $val) {
			foreach ($val as $k => $v) {
				//mengkonversi dataset kategorikal menjadi numerik kecuali atribut target
				$this->dataset_nilai[$key][$k] = ($k == $this->target || !$ATRIBUT_NILAI[$k]) ? $v :  $this->nilai_konversi[$v];
			}
		}
	}

	function nearest()
	{
		$no = 1;
		foreach ($this->jarak as $key => $val) {
			$this->nearest[] = $key;
			$this->total[$this->normal[$key][$this->target]]++;
			if ($no++ >= $this->k_nearest) //jika jumlah nearest sudah lebih dari nilai yang diinput, maka berhenti
				break;
		}
		arsort($this->total); //mengurutkan total dari terbesar ke terkecil (paling banyak)
		$this->hasil  = key($this->total); //hasil merupakan total terbanyak
	}

	function jarak()
	{
		$arr = array();
		//menormalkan nilai inputan user
		$nilai_normal = array();
		foreach ($this->nilai as $k => $v) {
			$v = $this->nilai_konversi[$v] ? $this->nilai_konversi[$v] : $v;
			$nilai_normal[$k] = $this->get_normal($v, $k);
		}

		//menghitung jarak euclidean distance
		foreach ($this->normal as $key => $val) {
			foreach ($val as $k => $v) {
				if ($k != $this->target) {
					$arr[$key] += pow($v - $nilai_normal[$k], 2); //mengkuadratkan
				}
			}
		}
		foreach ($arr as $key => $val) {
			$this->jarak[$key] = sqrt($val); //mengakarkan
		}
		//mengurutkan jarak dari terkecil ke terbesar
		asort($this->jarak);
	}
}
