<?php
    session_start();
    require_once 'database.php';

    $database =  new Database();

//    echo '<pre>';
//    print_r($_SESSION);
//    echo '</pre>';
    $total = array();

 ?>

<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">

<?php  if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) : ?>
    <table class="table table-striped" style="text-align: center">
        <thead>
        <tr>
            <th scope="col">id sản phẩm</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Giá tiền</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thành tiền</th>
            <th scope="col">Xóa sản phẩm</th>
        </tr>
        </thead>
        <tbody>

        <?php
            $sanpham = current($_SESSION);
            foreach($sanpham as $product) : ?>
                <tr style="line-height: 50px" >
                    <th scope="row"><?php echo $product['id']  ?></th>
                    <td><?php echo $product['product_name']  ?></td>
                    <td><img src="images/<?php echo $product['product_image']; ?>" alt="" style="width:50px; height: 50px "></td>
                    <td><?php echo $product['price']  ?></td>
                    <td><?php echo $product['quanlity']  ?></td>
                    <td><?php  $sum = $product['quanlity'] * $product['price'];
                                array_push($total,$sum);
                                echo $sum;

                        ?></td>
                    <td>
                        <form action="process.php" name="remove<?php echo $product['id'] ?>" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="action" value="remove">
                            <button type="submit" class="btn btn-sm btn-outline-secondary ml-2" name="submit" value="xóa">Xóa</button>
                        </form>
                    </td>
                </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
    <p>Tổng giá tiền: <b><?php echo array_sum($total) ?></b></p>
</div>
<?php   endif ?>

<div class="container" style="margin-top:50px;">
    <div class="row">

        <?php
            $sql = 'select * from products';
            $products = $database->runQuery($sql);


        ?>

        <?php  if(!empty($products))  :   ?>

            <?php foreach ($products as $product)   : ?>
                <div class="col-sm-6  " >
                    <form action="process.php" method="POST" name="product1" >
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="images/<?php echo $product['product_image']; ?>" style="height: 225px; width: 250px; display: block;"  data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text font-weight-bold"><?php echo $product['product_name']; ?> </p>
                                <p style="color: red">₫<?php echo $product['price']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <input type="text" name="quanlity" value="1">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary ml-2" name="submit" value="thêm vào giỏ hàng">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach;  ?>

        <?php endif;  ?>


    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

