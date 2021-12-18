<?php
error_reporting(~E_NOTICE);
session_start();
include 'config.php';

include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/paging.php';
include 'includes/knn.php';

$mod = $_GET['m'];
$act = $_GET['act'];

$ATRIBUT = array();
$NILAI = array();
$DATASET = array();


/** =============== */
$ATRIBUT = array();
$TARGET = '';
$rows = $db->get_results("SELECT * FROM tb_atribut ORDER BY id_atribut");
foreach ($rows as $row) {
    $ATRIBUT[$row->id_atribut] = $row;
    $TARGET = $row->id_atribut;
}

$NILAI = array();
$ATRIBUT_NILAI = array();
$rows = $db->get_results("SELECT id_atribut, id_nilai, nama_nilai FROM tb_nilai ORDER BY id_nilai");
foreach ($rows as $row) {
    $NILAI[$row->id_nilai] = $row;
    $ATRIBUT_NILAI[$row->id_atribut][$row->id_nilai] = $row->nama_nilai;
}

function get_analisa($nd, $probabilitas, $selected)
{
    $arr = array();
    foreach ($nd as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $v;
        }
        if ($probabilitas) {
            foreach ($probabilitas[$key] as $k => $v) {
                $arr[$key][$k] = $v[$_POST['selected'][$k]];
            }
        }
    }
    //echo '<pre>'. print_r($arr, 1).'</pre>';
    return $arr;
}

function get_dataset()
{
    global $db;
    $arr = array();
    $rows = $db->get_results("SELECT * FROM tb_dataset ORDER BY nomor, id_atribut");
    foreach ($rows as $row) {
        $arr[$row->nomor][$row->id_atribut] = $row->id_nilai;
    }
    return $arr;
}

/** =============== */
function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $value) {
        $new[$key] = $no++;
    }
    return $new;
}

function get_atribut_option($selected = '')
{
    global $ATRIBUT;
    $a = '';
    foreach ($ATRIBUT as $key => $val) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>[$key] $val->nama_atribut</option>";
        else
            $a .= "<option value='$key'>[$key] $val->nama_atribut</option>";
    }
    return $a;
}

function get_nilai_option($id_atribut, $selected = '')
{
    global $NILAI;
    $a = '';
    foreach ($NILAI as $key => $val) {
        if ($val->id_atribut == $id_atribut) {
            if ($selected == $key)
                $a .= "<option value='$key' selected>$val->nama_nilai</option>";
            else
                $a .= "<option value='$key'>$val->nama_nilai</option>";
        }
    }
    return $a;
}

/*===GENERAL===*/
function get_words($str, $numb = 10, $suffix = '...')
{
    $str = strip_tags($str);
    $arr_str = explode(' ', $str, $numb + 1);
    if (count($arr_str) <= $numb) {
        return $str;
    } else {
        array_pop($arr_str);
        return implode(' ', $arr_str) . $suffix;
    }
}

function esc_field($str)
{
    return addslashes($str);
}

function get_option($option_name)
{
    global $db;
    return $db->get_var("SELECT option_value FROM tb_options WHERE option_name='$option_name'");
}

function update_option($option_name, $option_value)
{
    global $db;
    return $db->query("UPDATE tb_options SET option_value='$option_value' WHERE option_name='$option_name'");
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function get_jk_radio($selected)
{
    $array = array('Laki-laki', 'Perempuan');
    $a = '';
    foreach ($array as $arr) {
        if ($arr == $selected)
            $a .= "<label class='radio-inline'>
        <input type='radio' name='jk' value='$arr' checked> $arr
        </label>";
        else
            $a .= "<label class='radio-inline'>
        <input type='radio' name='jk' value='$arr'> $arr
        </label>";
    }
    return '<div class="radio">' . $a . '</div>';
}

function tgl_indo($date)
{
    $tanggal = explode('-', $date);

    $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $bulan = $array_bulan[$tanggal[1] * 1];

    return $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0];
}


/**
 * Menampilkan value dari variabel POST atau GET
 * @param string $key nama field atau variabel
 * @param string $default data asli jika null
 * @return string Isi variabel POST atau get
 */
function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}
