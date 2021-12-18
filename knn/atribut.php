<div class="page-header">
    <h1>Atribut</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="atribut" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=atribut_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Atribut</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_atribut WHERE nama_atribut LIKE '%$q%' ORDER BY id_atribut");
        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $row->id_atribut ?></td>
                <td><?= $row->nama_atribut ?></td>
                <td><?= $row->keterangan ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=atribut_ubah&ID=<?= $row->id_atribut ?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=atribut_hapus&ID=<?= $row->id_atribut ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>