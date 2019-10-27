<?php
$content = $_POST['result'];
$data = json_decode($content, true);

foreach($data as $r) {
    echo $r['email'];
}
?>