<?php
	
Mb_language( "Japanese" );

$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['body'];
	
$result = mail( $email, $subject, $body);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>