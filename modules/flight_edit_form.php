<div class="wrap-form-div">
<table class="table">
<tr>
    <td colspan="2">
    <?php if ( isset($_POST['id']) ): ?>
        <h3>Редактирование рейса</h3>
    <?php else: ?>
        <h3>Создание рейса</h3>
    <?php endif; ?>
    </td>
</tr>

<tr>
    <td>
        <label>Время отправления: </label>
    <td>
        <input class="time" type="text" id="time_dep" value="<?=(isset($_POST['time_dep']))? $_POST['time_dep']:''?>"/><br />
    </td>
</tr>
<tr>
    <td>       
        <label>Время прибытия: </label>
    </td>
    <td>
        <input class="time" type="text" id="time_arr" value="<?=(isset($_POST['time_arr']))? $_POST['time_arr']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Пункт отправления: </label>
    </td>
    <td>
        <input class="city" type="text" id="point_dep" value="<?=(isset($_POST['point_dep']))? $_POST['point_dep']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Пункт прибытия: </label>
    </td>
    <td>
        <input class="city" type="text" id="point_arr" value="<?=(isset($_POST['point_arr']))? $_POST['point_arr']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Количество мест: </label>
    </td>
    <td>
        <input class="number" type="text" id="place" value="<?=(isset($_POST['place']))? $_POST['place']:''?>"/>
    </td>
</tr>
<tr>
    <td colspan="2">
        <?php if ( isset($_POST['id']) ): ?>
        <button id="btn-flight-update-ok">Сохранить</button>
        <script type="text/javascript">
            $('#btn-flight-update-ok').click(function(){
            if (!validate()) return false;
            var id = <?=$_POST['id']?>;
            var time_dep = "'"+$('#time_dep').val()+"'";
            var time_arr = "'"+$('#time_arr').val()+"'";
            var point_dep = "'"+$('#point_dep').val()+"'";
            var point_arr = "'"+$('#point_arr').val()+"'";
            var place = "'"+$('#place').val()+"'";
            
            var data = {update:'1',id:id,time_dep:time_dep,time_arr:time_arr,point_dep:point_dep,point_arr:point_arr,place:place};
            var object = JSON.stringify(data);
            var title = 'Сохранение изменений';
            var message = 'Принять изменения: ';
            message += '<br/>Время вылета: ' + time_dep;
            message += '<br/>Время прилета: ' + time_arr;
            message += '<br/>Пункт вылета: ' + point_dep;
            message += '<br/>Пункт прилета: ' + point_arr;
            message += '<br/>Количество мест: ' + place;
            var targetOk = 'modules/flight_edit.php';
            var targetCancel = 'modules/flight_edit.php';
            confirm(title, message, object, targetOk, targetCancel);
        });
        </script>
        <?php else: ?>
        <button id="btn-flight-create-ok">Добавить</button>
        <?php endif;?>
        <button id="btn-flight-new-cancel">Отмена</button>
    </td>
</tr>

</table>
</div>


<script type="text/javascript" src="js/flight_edit_form.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript" src="js/validation.js"></script> 
