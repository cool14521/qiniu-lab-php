<?php
header("Content-Type:application/json");
require_once("../../lib/qiniu/rs.php");
require_once("../../qiniu_config.php");
if (isset($_POST["endUser"]) && !empty($_POST["endUser"])) {
    $endUser = $_POST["endUser"];
    Qiniu_SetKeys($Qiniu_AccessKey, $Qiniu_SecretKey);
    $putPolicy = new Qiniu_RS_PutPolicy($Qiniu_Public_Bucket);
    $returnBody = array("hash" => "$(hash)", "key" => "$(key)", "endUser" => "$(endUser)");
    $putPolicy->EndUser = $endUser;
    $putPolicy->ReturnBody = json_encode($returnBody);
    $token = $putPolicy->Token(null);
    $respData = array(
        "uptoken" => $token
    );
} else {
    $respData = array("error" => "no endUser specified");
}
echo json_encode($respData);