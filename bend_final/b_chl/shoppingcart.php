<?php
// $output = 'hahah';
$client = curl_init('http://api.yutama.me/apiHandler.php?action=outputShoppingCart');
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
$result = json_decode($response);

$output = '';
//output data to show in the index.php
if(count($result) > 0){
    $i = 0;
    foreach($result as $row){
        $output .= '
                <label class="form-control">SKU: '.$row->SKU.'</label>
                <label class="form-control">Name: '.$row->Name.'</label>
                <label class="form-control">Price: '.$row->Price.'</label>
                <input type="hidden" name="price'.$i.'" id="price'.$i.'" value="'.$row->Price.'" />
                <input type="text" name="'.$row->SKU.'" class="form-control" id="'.$row->SKU.'" placeholder="Qty: '.$row->Inventory_qty.'" />
        ';
        $i++;
    }
    $output .= '
        <input type="hidden" name="action" id="action" value="buy" />
        <input type="submit" name="submitNewTodo" class="btn btn-primary" id="submitNewTodo" value="Add" />
       ';
} else {
    $output .='<tr> <td colspan="3" align="center">'.$response.'Not Found</td></tr>';
}
echo $output;

?>



<!-- 
<label>First name:</label>
            <div class="form-group">
                <input type="text" name="to_do" class="form-control" id="'.$row->SKU.'" placeholder="'.$row->SKU.'" />
            </div>
            <div class="form-group">
                <input type="text" name="to_do" class="form-control" id="'.$row->Name.'" placeholder="'.$row->Name.'" />
            </div>
            <div class="form-group">
                <input type="text" name="to_do" class="form-control" id="'.$row->Price.'" placeholder="'.$row->Price.'" />
            </div>
            <div class="form-group">
                <input type="text" name="to_do" class="form-control" id="'.$row->Inventory_qty.'" placeholder="'.$row->Inventory_qty.'" />
            </div> -->