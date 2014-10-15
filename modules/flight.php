<?php
require_once('common.inc.php');
//var_dump($_POST);
$id = ( isset( $_POST['id']) )? $_POST['id'] : 0;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$trend2 = ( isset( $_POST['trend2'] ) )? $_POST['trend2'] : 'ASC';
$field2 = ( isset($_POST['field2']))? $_POST['field2'] : 'id';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
$search = ( isset($_POST['search']) && $_POST['search'] === 'true' )? true : false;
$filter1 = ( isset($_POST['filter1']))? $_POST['filter1'] : false;
$filter2 = ( isset($_POST['filter2']))? $_POST['filter2'] : false;

if ( $search && $filter1 && $filter2 )
{
    $sql = "SELECT * from flight WHERE point_dep LIKE '%". trim($filter1) . "%' AND point_arr LIKE '%" . trim($filter2) ."%' ORDER BY ". $field1 . " " . $trend1;
}
elseif ( $search && $filter1 && !$filter2 )
{
    $sql = "SELECT * from flight WHERE point_dep LIKE '%". trim($filter1) . "%'  ORDER BY ". $field1 . " " . $trend1;
}
elseif ( $search && !$filter1 && $filter2 )
{
    $sql = "SELECT * from flight WHERE point_arr LIKE '%" . trim($filter2) ."%' ORDER BY ". $field1 . " " . $trend1;
}
else
{
    $sql = "SELECT * from flight ORDER BY ". $field1 . " " . $trend1;
}

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
<?php 
    $present = false; 
    foreach ( $array1 as $row1 ) if( $id == $row1['id']) $present = true;
    if (!$present) $id = 0;    
?>
<?php foreach ( $array1 as $row1 ): if ( $id == 0 ) $id = $row1['id'];?>
    <tr <?php if($row1['id'] == $id) echo 'class="tbody active"'; else echo 'class="tbody"';?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if(!in_array($key,$hidden)): ?><td key="<?=$key?>"><?=$col?></td> <?php endif;?>
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
    var rowId = '<?=$id?>';
    var search = <?php if($search): ?>true<?php else: ?>false<?php endif;?>;
    $(document).ready(function(){
        $('#flight-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
        $('#ticket-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
        
    });  
</script>


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
        <?php if(!in_array($key,$hidden)):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
</td>
</tr>
</table>
<table class="table">
<tr>
<td>
<h3>Фильтр</h3>
<label>Пункт вылета</label>&nbsp;
<input type="text" id="filter1" value="<?=(isset($_POST['filter1']))? $_POST['filter1']: ''?>" size="50"/>&nbsp;&nbsp;
<label>Пункт прилета</label>&nbsp;
<input type="text" id="filter2" value="<?=(isset($_POST['filter2']))? $_POST['filter2']: ''?>" size="50"/>&nbsp;&nbsp;
<label>Включить фильтр</label>&nbsp;
 
<input type="checkbox" id="filter" <?php if($search):?>checked="checked"<?php endif;?>/>
</td>
</tr>
</table>
<script type="text/javascript" src="js/flight.js"></script>