<?php
$rows = $db->get_results("SELECT * FROM tb_dataset WHERE nomor='$_GET[ID]' ORDER BY id_atribut");
?>
<div class="page-header">
    <h1>Ubah Dataset</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Nomor <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nomor" value="<?= $_GET['ID'] ?>" readonly="" />
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input class="form-control" type="text" name="ket_dataset" value="<?= set_value('ket_dataset', $rows[0]->ket_dataset) ?>" />
            </div>
            <?php foreach ($rows as $row) : ?>
                <div class="form-group">
                    <label><?= $ATRIBUT[$row->id_atribut]->nama_atribut ?> <span class="text-danger">*</span></label>
                    <?php if ($ATRIBUT_NILAI[$row->id_atribut]) : ?>
                        <select class="form-control" name="nilai[<?= $row->id_dataset ?>]">
                            <option value="">&nbsp;</option>
                            <?= get_nilai_option($row->id_atribut, $row->id_nilai) ?>
                        </select>
                    <?php else : ?>
                        <input class="form-control" type="text" name="nilai[<?= $row->id_dataset ?>]" value="<?= $row->id_nilai ?>" />
                    <?php endif ?>
                    <?php if ($row->keterangan) : ?>
                        <p class="help-block"><?= $row->keterangan ?></p>
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