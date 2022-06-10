


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container" style="margin-top: 30px;">
        <h3 align="center" style="margin-bottom: 20px;">To Do List</h3>
        
        <!-- shopping cart form -->
        <form method="POST" id="api_form_shopchart">
        
        </form>
            
        
        </form>
    <script>
        $(document).ready(function(){

            // outputData();
            outputDataSC();

            // function outputData(){
            //     $.ajax({
            //         url: "output.php",
            //         success:function(data){
            //             $('tbody').html(data);
            //         }
            //     });
            // }
            // output shoppingcartdata
            function outputDataSC(){
                $.ajax({
                    url: "shoppingcart.php",
                    success:function(data){
                        $('form').html(data);
                        // document.getElementById("api_form_shopchart").innerHTML = data;
                    }
                });
            }
            //send submit to the api handler
            //and reset form
            $('#api_form_shopchart').on('submit', function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "shoppingcart_controller.php",
                    method: "POST",
                    data: formData,
                    success: function(data){
                        alert(data);
                        outputDataSC();
                        $('#api_form_shopchart')[0].reset();
                    }
                });
            });

            // $('#api_form').on('submit', function(event){
            //     event.preventDefault();
            //     if($('#to_do').val() == ''){
            //         alert('To do field is required!');
            //     } else if($('#date').val() == ''){
            //         alert('Date field is required!');
            //     } else {
            //         var formData = $(this).serialize();
            //         $.ajax({
            //             url: "controller.php",
            //             method: "POST",
            //             data: formData,
            //             success: function(data){
            //                 outputData();
            //                 $('#api_form')[0].reset();
            //             }
            //         });
            //     }
            // });
    });

    </script>
</body>
</html>