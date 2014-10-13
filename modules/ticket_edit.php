<?php

require_once('db.func.php');

function checkDateTicket($date,$idFlight,$idPassenger,$title,$message,$target)
{
    $sql = "SELECT time_dep FROM flight WHERE id=$idFlight";
    $array = dbGetQueryResult($sql);
    $time = $array[0]['time_dep'];
    $ticketDate = new DateTime($date.' '.$time);
    $now = new DateTime();
    if ( $ticketDate < $now )
    {
        require_once('message.php');
        exit();
    } 
}

function checkPlaceExists($date,$idFlight,$idPassenger,$title,$message,$target)
{
    $sql = "SELECT COUNT(*) AS c FROM ticket WHERE date_dep='$date' AND flight_id=$idFlight";
    $array = dbGetQueryResult($sql);
    $ticketSell = $array[0]['c'];
    $sql = "SELECT place FROM flight WHERE id=$idFlight";
    $array = dbGetQueryResult($sql);
    $ticketAll = $array[0]['place'];
    if ( $ticketAll <= $ticketSell )
    {
        require_once('message.php');
        exit();
    }
}

function checkPassengerHasTicket($date,$idFlight,$idPassenger,$title,$message,$target)
{
    $sql = "SELECT COUNT(*) AS c FROM ticket WHERE date_dep='$date' AND flight_id=$idFlight AND passenger=$idPassenger";
    $array = dbGetQueryResult($sql);
    $tickets = $array[0]['c'];
    if ( $tickets > 0 )
    {
        require_once('message.php');
        exit();
    }
}   

$idPassenger = ( isset( $_POST['idPassenger']) )? $_POST['idPassenger'] : 0;
$idTicket = ( isset( $_POST['idTicket']) )? $_POST['idTicket'] : 0;
$currRow = null;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
$trend2 = ( isset( $_POST['trend2'] ) )? $_POST['trend2'] : 'ASC';
$field2 = ( isset($_POST['field2']))? $_POST['field2'] : 'id';


/*delete*/
if ( isset( $_POST['del']) )
{
    $sql = 'DELETE FROM ticket WHERE id='.$_POST['idTicket'];
    dbQuery($sql);
}

/*add*/
if ( isset( $_POST['add']) )
{
    $date = $_POST['ticketDate'];
    $idFlight = $_POST['idFlight'];
    checkDateTicket($date,$idFlight,$idPassenger,'Ошибка','Поезд ушел!','modules/ticket_edit_form.php');   
    checkPlaceExists($date,$idFlight,$idPassenger,'Ошибка','Нет мест на этот рейс','modules/ticket_edit_form.php');
    checkPassengerHasTicket($date,$idFlight,$idPassenger,'Ошибка','На этот рейс у этого пассажира есть билет!','modules/ticket_edit_form.php');
    $sql = "INSERT INTO ticket (flight_id,passenger,date_dep) VALUES ($idFlight, $idPassenger, '$date')";
    dbQuery($sql);
}

$sql = "SELECT * from passenger ORDER BY $field1 $trend1";
$array1 = dbGetQueryResult($sql);

?>
<h2>Оформление билетов</h2>
<table class="table">
<tr>
<td>

<h3>Пассажиры</h3>
<ul class="head" id="head-passenger">
    <li id="name">Имя</li>
    <li id="lastname">Фамилия</li>
    <li id="sex">Пол</li>
    <li id="age">Возраст</li>
    <li id="passport">Паспорт</li>
</ul>
<div class="wrap-table-div">
<table id="passenger-ticket-table" class="table table-bordered table-hover">

<?php foreach ( $array1 as $row1 ): if ( $idPassenger == 0 ) $idPassenger = $row1['id'];?>
    <tr <?php if($row1['id'] == $idPassenger) { echo 'class="active"'; $currRow = $row1; }?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
</td>
<?php 
    $sql = "SELECT ticket.id,ticket.date_dep,flight.time_dep,flight.time_arr,flight.point_dep, flight.point_arr FROM ticket, flight WHERE ticket.passenger=$idPassenger AND ticket.flight_id=flight.id ORDER BY $field2 $trend2";
    $array2 = dbGetQueryResult($sql);
?>

<td>
<h3>Билеты у данного человека</h3>
<ul class="head" id="head-flight">
    <li id="date_dep">Дата вылета</li>
    <li id="time_dep">Время вылета</li>
    <li id="time_arr">Время прилета</li>
    <li id="point_dep">Пункт отправления</li>
    <li id="point_arr">Пункт назначения</li>
