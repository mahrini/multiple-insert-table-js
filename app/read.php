<?php
$post = (object)$_POST;
$r = json_decode($post->result);
var_dump($r);