<?php
$db=new PDO('mysql:host=localhost;dbname=reboisement;charset=UTF8','root','');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
$db->query("SET NAMES 'utf8', lc_time_names = 'fr_FR'");
