<?php
    require_once('common.inc.php');
    
    $idFlight = ( isset($_POST['idFlight']) )? $_POST['idFlight'] : 0;
    $idPassenger = ( isset($_POST['idPassenger']) )? $_POST['idPassenger'] : 0;
    $trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
    $field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
    $date_dep = ( isset($_POST['date_dep']))? $_POST['date_dep'] : ''; 
    $search = ( isset($_POST['search']) && $_POST['search'] === 'true' )? true : false;
    $filter1 = ( isset($_POST['filter1']))? $_POST['filter1'] : false;
    $filter2 = ( isset($_POST['filter2']))? $_POST['filter2'] : false;
    
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
            <?php if(!in_array($key,$hidden)):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
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

<?php 
    $present = false; 
    foreach ( $array2 as $row2 ) if( $idFlight == $row2['id']) $present = true;
    if (!$present) $idFlight = 0;    
?>
<?php foreach ( $array2 as $row2 ): if ( $idFlight == 0 ) $idFlight = $row2['id'];?>
    <tr <?php if($row2['id'] == $idFlight) echo 'class="active"';?> id="<?=$row2['id']?>">
    <?php foreach ( $row2 as $key => $col ): ?>
        <?php if(!in_array($key,$hidden2)):?><td key="<?=$key?>"><?=$col?></td><?php endif;?>
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
    var search = <?php if($search): ?>true<?php else: ?>false<?php endif;?>;
    var args = {idFlight:idFlight,field1:field1, trend1:trend1, idPassenger:<?=$idPassenger?>,date_dep:date_dep};
    
    
    $('#ticket-flight-table tr').click(function(){
        args.idFlight = this.id;
        args.date_dep = $('#ticket-add-date').val();
        reloadPage();
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
        args.trend1 = ( args.trend1 == 'ASC' )? 'DESC' : 'ASC';
        args.field1 = this.id;
        args.date_dep = $('#ticket-add-date').val();
        reloadPage();
    });
    
    $('#filter').change(function(){
        search = ($(this).prop('checked'))? true:false;
        reloadPage();    
    });

    $('#filter1').change(function(){
        search = ($('#filter').prop('checked'))? true:false;
        if ( search ) reloadPage(); 
        
    });
    
    $('#filter2').change(function(){
        search = ($('#filter').prop('checked'))? true:false;
        if ( search ) reloadPage(); 
    });
    
    function reloadPage(){
        
        args.filter1 = $('#filter1').val();
        args.filter2 = $('#filter2').val();
        args.search = search; 
       
        $('#data').load('modules/ticket_edit_form.php',args);
    } 
</script>
