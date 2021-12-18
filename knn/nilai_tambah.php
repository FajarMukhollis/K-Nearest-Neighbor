<div class="page-header">
    <h1>Tambah Nilai Atribut</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post" action="?m=nilai_tambah">
            <div class="form-group">
                <label>Atribut <span class="text-danger">*</span></label>
                <select class="form-control" name="id_atribut">
                    <option></option>
                    <?= get_atribut_option($_POST['id_atribut']) ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Nilai <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama_nilai" value="<?= $_POST['nama_nilai'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=nilai"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>