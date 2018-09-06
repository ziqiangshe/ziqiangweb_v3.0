<?php
$name = $_POST['name'];
$sex = $_POST['sex'];
$result = $name.$sex;
$ans = array();
$ans['ans']=base64_encode(md5($result));

if($ans['ans'][5] > 'c'){
    $ans['status'] = 0;
    $ans['ans'] = "有";
}
else{
    $ans['status'] = 0;
    $ans['ans'] = "没有";
}
echo json_encode($ans);