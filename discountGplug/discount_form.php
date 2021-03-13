<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
if ($_SERVER['REQUEST_METHOD'] != "POST" || !$_POST["name"]){
    header("location: /");
    die();
};

$FDATA=array(
    "name" => $_POST["name"],
    "phone" => "",//$_POST["phone"],
    "email" => $_POST["email"],
    "social" => array(),
    "language" => $_POST["lang"]
);
foreach(str_split($_POST["phone"]) as $char){
    if (is_numeric($char)) {
       $FDATA["phone"] .= $char;
    };
}; // unformat phone
foreach ($_POST as $key => $value) {
    switch ($key) {
        case "isWA":
            $FDATA["social"][] = "wa";
            break;
            case "isTG":
            $FDATA["social"][] = "tg";
            break;
        case "isVB":
            $FDATA["social"][] = "vb";
            break;
        case "isML":
            $FDATA["social"][] = "ml";
            break;            
    }
}
$FDATA["social"] =  json_encode($FDATA["social"]);

echo apply_filters("discountGplug_api",$FDATA);