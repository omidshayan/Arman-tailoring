<!DOCTYPE html>
<html lang="en">
<head>
        <?php 
include_once 'db.php';
$sql = "SELECT * FROM `orders` WHERE id = ?";
$result = $connect->prepare($sql);
$result->bindValue(1,$_GET['id']);
$result->execute();
$row = $result->rowCount();
$data = $result->fetch(PDO::FETCH_OBJ);
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="styles/style.css"> -->
        <link rel="stylesheet" href="styles/print.css">
        <script src="js/jquery.js"></script>
    <title>چاپ فاکتور <?=$data->username?></title>
</head>
<body>


<script>

    $(document).ready(function () {
        $("#print").ready(function () {
            window.print();
        });

    });

</script>


        <div class="factor">
            <h5 class="print-title">خیاطی آرمان</h5>
            <hr class="hr-print">
            <div class="box-right">نام: <?php 
                if($data->username == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->username;
                }
            ?></div>
            <div class="box-left">شماره: <?php 
                if($data->user_phone == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->user_phone;
                }
                ?></div>
                <hr class="my-hr">
            <div class="box-size">قیمت: <?php 
                if($data->all_price == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->all_price;
                }
            ?></div>
            <div class="box-size">تخفیف:  <?php 
                if($data->discount == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->discount;
                }
            ?></div>
            <hr class="my-hr">
            <div class="box-size">مبلغ پرداختی: <?php 
                if($data->prepayment == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->prepayment;
                }
            ?></div>
            <div class="box-size">باقیمانده: <?php 
                if($data->remaining == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->remaining;
                }
            ?></div>
            <hr class="my-hr">
            <div class="box-size all-date">تاریخ ثبت: <?php 
                if($data->create_at == ""){
                    echo " - - - - - ";
                }
                else{
                    echo $data->create_at;
                }
            ?></div>
            <hr class="my-hr">
            <div class="address-factor">
                آدرس: هرات - شهر نو - جاده بهزاد
            </div>
        </div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
