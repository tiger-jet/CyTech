<?php 
//htmlspecialcharsを短くする
function h($value){
    return htmlspecialchars($value,ENT_QUOTES);
}
//データベースへの接続
function dbconnect(){
    $db=new mysqli('localhost','root','root','cytech');
    if(!$db){
		die($db->error);
}
    return $db;
}

?>
