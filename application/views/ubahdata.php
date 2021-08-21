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
            <h2> Form Tambah Data </h2>
        </div>
    </div>
    <form action="<?= base_url() ?>home/aksiubah" enctype="multipart/form-data" method="post">
        <?php foreach ($item as $it) : ?>
            <input type="hidden" name="id" value="<?= $it->id ?>">
            <div class="row container mb-5">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Item</label>
                        <input type="text" value="<?= $it->nama_items ?>" class="form-control" required name="nama_item" id="" aria-describedby="helpId" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Harga</label>
                        <input type="number" value="<?= $it->harga ?>" class="form-control" required name="harga" id="" aria-describedby="helpId" placeholder="">
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-5">
                        <label for="" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="" aria-describedby="helpId" placeholder="">
                        <img src="<?= base_url() ?>asset/gambar/<?= $it->gambar ?>" alt="" style="width: 10cm;" srcset="">
                    </div>
                    <div class="mb-5">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </form>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>