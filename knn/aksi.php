<?php
require_once 'functions.php';

if ($mod == 'login') {
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if ($row) {
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
} elseif ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}

/** DATASET */
if (isset($_POST['sort'])) {
    
}
elseif ($mod == 'dataset_tambah') {
    $nomor = $_POST['nomor'];
    $ket_dataset = $_POST['ket_dataset'];

    $error = false;
    foreach ($_POST['nilai'] as $key => $val) {
        if (!$val)
            $error = true;
    }

    if ($error) {
        print_msg("Field yang bertanda * tidak boleh kosong!");
    } elseif ($db->get_row("SELECT * FROM tb_dataset WHERE nomor='$nomor'")) {
        print_msg("Nomor sudah ada");
    } else {
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("INSERT INTO tb_dataset (nomor, ket_dataset, id_atribut, id_nilai) VALUES ('$nomor', '$ket_dataset', '$key', '$val')");
        }
        redirect_js("index.php?m=dataset");
    }
} else if ($mod == 'dataset_ubah') {
    $ket_dataset = $_POST['ket_dataset'];
    $error = false;
    foreach ($_POST['nilai'] as $key => $val) {
        if (!$val)
            $error = true;
    }

    if ($error) {
        print_msg("Field yang bertanda * tidak boleh kosong!");
    } else {
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("UPDATE tb_dataset SET ket_dataset='$ket_dataset', id_nilai='$val' WHERE id_dataset='$key'");
        }
        redirect_js("index.php?m=dataset");
    }
} else if ($act == 'dataset_hapus') {
    $db->query("DELETE FROM tb_dataset WHERE nomor='$_GET[ID]'");
    header("location:index.php?m=dataset");
}

/** NILAI ATRIBUT */
elseif ($mod == 'nilai_tambah') {
    $id_atribut = $_POST['id_atribut'];
    $nama_nilai = $_POST['nama_nilai'];

    if (!$id_atribut || !$nama_nilai)
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("INSERT INTO tb_nilai (id_atribut, nama_nilai) VALUES ('$id_atribut', '$nama_nilai')");
        redirect_js("index.php?m=nilai");
    }
} else if ($mod == 'nilai_ubah') {
    $id_atribut = $_POST['id_atribut'];
    $nama_nilai = $_POST['nama_nilai'];

    if (!$id_atribut || !$nama_nilai)
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_nilai SET id_atribut='$id_atribut', nama_nilai='$nama_nilai' WHERE id_nilai='$_GET[ID]'");
        redirect_js("index.php?m=nilai");
    }
} else if ($act == 'nilai_hapus') {
    $db->query("DELETE FROM tb_nilai WHERE id_nilai='$_GET[ID]'");
    header("location:index.php?m=nilai");
}

/** PENYAKIT */
// elseif ($mod == 'penyakit_tambah') {
//     $id_nilai = $_POST['id_nilai'];
//     $definisi = $_POST['definisi'];
//     $pencegahan = $_POST['pencegahan'];
//     $solusi = $_POST['solusi'];

//     if (!$id_nilai)
//         print_msg("Field yang bertanda * tidak boleh kosong!");
//     elseif ($db->get_row("SELECT * FROM tb_penyakit WHERE id_nilai='$id_nilai'")) {
//         print_msg("Penyakit sudah ada");
//     } else {
//         $db->query("INSERT INTO tb_penyakit (id_nilai, definisi, pencegahan, solusi) 
//             VALUES ('$id_nilai', '$definisi', '$pencegahan', '$solusi')");
//         redirect_js("index.php?m=penyakit");
//     }
// } else if ($mod == 'penyakit_ubah') {
//     $id_nilai = $_POST['id_nilai'];
//     $definisi = $_POST['definisi'];
//     $pencegahan = $_POST['pencegahan'];
//     $solusi = $_POST['solusi'];

//     if (!$id_nilai)
//         print_msg("Field yang bertanda * tidak boleh kosong!");
//     elseif ($db->get_row("SELECT * FROM tb_penyakit WHERE id_nilai='$id_nilai' AND id_penyakit<>'$_GET[ID]'")) {
//         print_msg("Penyakit sudah ada");
//     } else {
//         $db->query("UPDATE tb_penyakit SET id_nilai='$id_nilai', definisi='$definisi', pencegahan='$pencegahan', solusi='$solusi' 
//             WHERE id_penyakit='$_GET[ID]'");
//         redirect_js("index.php?m=penyakit");
//     }
// } else if ($act == 'penyakit_hapus') {
//     $db->query("DELETE FROM tb_penyakit WHERE id_penyakit='$_GET[ID]'");
//     header("location:index.php?m=penyakit");
// }

/** ATRIBUT */
if ($mod == 'atribut_tambah') {
    $id_atribut = $_POST['id_atribut'];
    $nama_atribut = $_POST['nama_atribut'];
    $keterangan = $_POST['keterangan'];

    if (!$id_atribut || !$nama_atribut)
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_atribut WHERE id_atribut='$id_atribut'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_atribut (id_atribut, nama_atribut, keterangan) 
            VALUES ('$id_atribut', '$nama_atribut', '$keterangan')");
        $db->query("INSERT INTO tb_dataset (nomor, id_atribut) SELECT nomor, '$id_atribut' FROM tb_dataset GROUP BY nomor");
        redirect_js("index.php?m=atribut");
    }
} else if ($mod == 'atribut_ubah') {
    $id_atribut = $_POST['id_atribut'];
    $nama_atribut = $_POST['nama_atribut'];
    $keterangan = $_POST['keterangan'];

    if (!$id_atribut || !$nama_atribut)
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_atribut SET nama_atribut='$nama_atribut', keterangan='$keterangan' WHERE id_atribut='$_GET[ID]'");
        redirect_js("index.php?m=atribut");
    }
} else if ($act == 'atribut_hapus') {
    $db->query("DELETE FROM tb_atribut WHERE id_atribut='$_GET[ID]'");
    $db->query("DELETE FROM tb_nilai WHERE id_atribut='$_GET[ID]'");
    $db->query("DELETE FROM tb_dataset WHERE id_atribut='$_GET[ID]'");
    header("location:index.php?m=atribut");
}

/*Sorting */
