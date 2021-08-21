<!doctype html>
<html lang="en">

<head>
    <title><?= $judul ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BUTGasgCVx-oE9Fj"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
            <h2> Pembelian </h2>
        </div>
    </div>
    <?= $this->session->flashdata('pesan') ?>
    <div class="row container mb-5">
        <?php foreach ($item as $it) : ?>
            <div class="col-sm-6 mb-2">
                <form id="payment-form" method="post" action="<?= site_url() ?>home/finish/<?= $it->id ?>">
                    <input type="hidden" name="result_type" id="result-type" value="">
                    <input type="hidden" name="result_data" id="result-data" value="">
                </form>
                <div class="card">
                    <div class="card-header text-center">
                        <?= $it->nama_items ?>
                    </div>
                    <div class="card-body text-center">
                        <img src="<?= base_url() ?>asset/gambar/<?= $it->gambar ?>" class="img-fluid " style="width: 5cm;" alt="">
                        <p class="card-text">Rp. <?= number_format($it->harga) ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        <button id="pay-button<?= $it->id ?>" type="submit" class=" btn btn-success">Beli</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="<?= $it->id ?>">
            <script type="text/javascript">
                $('#pay-button<?= $it->id ?>').click(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '<?= site_url() ?>home/token/<?= $it->id ?>',
                        cache: false,
                        success: function(data) {
                            //location = data;

                            console.log('token = ' + data);

                            var resultType = document.getElementById('result-type');
                            var resultData = document.getElementById('result-data');

                            var id = $("#id").val();
                            //   console.log(id);
                            function changeResult(type, data) {
                                $("#result-type").val(type);

                                // $("#id").val(JSON.stringify(<?= $it->id ?>));
                                $("#result-data").val(JSON.stringify(data));
                                //resultType.innerHTML = type;
                                //resultData.innerHTML = JSON.stringify(data);
                            }
                            snap.pay(data, {

                                onSuccess: function(result) {
                                    changeResult('success', result);
                                    console.log(result.status_message);
                                    console.log(result);
                                    $("#payment-form").submit();
                                },
                                onPending: function(result) {
                                    changeResult('pending', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                },
                                onError: function(result) {
                                    changeResult('error', result);
                                    console.log(result.status_message);
                                    $("#payment-form").submit();
                                }
                            });
                        }
                    });
                });
            </script>
        <?php endforeach ?>
    </div>

    </div>






    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



</body>

</html>