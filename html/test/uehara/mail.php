<?php

$subject = Mb_encode_mimeheader($_POST['subject']);
$body = mb_convert_encoding( $_POST['body'], "iso-2022-jp", "EUC-JP");

Mb_language( "Japanese" );
	
$result = mb_send_mail( $_POST['email'], $subject, $body);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>