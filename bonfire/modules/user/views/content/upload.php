<?php
include"db_comment.php";
$username = htmlspecialchars(trim($_POST['username']));
$comment = htmlspecialchars(trim($_POST['comment']));
if(empty($username)){
	echo "must input username!";
	exit;
}
if(empty($comment)){
	echo "must say something!";
	exit;
}
$date = date("Y-m-d H:i:s");
$query=mysql_query("insert into message(comment_user,comment_content,)values('$username','$comment')");
if($query)  echo "1";
?>