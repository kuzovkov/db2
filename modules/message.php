<div id="dialog-message" title="<?=$title?>">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    <?=$message?>
  </p>
</div>

<script>
  $(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $('#data').load('<?=$target?>',{idPassenger:<?=$idPassenger?>,idFlight:<?=$idFlight?>});
          $( this ).dialog( "close" );
        }
      }
    });
  });
</script>

