<?php

$result = mb_send_mail( $_POST['email'], $_POST['subject'], $_POST['body']);

//FLASH���ͤ�����(���� = 0, ���� = 1)
echo "trans=". $result;


?>