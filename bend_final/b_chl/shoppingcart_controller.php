<?php
// $connect = new PDO("mysql:host=hostname;dbname=dbname", "username", "password");
// $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
// catch(PDOException $e)
// {
// echo "Connection failed: " . $e->getMessage();
// }
if(isset($_POST['action'])){
    // $data = array(
    //     '120P90'     => $_POST['120P90'],
    //     '234234'     => $_POST['234234'],
    //     '43N23P'     => $_POST['43N23P'],
    //     'A304SD'     => $_POST['A304SD']
    // );
    // foreach($data as $key => $value)
    // {
    //     $SKU = $key;
    //     $qty = $value;
    //     echo $SKU;
    //     echo "<br>";
    //     echo $qty;
    //     echo "<br>";
    //     $insert = $connect->prepare('UPDATE stock SET Inventory_qty = Inventory_qty-$qty WHERE SKU = $SKU;');
    //     $insert->execute($data);
    // }
    // foreach ($_POST as $key => $value) {
    //     echo $key;
    //     echo "  ";
    //     echo $value;
    //     echo "<br>";
    // }
    // echo $_POST['price0'];
    $total = '';
    if($_POST['action'] == "buy"){
        $data = array(
            '120P90'     => $_POST['120P90'],
            '234234'     => $_POST['234234'],
            '43N23P'     => $_POST['43N23P'],
            'A304SD'     => $_POST['A304SD'],
            'price0'     => $_POST['price0'],
            'price1'     => $_POST['price1'],
            'price2'     => $_POST['price2'],
            'price3'     => $_POST['price3']
        );
        $client = curl_init('http://api.yutama.me/apiHandler.php?action=buy');
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $total = json_decode($response);
    } else {
        $total = "No Response";
    }
    echo $total;
}

?>