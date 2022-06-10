<?php
include('api.php');

$apiObject = new API();

if($_GET["action"] == 'outputShoppingCart'){
    $data = $apiObject->outputShoppingCart();
}

// if($_GET["action"] == 'addNew'){
//     $data = $apiObject->addNewToDo();
// }

if($_GET["action"] == 'buy'){
    $data = $apiObject->buy();
}

echo json_encode($data);
?>