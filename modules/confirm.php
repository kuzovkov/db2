<?php

$message = isset( $_POST['message'] )? $_POST['message'] : '';
$title = isset( $_POST['title'] )? $_POST['title'] : '';
$targetOk = isset( $_POST['targetOk'] )? $_POST['targetOk'] : '/';
$targetCancel = isset( $_POST['targetCancel'] )? $_POST['targetCancel'] : '/';
$object = isset( $_POST['object'] )? $_POST['object'] : '{}';

?>


<div id="dialog-confirm" title="<?=$title?>">
  <p>
  <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
  </span><?=$message?></p>
</div>

<script type="text/javascript">
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:400,
      modal: true,
      buttons: {
        "Да": function() {
          $( '#data' ).load( '<?=$targetOk?>',<?=$object?> );
          $(this).dialog('close');
        },
        "Отмена": function() {
          $( '#data' ).load('<?=$targetCancel?>' );
          $(this).dialog('close');
        }
      }
    });
  });
  </script>