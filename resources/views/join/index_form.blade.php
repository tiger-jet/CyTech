<?php
session_start();
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



if(isset($_GET['action'])&&$_GET['action']==='rewrite'&&isset($_SESSION['form'])){
    $form=$_SESSION['form'];
}else{
    $form=[
        'name'=>'',
        'email'=>'',
        'password'=>''];
}

$error=[];

//フォームの内容をチェック
if($_SERVER['REQUEST_METHOD']==='POST'){
    $form['name']=filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
    if($form['name']===''){
        $error['name']='blank';
     }else{
         $db=dbconnect();
         $stmt=$db->prepare('select count(*) from users where email=?');
         if(!$stmt){
             die($db->error);
         }
         $stmt->bind_param('s',$form['email']);
         $success=$stmt->execute();
         if(!$success){
             die($db->error);
         }
         
         $stmt->bind_result($cnt);
         $stmt->fetch();

         if($cnt>0){
             $error['email']='duplicate';
         }
     }

     $form['email']=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
if($form['email']===''){
    $error['email']='blank';
}

$form['password']=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
if($form['password']===''){
    $error['password']='blank';
}else if(strlen($form['password'])<4){
    $error['password']='length';
}

$form['password_conf']=filter_input(INPUT_POST,'password_conf',FILTER_SANITIZE_STRING);
if($form['password']!==$form['password_conf']){
    $error['password_conf']='conf';
}


//画像のチェック
// $image=$_FILES['image'];
// if($image['name']!==''&&$image['error']===0){
//     $type=mime_content_type($image['tmp_name']);
//     if($type!=='image/png'&&$$type!=='image/jpeg' ){
//         $error['image']='type';
//     }
//     }
     
    
    //画像のアップロード
    // if($image['name']!==''){
    //     $filename=date('YmdHis').'_'.$image['name'];
    //     if(!move_uploaded_file($image['tmp_name'],'../member_picture/'.$filename)){
    //         die('ファイルのアップロードに失敗しました');
    //     }
    //     $_SESSION['form']['image']=$filename;
    // }else{
    //     $_SESSION['form']['image']='';
    // }
    if(empty($error)){
        $_SESSION['form']=$form;

        header('Location:check.blade.php');
        exit();
}
}
?>