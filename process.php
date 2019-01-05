<?php
    session_start();
    require_once "database.php";
    $database = new Database();
    function setCart_item($product, $quanlity = 0)
    {
        $cart_item = array();

        $cart_item['id'] = $product['id'];
        $cart_item['product_name'] = $product['product_name'];
        $cart_item['product_image'] = $product['product_image'];
        $cart_item['price'] = $product['price'];
        $cart_item['quanlity'] = $quanlity + $_POST['quanlity'];
        $_SESSION['cart_item'][$cart_item['id']] = $cart_item;
    }



    if(isset($_POST) && !empty($_POST))
    {
//        echo '<pre>';
//        print_r($_POST);
//        echo '</pre>';
        if(isset($_POST['action'])){
            switch ($_POST['action']){
                case 'add':
                    if(isset($_POST['quanlity']) && !empty($_POST['product_id'])){
                        /*
                         *  khi đã có lịch sử mua hàng thì sẽ nhảy bước này
                         * */
                        $sql = "SELECT * from  products where id=". (int)$_POST['product_id'];
                        $product = $database->runQuery($sql);
                        $product = current($product);
                        echo '<pre>';
                        print_r($product);
                        echo '</pre>';
                        $product_id = $product['id'];
                        if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {

                            if(isset($_SESSION['cart_item'][$product_id])){
                                $exist_cart_item = $_SESSION['cart_item'][$product_id];
                                $exist_quanlity = $exist_cart_item['quanlity'];
                                setCart_item($product,$exist_quanlity);
                            }
                            else {
                                setCart_item($product);
                            }
                        }else {
                            /* cái này dành chưa cookie chưa có lịch sử mua hàng  sẽ tạo ở đây
                             */
                            $_SESSION['cart_item'] = array();
                            setCart_item($product);
                        }

                    }
                    break;
                case 'remove':
                        echo '<pre> ';
                        print_r($_POST);
                        echo '</pre>';
                        if(isset($_POST['product_id'])){
                            $product_id = $_POST['product_id'];
                            if(isset($_SESSION['cart_item'][$product_id])){
                                unset($_SESSION['cart_item'][$product_id]);
                            }
                        }
                        break;
                default: echo 'Action khong ton tai';break;
            }
        }
    }

    echo '<pre> $_SESSION ';
    print_r($_SESSION);
    echo '</pre>';

    echo '<pre> $_SESSION cart_item';
    print_r($_SESSION['cart_item']);
    echo '</pre>';

    header('Location: http://localhost/shop/');
    exit();








