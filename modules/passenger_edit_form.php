<div class="wrap-form-div">
<table class="table">
<tr>
    <td colspan="2">
    <?php if ( isset($_POST['id']) ): ?>
        <h3>Редактирование данных пассажира</h3>
    <?php else: ?>
        <h3>Добавление пассажира</h3>
    <?php endif; ?>
    </td>
</tr>
<tr>
    <td>
        <label>Имя: </label>
    </td>
    <td>
        <input class="name" type="text" id="name" value="<?=(isset($_POST['name']))? $_POST['name']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Фамилия: </label>
    </td>
    <td>
        <input class="name" type="text" id="lastname" value="<?=(isset($_POST['lastname']))? $_POST['lastname']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Пол: </label>
    </td>
    <td>
    <select id="sex">
        <option  <?php if(isset($_POST['sex']) && $_POST['sex'] =='муж') echo 'selected';?> value="муж" >муж</option>
        <option <?php if(isset($_POST['sex']) && $_POST['sex'] =='жен') echo 'selected';?> value="жен"  >жен</option>
    </select>
    </td>
</tr>
<tr>
    <td>
        <label>Возраст: </label>
    </td>
    <td>
        <input class="number" type="text" id="age" value="<?=(isset($_POST['age']))? $_POST['age']:''?>"/>
    </td>
</tr>
<tr>
    <td>
        <label>Паспорт: </label>
    </td>
    <td>
        <input class="passport" type="text" id="passport" value="<?=(isset($_POST['passport']))? $_POST['passport']:''?>"/>
    </td>
</tr>
<tr>
    <td colspan="2">
        <?php if ( isset($_POST['id']) ): ?>
        <button id="btn-passenger-update-ok">Ok</button>
        <script type="text/javascript">
            $('#btn-passenger-update-ok').click(function(){
            if (!validate())return false;
            var id = <?=$_POST['id']?>;
            var name = "'"+$('#name').val()+"'";
            var lastname = "'"+$('#lastname').val()+"'";
            var sex = "'"+$('#sex').val()+"'";
            var age = "'"+$('#age').val()+"'";
            var passport = "'"+$('#passport').val()+"'";
            
            var data = {update:'1',id:id,name:name,lastname:lastname,sex:sex,age:age,passport:passport};
            var object = JSON.stringify(data);
            var title = 'Редактирование данных пассажира';
            var message = 'Принять следующие изменения: ';
            message += '<br/>Имя: ' + name;
            message += '<br/>Фамилия: ' + lastname;
            message += '<br/>Пол: ' + sex;
            message += '<br/>Возраст: ' + age;
            message += '<br/>Паспорт: ' + passport;
            var targetOk = 'modules/passenger_edit.php';
            var targetCancel = 'modules/passenger_edit.php';
            confirm(title, message, object, targetOk, targetCancel);
        });
        </script>
        <?php else: ?>
        <button id="btn-passenger-create-ok">Ok</button>
        <?php endif;?>
        <button id="btn-passenger-new-cancel">Отмена</button>
    </td>
</tr>
</table>
</div>


<script type="text/javascript" src="js/passenger_edit_form.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript" src="js/validation.js"></script> 
