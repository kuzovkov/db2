<?php

require_once('db.func.php');

$id = ( isset( $_POST['id']) )? $_POST['id'] : 0;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$trend2 = ( isset( $_POST['trend2'] ) )? $_POST['trend2'] : 'ASC';
$field2 = ( isset($_POST['field2']))? $_POST['field2'] : 'id';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
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

<table id="flight-table" class="table table-bordered table-hover">

<?php foreach ( $array1 as $row1 ): if ( $id == 0 ) $id = $row1['id'];?>
    <tr <?php if($row1['id'] == $id) echo 'class="tbody active"'; else echo 'class="tbody"';?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if( $key != 'id' ): ?><td key="<?=$key?>"><?=$col?></td> <?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
</td>

<script type="text/javascript">
    var trend1 = '<?=$trend1?>';
    var trend2 = '<?=$trend2?>';
    var field1 = '<?=$field1?>';
    var field2 = '<?=$field2?>';
    $(document).ready(function(){
        $('#flight-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
        $('#ticket-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
        
    });  
</script>
<script type="text/javascript" src="js/flight.js"></script>

<?php 
   $sql = "SELECT ticket.id,ticket.date_dep,passenger.name,passenger.lastname,passenger.sex, passenger.age,passenger.passport FROM passenger, ticket WHERE ticket.flight_id=$id AND ticket.passenger=passenger.id ORDER BY $field2 $trend2";
   $array2 = dbGetQueryResult($sql);
?>
<td>
<h3>Билеты</h3>
<ul class="head" id="head-ticket">
    <li id="date_dep">Дата вылета</li>
    <li id="name">Имя</li>
    <li id="lastname">Фамилия</li>
    <li id="sex">Пол</li>
    <li id="age">Возр.</li>
    <li id="passport">Паспорт</li>
</ul>
<div class="wrap-table-div">
<table id="ticket-table" class="table table-bordered">

<?php foreach ( $array2 as $row2 ): ?>
    <tr class="tbody">
    <?php foreach ( $row2 as $key => $col ): ?>
        <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
</td>
</tr>
</table>