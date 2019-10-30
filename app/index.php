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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<!-- SELECT 2 BS 4 -->
<link href="./assets/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="./assets/select2.bootstrap.css">
<body style="padding-top:10px;">
    <div class="card " style="width:60%;margin:0px auto;">
        <div class="card-header">
            <h2>Transaksi Pembelian</h2>
        </div>
        <div class="card-body">
        <?php
            if(isset($_GET['msg']))
            {
                if($_GET['msg'] == 'sukses')
                {   
                    echo "<div class='alert alert-success'>Sukses</div>";
                } else {
                    echo "<div class='alert alert-danger'>Gagal</div>";
                }
            }
            ?>
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="col-md-4">
                    <div class="form-group">
        <form action="read.php" method="POST">
                        <label>No.Nota</label>
                        <input type="text" placeholder="No.Nota" class="form-control" name="noNota"/>
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
                        <input type="text" id="tanggal" class="form-control" name="tanggal" data-input/>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4" style="padding-top:27px;">
                    <button type="button" data-toggle="modal" style="float:right;" class="btn btn-primary" data-target="#exampleModal">[+] Barang</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Data Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Barang</label>
                                            <select name="barang" id="barang" class="form-control">
                                            <?php
                                                $list = barangORM::find_many();
                                                foreach($list as $brg):
                                            ?>
                                                <option value="<?= $brg->id;?>"><?= $brg->nama;?></option>
                                                <?php endforeach;?>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Harga</label>
                                        <input type="text" name="harga" id="harga" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label>Qty</label>
                                        <input type="text" name="qty"
                                        id="qty" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="add();" data-dismiss="modal" id="save" >Save changes</button>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </div>
    &nbsp;
    <div class="card" style="width:60%;margin:0px auto;">
        <table id="table" class="table table-bordered text-center" style="width:80%;margin:0px auto;margin-top:10px;margin-bottom:10px;">
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
                
            </tbody>
        </table>
        <div class="form-inline" style="padding-left:405px;padding-bottom:10px;padding-top:30px;">
            <label style="font-size:20pt;">Subtotal : &nbsp;</label>
            <input id="subtotal" type="text" class="form-control" readonly style="width:50%;height:50px;font-size:20pt;text-align:right;">
        </div>
        <div style="padding-left:666px;padding-bottom:10px;">
        <!-- Result -->
        <input id="text" type="hidden" name="result" class="form-control">
            <button class="btn btn-primary" style="postition:relative;" type="submit">Bayar</button>
        </form>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./assets/select2.min.js"></script>
<script>
$(document).ready(()=>{
    $('select').select2({
        theme:'bootstrap4',
    });
    $('#barang').select2({
        theme:'bootstrap4',
        dropdownParent: $('#exampleModal'),        
    });
})
</script>
<script src="./assets/script.js"></script>
<!-- Date Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
$("#tanggal").flatpickr({
    dateFormat: "Y-m-d",
    maxDate: 'today',
});
</script>
</body>
</html>