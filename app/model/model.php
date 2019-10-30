<?php
require_once('/opt/lampp/htdocs/trx/app/config/config.php');

class trxORM extends Model {
    public static $_table = 'trx';

    public function detail(){
        return $this->has_many('detailTrxORM');
    }
    public function supplier(){
        return $this->belongs_to('supplierORM');
    }
}
class supplierORM extends Model {
    public static $_table = 'supplier';

    public function trx(){
        return $this->has_one('trxORM');
    }
}
class barangORM extends Model {
    public static $_table = 'barang';

    public function detail(){
        return $this->has_many('detailTrxORM');
    }
}
class detailTrxORM extends Model {
    public static $_table = 'detail_trx';

    public function trx(){
        return $this->belongs_to('trxORM');
    }
    public function barang(){
        return $this->belongs_to('barangORM');
    }
}
?>