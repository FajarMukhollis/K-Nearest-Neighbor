<div class="page-header">
    <h1>Import Dataset</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data">
            <?php
            if ($_POST) {

                $row = 0;
                move_uploaded_file($_FILES['dataset']['tmp_name'], 'csv/' . $_FILES['dataset']['name']) or die('Upload gagal');

                $arr = array();
                $ket_dataset = array();

                if (($handle = fopen('csv/' . $_FILES['dataset']['name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $num = count($data);

                        if ($row > 0) {
                            for ($c = 2; $c < $num; $c++) {
                                $ket_dataset[$row] = $data[1];
                                $arr[$row][$c - 1] = $data[$c];
                            }
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                //echo '<pre>' . print_r($arr, 1) . '</pre>';
                function isi_key($dataset)
                {
                    global $ATRIBUT;
                    $keys = array_keys($ATRIBUT);
                    $arr = array();
                    foreach ($dataset as $key => $val) {
                        foreach ($val as $k => $v) {
                            $arr[$key][$keys[$k - 1]] = strtolower($v);
                        }
                    }

                    //echo '<pre>'.print_r($arr, 1).'</pre>'; 
                    return $arr;
                }

                function convert_dataset($dataset)
                {
                    $arr = array();
                    foreach ($dataset as $key => $val) {
                        foreach ($val as $k => $v) {
                            $arr[$key][$k] = get_id($k, $v);
                        }
                    }
                    //echo '<pre>'.print_r($arr, 1).'</pre>';   
                    return $arr;
                }

                function get_id($id_atribut, $nama_nilai)
                {
                    global $NILAI;
                    foreach ($NILAI as $key => $val) {
                        if ($val->id_atribut == $id_atribut && strtolower($val->nama_nilai) == $nama_nilai)
                            return $key;
                    }
                    return $nama_nilai;
                }

                function simpan_dt($dataset)
                {
                    global $db, $ket_dataset;
                    $db->query("TRUNCATE tb_dataset");
                    foreach ($dataset as $key => $val) {
                        foreach ($val as $k => $v) {
                            $db->query("INSERT INTO tb_dataset (nomor, ket_dataset, id_atribut, id_nilai)
                                VALUES ('$key', '{$ket_dataset[$key]}', '$k', '$v')");
                        }
                    }
                }
                $arr = isi_key($arr);
                $arr = convert_dataset($arr);
                simpan_dt($arr);

                print_msg('Dataset berhasil diimport!', 'success');
            }
            ?>
            <div class="form-group">
                <label>Pilih file</label>
                <input class="form-control" type="file" name="dataset" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="import"><span class="glyphicon glyphicon-import"></span> Import</button>
                <a class="btn btn-danger" href="?m=dataset"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>