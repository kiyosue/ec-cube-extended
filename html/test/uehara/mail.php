<?php
	
Mb_language( "Japanese" );

$email = $_POST['email'];
$subject = "flash + javascript + PHP";
$body = "flash + javascript + PHP �ƥ���";
	
$result = mb_send_mail( $email, $subject, $body);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>