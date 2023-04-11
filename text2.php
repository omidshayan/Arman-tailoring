<html>
<head>
    <title>سیستم مدیریت فروشگاه</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../css/pc.css" rel="stylesheet" type="text/css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/script.js"></script>
    <!-- <script>
        $(document).ready(function () {
            window.print();
        });
    </script> -->
    <style>
        @media print
        {
            .back>a,.print>a
            {
                display: none;
            }
            .fish_title1
            {
                font-size: 15pt;
            }
            .fish_title2
            {
                font-size: 10pt;
            }
            .fish_details_part
            {
                font-size: 8pt;
            }
            .order_title0
            {
                font-size: 8pt;
            }
            .order_title1
            {
                font-size: 6pt;
            }
            .order_title2
            {
                width: 30%;
                font-size: 6pt;
            }
            .order_title3
            {
                width: 12.5%;
                font-size: 6pt;
            }
            .order_allprice>.order_price:nth-child(1)
            {
                width: 47.5%;
            }
            .order_allprice>.order_price:nth-child(2)
            {
                border-left: none;
                width: 52.5%;
            }
            .order_pardakti
            {
                font-size: 8pt;
            }
            .order_price
            {
                font-size: 8pt;
            }
            .order_phone
            {
                font-size: 8pt;
            }
            .order_address
            {
                font-size: 8pt;
            }
            .order_address2
            {
                font-size: 6pt;
                font-weight: bold;
            }

        }
    </style>
</head>
<body>
<?php
session_start();
include '../../connect.php';
include '../../function.php';
include '../../jdf.php';
$takhfif=0;
$sql = "UPDATE `basket` SET `state` = '1' WHERE `code` = ?;";
$result = $connect->prepare($sql);
$result->bindValue(1,$_POST["code"]);
if($result->execute())
{

    $sql11 = "select * from `basket` where  `code` = ?";
    $result11 = $connect->prepare($sql11);
    $result11->bindValue(1,$_POST["code"]);
    $result11->execute();
    $data11=$result11->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data11 as $row11)
    {
        $sql1100 = "select * from `order` where  `code` = ?";
        $result1100 = $connect->prepare($sql1100);
        $result1100->bindValue(1,$_POST["code"]);
        $result1100->execute();
        $data1100=$result1100->fetch(PDO::FETCH_OBJ);
        $tedad1100=$result1100->rowCount();
        if ($tedad1100==0)
        {
            $sql110 = "select * from `products` where  `id` = ?";
            $result110 = $connect->prepare($sql110);
            $result110->bindValue(1, $row11["product_id"]);
            $result110->execute();
            $data110 = $result110->fetch(PDO::FETCH_OBJ);

            $sql = "UPDATE `products` SET `number` = ? WHERE `id` = ?;";
            $result = $connect->prepare($sql);
            $result->bindValue(1, ($data110->number - $row11["number"]));
            $result->bindValue(2, $row11["product_id"]);
            $result->execute();
        }




        $takhfif+=$row11["takhfif"];
    }

    $sql1100 = "select * from `order` where  `code` = ?";
    $result1100 = $connect->prepare($sql1100);
    $result1100->bindValue(1,$_POST["code"]);
    $result1100->execute();
    $data1100=$result1100->fetch(PDO::FETCH_OBJ);
    $tedad1100=$result1100->rowCount();
    if ($tedad1100==0)
    {


        $sql112 = "select * from `number` where `id` ='1'";
        $result112 = $connect->query($sql112);
        $data112 = $result112->fetch(PDO::FETCH_OBJ);
        $tedad112 = $result112->rowCount();

        $number = $data112->number + 1;


    $sql = "UPDATE `number` SET `number` = ? WHERE `id` = '1'";
    $result = $connect->prepare($sql);
    $result->bindValue(1,($data112->number+1));
    $result->execute();

        $sql11 = "INSERT INTO `order` (`id`, `code`, `price`, `number`, `sal`, `mah`, `rooz`, `time`, `takhfif`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result11 = $connect->prepare($sql11);
        $result11->bindValue(1, $_POST["code"]);
        $result11->bindValue(2, $_POST["price"]);
        $result11->bindValue(3, $number);
        $result11->bindValue(4, jdate("Y"));
        $result11->bindValue(5, jdate("m"));
        $result11->bindValue(6, jdate("d"));
        $result11->bindValue(7, jdate("H:i:s"));
        $result11->bindValue(8, $takhfif);
        $result11->execute();
    }






}

