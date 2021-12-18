<?php
$row = $db->get_row("SELECT * FROM tb_nilai WHERE id_nilai='$_GET[ID]'");
?>
<div class="page-header">
    <h1>Ubah Alternatif</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Atribut <span class="text-danger">*</span></label>
                <select class="form-control" name="id_atribut">
                    <option></option>
                    <?= get_atribut_option($row->id_atribut) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Nilai <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_nilai" value="<?= $row->nama_nilai ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=nilai"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>