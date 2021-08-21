<!doctype html>
<html lang="en">

<head>
    <title><?= $judul ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-primary">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="<?= base_url() ?>home">Item <span class="visually-hidden">(current)</span></a>
            <a class="nav-item nav-link" href="<?= base_url() ?>home/pembelian">Pembelian</a>
            <a class="nav-item nav-link" href="<?= base_url() ?>home/laporan">Laporan</a>
        </div>
    </nav>


    <div class="row container">
        <div class="col mb-3 mt-3">
            <h2> Items </h2>
            <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>home/tambahData" role="button">Tambah Data</a>
        </div>
    </div>
    <?= $this->session->flashdata('pesan') ?>
    <div class="row container mb-5">
        <div class="col-6">
            <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
                <thead class="thead-inverse|thead-default">
                    <tr>
                        <th>#</th>
                        <th>Nama Item</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($item as $item) : ?>
                        <tr>
                            <td scope="row"><?= ++$i ?></td>
                            <td><?= $item->nama_items ?></td>
                            <td>Rp. <?= number_Format($item->harga) ?></td>
                            <td>
                                <img src="<?= base_url() ?>asset/gambar/<?= $item->gambar ?>" class="img-fluid" alt="">
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="<?= base_url() ?>home/ubah/<?= $item->id ?>" role="button">
                                    Ubah
                                </a>
                                <a name="" id="" class="btn btn-danger" href="<?= base_url() ?>home/hapus/<?= $item->id ?>" role="button">
                                    Hapus
                                </a>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
    </div>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>