<?php

require_once('db.func.php');

$id = ( isset( $_POST['id']) )? $_POST['id'] : 0;
$currRow = null;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';


/*delete*/
if ( isset($_POST['del']) )
{
    $sql = 'DELETE FROM flight WHERE id='.$_POST['del'];
    dbQuery($sql);
    $sql = 'DELETE FROM ticket WHERE flight_id='.$_POST['del'];
    dbQuery($sql);
}

/*add*/
if ( isset($_POST['add']) )
{
    $time_dep = $_POST['time_dep'];
    $time_arr = $_POST['time_arr'];
    $point_dep = $_POST['point_dep'];
    $point_arr = $_POST['point_arr'];
    $place = $_POST['place'];
    $sql = "INSERT INTO flight ( time_dep,time_arr,point_dep,point_arr,place ) VALUES ('$time_dep','$time_arr','$point_dep','$point_arr',$place)";
    dbQuery($sql);
}

/*update*/

if ( isset($_POST['update']) )
{
    $flight_id = $_POST['id'];
    $time_dep = $_POST['time_dep'];
    $time_arr = $_POST['time_arr'];
    $point_dep = $_POST['point_dep'];
    $point_arr = $_POST['point_arr'];
    $place = $_POST['place'];
    $sql = "UPDATE flight SET time_dep = $time_dep, time_arr = $time_arr, point_dep = $point_dep, point_arr=$point_arr, place=$place WHERE id = $flight_id";
    dbQuery($sql);
}

$sql = 'SELECT * from flight ORDER BY '. $field1 . ' ' . $trend1;
$array1 = dbGetQueryResult($sql);

?>
<table class="table">
<tr>
<td>
<h3>Рейсы</h3>
<ul class="head" id="head-flight">
    <li id="time_dep">Время вылета</li>
    <li id="time_arr">Время прилета</li>
    <li id="point_dep">Пункт отправления</li>
    <li id="point_arr">Пункт назначения</li>
    <li id="place">Кол-во мест</li>
</ul>
<div class="wrap-table-div">
<table id="flight-edit-table" class="table table-bordered table-hover">

<?php foreach ( $array1 as $row1 ): if ( $id == 0 ) $id = $row1['id'];?>
    <tr <?php if($row1['id'] == $id) { echo 'class="active tbody"'; $currRow = $row1; }else{echo 'class="tbody"';}?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
<p>
<hr />
<button id="btn-flight-del">Удалить</button>
<button id="btn-flight-edit">Редактировать</button>
<button id="btn-flight-create">Новый</button>
</p>
</td>
</tr>
</table>
<script type="text/javascript" src="js/flight_edit.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript">
    var trend1 = '<?=$trend1?>';
    var field1 = '<?=$field1?>';
   
    $('#btn-flight-edit').click(function(){
        $('#data').load('modules/flight_edit_form.php',{
            <?php foreach( $currRow as $key => $val ):?>
                <?=$key.':'."'".$val."'".','?>
            <?php endforeach;?>
        });
    });
    $(document).ready(function(){
        $('#flight-edit-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
    }); 
    

</script>