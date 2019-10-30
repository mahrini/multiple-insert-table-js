<?php
require_once('model/model.php');
$post = (object)$_POST;
$trx = trxORM::create();
$trx->noNota = $post->noNota;
$trx->jenis = $post->jenis;
$trx->supplier_id = $post->supplier;
$trx->tanggal = $post->tanggal;
$trx->save();
$trxId = $trx->id;

$r = json_decode($post->result, true);
foreach($r as $d) {
    
    $dtl = $trx->detail()->create();
    $dtl->trx_id = $trxId;
    $dtl->barang_id = $d['idBarang'];
    $dtl->qty = $d['qty'];
    $dtl->harga = $d['harga'];
    $dtl->save();
}
{
    header('location:index.php?msg=sukses');
}
