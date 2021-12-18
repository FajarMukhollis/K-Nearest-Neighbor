<?php
$nomor = $db->get_var("SELECT nomor FROM tb_dataset ORDER BY nomor DESC LIMIT 1") * 1 + 1;
?>
<div class="page-header">
    <h1>Tambah Dataset</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Nomor <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nomor" value="<?= set_value('nomor', $nomor) ?>" />
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input class="form-control" type="text" name="ket_dataset" value="<?= set_value('ket_dataset') ?>" />
            </div>
            <?php foreach ($ATRIBUT as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val->nama_atribut ?> <span class="text-danger">*</span></label>
                    <?php if ($ATRIBUT_NILAI[$key]) : ?>
                        <select class="form-control" name="nilai[<?= $key ?>]">
                            <option value="">&nbsp;</option>
                            <?= get_nilai_option($key, set_value($_POST['nilai'][$key])) ?>
                        </select>
                    <?php else : ?>
                        <input class="form-control" type="text" name="nilai[<?= $key ?>]" value="<?= $_POST['nilai'][$key] ?>" />
                    <?php endif ?>
                    <?php if ($val->keterangan) : ?>
                        <p class="help-block"><?= $val->keterangan ?></p>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=dataset"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>