</ul>
<div class="wrap-table-div">
<table id="ticket-edit-table" class="table table-bordered table-striped">

<?php foreach ( $array2 as $row2 ): if ( $idTicket == 0 ) $idTicket = $row2['id'];?>
    <tr <?php if($row2['id'] == $idTicket)  echo 'class="active"';?> id="<?=$row2['id']?>">
    <?php foreach ( $row2 as $key => $col ): ?>
        <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
<p>
<hr />
<button id="btn-ticket-add">Оформить билет</button>
<button id="btn-ticket-del">Сдать билет</button>
</p>


</td>
</tr>
</table>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript">
    var activePassenger = $('#passenger-ticket-table tr.active');
    var idPassenger = activePassenger.attr('id');
    var activeTicket = $('#ticket-edit-table tr.active');
    var idTicket = activeTicket.attr('id');
    
    var trend1 = '<?=$trend1?>';
    var field1 = '<?=$field1?>';
    var trend2 = '<?=$trend2?>';
    var field2 = '<?=$field2?>';
    var idTicket = '<?=$idTicket?>';
    var idPassenger = '<?=$idPassenger?>';
    
    $('#passenger-ticket-table tr').click(function(){
        idPassenger = this.id;
        idTicket = 0;
        $('#data').load('modules/ticket_edit.php',{idTicket:idTicket,idPassenger:idPassenger,field1:field1, field2:field2,trend1:trend1,trend2:trend2});
    });
    
    
    $('#ticket-edit-table tr').click(function(){
        idTicket = this.id;
        $('#data').load('modules/ticket_edit.php',{idTicket:idTicket,idPassenger:idPassenger,field1:field1, field2:field2,trend1:trend1,trend2:trend2});
    });
    
    $('#btn-ticket-del').click(function(){
        var time_dep, time_arr, point_dep, point_arr, date_dep,name,lastname;
        $('#passenger-ticket-table tr.active td').each(function(){
            switch( $(this).attr('key') ){
                case 'name':  name = $(this).text(); break;
                case 'lastname':  lastname = $(this).text(); break;
            };
        });
        
        $('#ticket-edit-table tr.active td').each(function(){
            switch( $(this).attr('key') ){
                case 'time_dep':  time_dep = $(this).text(); break;
                case 'time_arr':  time_arr = $(this).text(); break;
                case 'point_dep':  point_dep = $(this).text(); break;
                case 'point_arr':  point_arr = $(this).text(); break;
                case 'date_dep':  date_dep = $(this).text(); break;
            };
        });
        var data = {del:'1', idTicket:idTicket,idPassenger:idPassenger};
        var object = JSON.stringify(data);
        var title = 'Сдать билет';
        var message = 'Сдать билет: ';
        message += '<br/>Имя: ' + name;
        message += '<br/>Фамилия: ' + lastname;
        message += '<br/>Дата вылета: ' + date_dep;
        message += '<br/>Время вылета: ' + time_dep;
        message += '<br/>Время прилета: ' + time_arr;
        message += '<br/>Пункт вылета: ' + point_dep;
        message += '<br/>Пункт прилета: ' + point_arr;
        var targetOk = 'modules/ticket_edit.php';
        var targetCancel = 'modules/ticket_edit.php';
        confirm(title, message, object, targetOk, targetCancel);
    });
    
    $('#btn-ticket-add').click(function(){
        $('#data').load('modules/ticket_edit_form.php',{idPassenger:idPassenger});
    });
    
    $(document).ready(function(){
        $('#passenger-ticket-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
        $('#ticket-edit-table tr:first td').each(function(){
                $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
    });
    
    $('ul#head-flight li').click(function(){
        trend2 = ( trend2 == 'ASC' )? 'DESC' : 'ASC';
        field2 = this.id;
        $('#data').load('modules/ticket_edit.php',{id:id, field1:field1, field2:field2,trend1:trend1,trend2:trend2, idTicket:idTicket, idPassenger:idPassenger});
        
    });
    
    $('ul#head-passenger li').click(function(){
    trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
    field1 = this.id;
    $('#data').load('modules/ticket_edit.php',{id:id, field1:field1, field2:field2,trend1:trend1,trend2:trend2, idTicket:idTicket, idPassenger:idPassenger});
    
}); 
    
</script>

