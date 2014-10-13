<?php

require_once('db.func.php');

$id = ( isset( $_POST['id']) )? $_POST['id'] : 0;
$currRow = null;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';

/*delete*/
if ( isset($_POST['del']) )
{
    $sql = 'DELETE FROM passenger WHERE id='.$_POST['del'];
    dbQuery($sql);
    $sql = 'DELETE FROM ticket WHERE passenger='.$_POST['del'];
    dbQuery($sql);
}

/*add*/
if ( isset($_POST['add']) )
{
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $passport = $_POST['passport'];
    $sql = "INSERT INTO passenger ( name,lastname,sex,age,passport ) VALUES ('$name','$lastname','$sex','$age','$passport')";
    dbQuery($sql);
}

/*update*/

if ( isset($_POST['update']) )
{
    $passenger_id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $passport = $_POST['passport'];
    $sql = "UPDATE passenger SET name = $name, lastname = $lastname, sex = $sex, age=$age, passport=$passport WHERE id = $passenger_id";
    dbQuery($sql);
}

$sql = "SELECT * from passenger ORDER BY $field1 $trend1";
$array1 = dbGetQueryResult($sql);

?>

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
<table id="passenger-edit-table" class="table table-bordered table-hover">

<?php foreach ( $array1 as $row1 ): if ( $id == 0 ) $id = $row1['id'];?>
    <tr <?php if($row1['id'] == $id) { echo 'class="active tbody"'; $currRow = $row1; }else {echo 'class="tbody"';}?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if($key != 'id'):?><td key="<?=$key?>"><?=$col?></td><?php endif; ?>
    <?php endforeach;?>
    </tr>
<?php endforeach;?>

</table>
</div>
<p>
<hr />
<button id="btn-passenger-del">Удалить</button>
<button id="btn-passenger-edit">Редактировать</button>
<button id="btn-passenger-create">Новый</button>
</p>
</td>
</tr>
</table>
<script type="text/javascript" src="js/passenger_edit.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>
<script type="text/javascript">
    var trend1 = '<?=$trend1?>';
    var field1 = '<?=$field1?>';
    $('#btn-passenger-edit').click(function(){
        $('#data').load('modules/passenger_edit_form.php',{
            <?php foreach( $currRow as $key => $val ):?>
                <?=$key.':'."'".$val."'".','?>
            <?php endforeach;?>
        });
    });
    
    $(document).ready(function(){
            $('#passenger-edit-table tr:first td').each(function(){
                $('li#'+$(this).attr('key')).width($(this).innerWidth()-2).height(80);
            });
        }); 
</script>

