<!-- 
    --- TODO ---
    1. Add Modal / Pop up when + barang clicked
 -->
<?php 
    require_once('./model/model.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
</head>
<style>
</style>
<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
<!-- SELECT 2 BS 4 -->
<link href="./assets/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="./assets/select2.bootstrap.css">
<body style="padding-top:10px;">
    <div class="card " style="width:60%;margin:0px auto;">
        <div class="card-header">
            <h2>Transaksi Penjualan</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>No.Nota</label>
                        <input type="text" placeholder="No.Nota" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jenis</label>
                        <select class="form-control jenisTrx" name="jenis">
                            <option>Cash</option>
                            <option>Credit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                
                </div>
                <div class="col-md-4">
                    <div class="form-group supplier">
                        <label>Supplier</label>
                        <select class="form-control" name="supplier">
                            <?php
                                $list = supplierORM::find_many();
                                foreach($list as $sup):
                            ?>
                            <option value="<?= $sup->id;?>"><?= $sup->nama;?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4" style="padding-top:27px;">
                    <button style="float:right;" class="btn btn-primary">[+] Barang</button>
                </div>
            </div>
        </div>
    </div>
    &nbsp;
    <div class="card" style="width:60%;margin:0px auto;">
        <table class="table table-bordered text-center" style="width:80%;margin:0px auto;margin-top:10px;margin-bottom:10px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Parfume Romano</td>
                    <td>3</td>
                    <td>Rp. 10.000</td>
                    <td>RP. 30.000</td>
                    <td><button class="btn btn-danger">[-]Barang</button></td>
                </tr>
            </tbody>
        </table>
        <div class="form-inline" style="padding-left:405px;padding-bottom:10px;padding-top:30px;">
            <label style="font-size:20pt;">Subtotal : &nbsp;</label>
            <input type="text" class="form-control" value="Rp.120.000" readonly style="width:50%;height:50px;font-size:20pt;text-align:right;">
        </div>
        <div style="padding-left:666px;padding-bottom:10px;">
            <button class="btn btn-primary" style="postition:relative;">Bayar</button>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./assets/select2.min.js"></script>
<script>
$(document).ready(()=>{
    $('select').select2({
        theme:'bootstrap4',
    });
})
</script>
<script src="./assets/script.js"></script>
</body>
</html>