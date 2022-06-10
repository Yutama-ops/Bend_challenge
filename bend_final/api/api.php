<?php
class API{
    private $connect = '';

    function __construct(){
        $this->dbConnection();
    }

    function dbConnection(){
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbss = "api_chall";

        $this->connect = new PDO("mysql:host=hostname;dbname=dbname", "username", "password");
    }

    // return data wich will be called to show all the stock item in index.php
    function outputShoppingCart(){
        $select = $this->connect->prepare('SELECT * FROM stock ORDER BY SKU');
        if($select->execute()){
            while($row = $select->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }
    }

    // function addNewToDo(){
    //     if(isset($_POST['to_do'])){
    //         $data = array(
    //             ':to_do' => $_POST['to_do'],
    //             ':date'  => $_POST['date']
    //         );
    //         $insert = $this->connect->prepare('INSERT INTO to_do (to_do, date) VALUES (:to_do, :date)');
    //         $insert->execute($data);
    //     }
    // }

    function buy(){
        //final-------------
        //logic--------------
        $total = 0;
        $price = array(
            'price0'     => $_POST['price0'],
            'price1'     => $_POST['price1'],
            'price2'     => $_POST['price2'],
            'price3'     => $_POST['price3']
        );
        $total = ($_POST['120P90'] * $_POST['price0']) + ($_POST['234234'] * $_POST['price1']) + ($_POST['43N23P'] * $_POST['price2']) + ($_POST['A304SD'] * $_POST['price3']);
        // // buy 43N23P free 234234   price return 43N23P
        if($_POST['43N23P'] > 0){
            $_POST['234234'] += $_POST['43N23P'];
            $total -= $_POST['price1']*$_POST['43N23P'];
        }
        // // buy 3 120P90 pay 2       price return 120P90 * 2
        if(($_POST['120P90'] > 2)){
            $total -= (intdiv($_POST['120P90'],3) *$_POST['price0']);
        }
        // buy A304SD > 3 = 10%     price return A304SD*n - 10%
        if($_POST['A304SD'] >= 3){
            $total -= ($_POST['A304SD']*$_POST['price3']*10/100);
        }
        //logic--------------
       
        if(isset($_POST['120P90'])){
            $data = array(
                '120P90'     => $_POST['120P90'],
                '234234'     => $_POST['234234'],
                '43N23P'     => $_POST['43N23P'],
                'A304SD'     => $_POST['A304SD']
            );
            foreach($data as $key => $value)
            {
                $new_data = array(
                    ":SKU" => $key,
                    ":qty" => $value
                );
                
                $insert = $this->connect->prepare('UPDATE `stock` SET `Inventory_qty` = Inventory_qty - :qty WHERE SKU = :SKU;');
                $insert->execute($new_data);
            }

        return $total;
        //final--------------
        }
    }


}
?>