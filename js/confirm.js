function confirm(title, message, object, targetOk, targetCancel){
    $('#data').load('modules/confirm.php',{title:title,message:message,object:object,targetOk:targetOk,targetCancel:targetCancel});
}