<?php

$subject = $_POST['subject'];
$body = $_POST['body'];

Mb_language( "Japanese" );
	
$result = mb_send_mail( $_POST['email'], $subject, $body);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>