<div class="page-header">
    <h1>Dataset</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="dataset" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=dataset_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
            <div class="form-group">
                <a class="btn btn-info" href="?m=dataset_import"><span class="glyphicon glyphicon-import"></span> Import</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="nw">
                    <th>Nomor</th>
                    <th>Nama Lengkap</th>
                    <?php foreach ($ATRIBUT as $key => $val) : ?>
                        <th><?= $val->nama_atribut ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_dataset WHERE ket_dataset LIKE '%$q%' GROUP BY nomor ASC");
            $dataset = get_dataset();

            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->nomor ?></td>
                    <td><?= $row->ket_dataset ?></td>
                    <?php foreach ($dataset[$row->nomor] as $k => $v) : ?>
                        <td><?= $ATRIBUT_NILAI[$k] ? $NILAI[$v]->nama_nilai : $v ?></td>
                    <?php endforeach ?>
                    <td class="nw">
                        <a class="btn btn-xs btn-warning" href="?m=dataset_ubah&ID=<?= $row->nomor ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=dataset_hapus&ID=<?= $row->nomor ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>