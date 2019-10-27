<?php
require_once('/opt/lampp/htdocs/trx/app/config/config.php');

class trxORM extends Model {
    public static $_table = 'trx';

    public function detail(){
        return $this->has_many('detailTrxORM');
    }
}
class supplierORM extends Model {
    public static $_table = 'supplier';

    public function detail(){
        return $this->has_many('detailTrxORM');
    }
}
class barangORM extends Model {
    public static $_table = 'barang';

    public function detail(){
        return $this->has_many('detailTrxORM');
    }
}
class detailTrxORM extends Model {
    public static $_table = 'detailTrx';

    public function trx(){
        return $this->belongs_to('trxORM');
    }
    public function supplier(){
        return $this->belongs_to('supplierORM');
    }
    public function barang(){
        return $this->belongs_to('barangORM');
    }
}
?>