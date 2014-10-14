<?php
require_once('db.func.php');
require_once('ImgUpload.php');


if (isset($_POST['id']) && isset($_POST['op']) && $_POST['op'] == 'upload')
{
    $passenger_id = $_POST['id'];
    $sql = "SELECT foto FROM passenger WHERE id = $passenger_id";
    $array = dbGetQueryResult($sql);
    $_POST['foto'] = $array[0]['foto'];
    ImgUpload::deleteImage($_POST);
    $foto = ImgUpload::uploadImage($_POST);
    $sql = "UPDATE passenger SET foto = '$foto' WHERE id = $passenger_id";
    dbQuery($sql);
    $_POST['foto'] = $foto;
}

if (isset($_POST['id']) && isset($_POST['op']) && $_POST['op'] == 'delete')
{
    $passenger_id = $_POST['id'];
    $sql = "SELECT foto FROM passenger WHERE id = $passenger_id";
    $array = dbGetQueryResult($sql);
    $_POST['foto'] = $array[0]['foto'];
    ImgUpload::deleteImage($_POST);
    $foto = '';
    $sql = "UPDATE passenger SET foto = '$foto' WHERE id = $passenger_id";
    dbQuery($sql);
    $_POST['foto'] = $foto;
}

$qs = ''; foreach( $_POST as $key => $val ) $qs .= $key.'='.$val.'&';
$qs .= 'from=edit';

header('Location: '.Setting::BASE_URL.'?'.$qs);

?>

 



