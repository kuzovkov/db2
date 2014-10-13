<?php

    require_once('db.func.php');
    
    $idFlight = ( isset($_POST['idFlight']) )? $_POST['idFlight'] : 0;
    $idPassenger = ( isset($_POST['idPassenger']) )? $_POST['idPassenger'] : 0;
    $trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
    $field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
    $date_dep = ( isset($_POST['date_dep']))? $_POST['date_dep'] : ''; 
    $sql = 'SELECT * from passenger WHERE id='.$idPassenger;
    $array1 = dbGetQueryResult($sql);
   
    
?>
<table class="table">
<tr>
<td> 
    <h3>Пассажир</h3>
    <div class="wrap-table-div">
    <table id="passenger-ticket-table" class="table table-bordered table-striped">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Пол</th>
        <th>Возраст</th>
        <th>Паспорт</th>
    </tr>
    <?php foreach ( $array1 as $row1 ): if ( $idPassenger == 0 ) $idPassenger = $row1['id'];?>
        <tr>
        <?php foreach ( $row1 as $key => $col ): ?>
            <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
        <?php endforeach;?>
        </tr>
    <?php endforeach;?>

</table>
<table class="table">
<tr>
    <td>
        <label>Дата: </label>
    </td>
    <td>
        <input type="text" id="ticket-add-date"/>
    </td>
</tr>
<tr>
    <td colspan="2"><div id="date-error"></div></td>
</tr>
<tr>
    <td colspan="2">
        <button id="btn-ticket-add">Ok</button>
        <button id="btn-ticket-cancel">Отмена</button>
    </td>
</tr>
</table>

</div>
</td>

<?php
    $sql = "SELECT * FROM flight ORDER BY $field1 $trend1";
    $array2 = dbGetQueryResult($sql);
?>
<td>
<h3>Выбрать рейс</h3>
<ul class="head" id="head-flight">
    <li id="time_dep">Время вылета</li>
    <li id="time_arr">Время прилета</li>
    <li id="point_dep">Пункт отправления</li>
    <li id="point_arr">Пункт назначения</li>
</ul>
<div class="wrap-table-div">
<table id="ticket-flight-table" class="table table-bordered table-striped">

<?php foreach ( $array2 as $row2 ): if ( $idFlight == 0 ) $idFlight = $row2['id'];?>
    <tr <?php if($row2['id'] == $idFlight) echo 'class="active"';?> id="<?=$row2['id']?>">
    <?php foreach ( $row2 as $key => $col ): ?>
        <?php if($key != 'id' && $key != 'place'):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>

</td>
</tr>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ticket-add-date').datepicker();
        
        $('#ticket-add-date').datepicker("option","dateFormat","yy-mm-dd");
        $('#ticket-add-date').datepicker("setDate","<?=$date_dep?>");
    });
</script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript">
    var activeFlight = $('#ticket-flight-table tr.active');
    var idFlight = activeFlight.attr('id');
    var trend1 = '<?=$trend1?>';
    var field1 = '<?=$field1?>';
    var date_dep = '<?=$date_dep?>';

    $('#ticket-flight-table tr').click(function(){
        idFlight = this.id;
        date_dep = $('#ticket-add-date').val();
        $('#data').load('modules/ticket_edit_form.php',{idFlight:idFlight,field1:field1, trend1:trend1, idPassenger:<?=$idPassenger?>,date_dep:date_dep});
    });
    
    $('#btn-ticket-add').click(function(){
        var ticketDate = $('#ticket-add-date').val();
        if ( ticketDate == '' ) {
            $('#date-error').html('<span style="color: #f00">Укажите дату</span>');
            return false;
        }
        var time_dep, time_arr, point_dep, point_arr, date_dep,name,lastname;
        $('#passenger-ticket-table tr td').each(function(){
            switch( $(this).attr('key') ){
                case 'name':  name = $(this).text(); break;
                case 'lastname':  lastname = $(this).text(); break;
            };
        });
        
        $('#ticket-flight-table tr.active td').each(function(){
            switch( $(this).attr('key') ){
                case 'time_dep':  time_dep = $(this).text(); break;
                case 'time_arr':  time_arr = $(this).text(); break;
                case 'point_dep':  point_dep = $(this).text(); break;
                case 'point_arr':  point_arr = $(this).text(); break;
            };
        });
        date_dep = $('#ticket-add-date').val();
        var data = {add:'1',idPassenger:<?=$idPassenger?>,idFlight:idFlight,ticketDate:ticketDate};
        var object = JSON.stringify(data);
        var title = 'Оформление билета';
        var message = 'Оформить билет: ';
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
    
    $('#btn-ticket-cancel').click(function(){
        $('#data').load('modules/ticket_edit.php',{idPassenger:<?=$idPassenger?>});    
    });
    
    $(document).ready(function(){
        $('#ticket-flight-table tr:first td').each(function(){
            $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
        });
    });
    
    $('ul#head-flight li').click(function(){
        trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
        field1 = this.id;
        date_dep = $('#ticket-add-date').val();
        $('#data').load('modules/ticket_edit_form.php',{idFlight:idFlight, field1:field1, trend1:trend1, idPassenger:<?=$idPassenger?>,date_dep:date_dep });
        
    }); 
</script>
