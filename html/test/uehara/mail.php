<?php
	
Mb_language( "Japanese" );

$subject = $_POST['subject'];
$body = $_POST['body'];
	
$result = mb_send_mail( $_POST['email'], $subject, $body, $header);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>