if (isset($_GET["max"]))
{
    echo '<div class="error_alarm2">تعداد سفارش از تعداد موجودیت این کالا بیشتر است ! </div>';
}
elseif(isset($_GET["notfound"]))
{
    echo '<div class="error_alarm2">کالایی با این کد یافت نشد !</div>';
}
elseif(isset($_GET["success"]))
{
    echo '<div class="success_alarm2">کالا با موفقیت به سبد خرید اضافه شد !</div>';
}
elseif(isset($_GET["error"]))
{
    echo '<div class="error_alarm2">خطا در افزودن کالا به سبد خرید !</div>';
}
elseif(isset($_GET["delsuccess"]))
{
    echo '<div class="success_alarm2">کالا با موفقیت از سبد خرید  کسر شد </div>';
}
elseif(isset($_GET["delerror"]))
{
    echo '<div class="error_alarm2">خطا در حذف محصول از سبد خرید </div>';
}

?>



<div class="fish">
<div class="fish_title1">'.SHOP_NAME.'</div>
<div class="fish_title2">فاکتور فروش</div>

<div class="fish_details">
<div class="fish_details_part">شماره : '.$data110->number.'</div>
<div class="fish_details_part">تاریخ : '.$data110->sal.'/'.$data110->mah.'/'.$data110->rooz.'</div>
<div class="fish_details_part">کاربر صندوق : مدیر</div>
<div class="fish_details_part">ساعت : '.$data110->time.'</div>
</div>


<div class="order">
<div class="order_title0" style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">#</div>
<div class="order_title2" style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">عنوان</div>
<div class="order_title3" style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">تعداد</div>
<div class="order_title3 " style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">قیمت</div>
<div class="order_title3 hidden" style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">قیمت کل</div>
<div class="order_title3" style="border-left: 1px solid black;box-sizing: border-box;background: #ECEFF1">تخفیف</div>
<div class="order_title1" style="background: #ECEFF1">قیمت نهایی</div>
</div>


        <div class="order">
        <div class="order_title0"  style="border-left: 1px solid black;box-sizing: border-box;">'.$i++.'</div>
        <div class="order_title2"  style="border-left: 1px solid black;box-sizing: border-box;">';

<span style="font-size: 2vmin">'.show_cat_name($data1->cat_id).'</span>

<span style="font-size: 2.5vmin">'.show_cat_name($data1->cat_id).'</span>
</div>
        <div class="order_title3"  style="border-left: 1px solid black;box-sizing: border-box;">'.$row1["number"].'</div>
        <div class="order_title3 "  style="border-left: 1px solid black;box-sizing: border-box;">'.number_format($data1->sale_price).'</div>
        <div class="order_title3 hidden" style="border-left: 1px solid black;box-sizing: border-box;">'.number_format(($data1->sale_price*$row1["number"])).'</div>
        <div class="order_title3"  style="border-left: 1px solid black;box-sizing: border-box;">'.number_format($row1["takhfif"]).'</div>
        <div class="order_title1">'.number_format(($data1->sale_price*$row1["number"])-$row1["takhfif"]).'</div>
        </div>';


<div class="order_allprice">
<div class="order_price">تخفیف : '.number_format($takhfif).' افغانی </div>
<div class="order_price">مبلغ کل : '.number_format($sum).' افغانی </div>
</div>

<div class="order_pardakti">پرداختی : '.number_format($sum-$takhfif).' افغانی </div>
<div class="order_phone">آدرس ‌: '.SHOP_ADDRESS.'</div>
<div class="order_address"><span id="telegram">shikshop94@</span> ---- تماس :  '.SHOP_PHONE.' </div>
<div class="order_address2">موسسه تکنولوژی میثاق  ------  تماس: 0796968490</div>



</div>';
unset($_SESSION["random"]);
}
else
{
    header("location:../dashboard.php");
    exit();
}
?>

</body>