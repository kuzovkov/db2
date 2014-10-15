<?php
require_once('common.inc.php');
require_once('ImgUpload.php');

$id = ( isset( $_POST['id']) )? $_POST['id'] : 0;
$currRow = null;
$trend1 = ( isset( $_POST['trend1'] ) )? $_POST['trend1'] : 'ASC';
$field1 = ( isset($_POST['field1']))? $_POST['field1'] : 'id';
$search = ( isset($_POST['search']) && $_POST['search'] === 'true' )? true : false;
$filter1 = ( isset($_POST['filter1']))? $_POST['filter1'] : false;
$filter2 = ( isset($_POST['filter2']))? $_POST['filter2'] : false;


/*delete*/
if ( isset($_POST['del']) )
{
    $sql = "SELECT foto FROM passenger WHERE id=".$_POST['del'];
    $array = dbGetQueryResult($sql);
    $foto = $array[0]['foto'];
    ImgUpload::deleteImage(array('foto'=>$foto, 'id'=>$_POST['del']));
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

if ( $search && $filter1 && $filter2 )
{
    $sql = "SELECT * from passenger WHERE name LIKE '%". trim($filter1) . "%' AND lastname LIKE '%" . trim($filter2) ."%' ORDER BY ". $field1 . " " . $trend1;
}
elseif ( $search && $filter1 && !$filter2 )
{
    $sql = "SELECT * from passenger WHERE name LIKE '%". trim($filter1) . "%'  ORDER BY ". $field1 . " " . $trend1;
}
elseif ( $search && !$filter1 && $filter2 )
{
    $sql = "SELECT * from passenger WHERE lastname LIKE '%" . trim($filter2) ."%' ORDER BY ". $field1 . " " . $trend1;
}
else
{
    $sql = "SELECT * from passenger ORDER BY ". $field1 . " " . $trend1;
}

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

<?php 
    $present = false; 
    foreach ( $array1 as $row1 ) if( $id == $row1['id']) $present = true;
    if (!$present) $id = 0;    
?>

<?php foreach ( $array1 as $row1 ): if ( $id == 0 ) $id = $row1['id'];?>
    <tr <?php if($row1['id'] == $id) { echo 'class="active tbody"'; $currRow = $row1; }else {echo 'class="tbody"';}?> id="<?=$row1['id']?>">
    <?php foreach ( $row1 as $key => $col ): ?>
        <?php if(!in_array($key,$hidden)):?><td key="<?=$key?>"><?=$col?></td><?php endif; ?>
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
<h3>Фотография</h3>
<?php 
    $foto = '';
    foreach($array1 as $row1) if ( $row1['id'] == $id ) $foto = $row1['foto'];
    $src = ($foto != '')? 'thumbnail.80.'.$foto : 'default.gif';
?>

<img class="foto" src="img/foto/<?=$src?>"/>
<table class="table">
<tr>
<td>
<h3>Фильтр</h3>
<label>Имя</label>&nbsp;
<input type="text" id="filter1" value="<?=(isset($_POST['filter1']))? $_POST['filter1']: ''?>" size="50"/>&nbsp;&nbsp;
<label>Фамилия</label>&nbsp;
<input type="text" id="filter2" value="<?=(isset($_POST['filter2']))? $_POST['filter2']: ''?>" size="50"/>&nbsp;&nbsp;
<label>Включить фильтр</label>&nbsp;
 
<input type="checkbox" id="filter" <?php if($search):?>checked="checked"<?php endif;?>/>
</td>
</tr>
</table>

<script type="text/javascript">
    var trend1 = '<?=$trend1?>';
    var field1 = '<?=$field1?>';
    var rowId = '<?=$id?>';
    var search = <?php if($search): ?>true<?php else: ?>false<?php endif;?>;
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
<script type="text/javascript" src="js/passenger_edit.js"></script>
<script type="text/javascript" src="js/confirm.js"></script>

