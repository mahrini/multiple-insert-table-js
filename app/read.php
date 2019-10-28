<?php
$post = (object)$_POST;
$r = json_decode($post->result, true);
var_dump($r);