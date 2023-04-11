<?php include_once 'sidebar.php';

                        // insert customer info
                        include_once 'db.php';
                        $sql = "SELECT * FROM `orders` WHERE `state` = 1 AND id = ? ";
                        $result = $connect->prepare($sql);
                        $result->bindValue(1,$_GET['id']);
                        $result->execute();
                        $row = $result->rowCount();
                        $data = $result->fetch(PDO::FETCH_OBJ);
                        ?>

                    <div class="overview">
                        <div class="all-review"> اتمام دوخت</div>
                     </div>   
                     <br>
    
                        <?php
                        if(isset($_GET['ok'])){
                            echo '<span>result: Ok</span>';
                        }
                                                if(isset($_GET['error'])){
                            echo '<span>not ok</span>';
                        }
                            if(isset($_GET['larg'])){
                            echo '<span>مبلغ وارد شده از مبلغ باقیمانده بیشتر است!</span>';
                        }
?>

 <div class="show-size-customer">
                                    <h3 class="title-size"> اطلاعات سفارش</h3>
                                    <div class="box-size">نام: <?php 
                                        if($data->username == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->username;
                                        }
                                    ?></div>
                                    <div class="box-size">شماره: <?php 
                                        if($data->user_phone == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->user_phone;
                                        }
                                    ?></div>
                                    <div class="box-size">مبلغ کل: <?php 
                                        if($data->all_price == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->all_price;
                                        }
                                    ?></div>                                    
                                    <div class="box-size">تخفیف: <?php 
                                        if($data->discount == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->discount;
                                        }
                                    ?></div>
                                    <div class="box-size">پیش پرداخت: <?php 
                                        if($data->prepayment == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->prepayment;
                                        }
                                    ?></div>
                                    <div class="box-size" style="color: red;">باقیمانده: <?php 
                                        if($data->remaining == ""){
                                            echo " - - - - - ";
                                        }
                                        else{
                                            echo $data->remaining;
                                        }
                                      
                                    ?></div>
                
                <div class="insert-cars">
                    <form action="back/finish-order-check.php"><br>
                        <div>مبلغ پرداختی </div>
                        <input type="number" placeholder="مبلغ را وارد نمایید ..." name="final_price">
                        <input type="hidden" name="id" value="<?=$data->id?>">
                        <input type="submit" value="ثبت" class="my-btn" name="btn">
                    </form>
                </div>
                    
                    <a href="sewing.php" class="size-link">برگشت</a>
                </div>
                   



                     
                </main>

        </div>

   <!-- js library -->
    <script src="js/fontA.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>