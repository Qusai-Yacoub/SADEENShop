<?php

include 'config.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

}



if (isset($_POST['add_to_cart'])) {

    if (!isset($user_id)) {
        header('location:login.php');
    } else {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");

        if (mysqli_num_rows($check_cart_numbers) > 0) {
            $message[] = 'already added to cart!';
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')");
            $message[] = 'product added to cart!';
        }

    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>SADEEN Shop eCommerce</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/banner_img.jpg">
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;family=Figtree:wght@300;600&amp;display=swap'>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/temoo.css">
    <link rel="stylesheet" href="assets/css/custom1.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">


    <style>
        <?php include 'assets/css-admin/admin_style.css'; ?>
    </style>
    <style>
        <?php include 'assets/css-admin/style.css'; ?>
    </style>


</head>

<body>

    <?php include 'header.php'; ?>

    <section class="articles">
    <a href="shop.php" style="text-decoration:none ; ">
        <article>
            <div class="article-wrapper">
                <figure>
                    <img src="./assets/img/mens_img_0.jpg" alt="" />
                </figure>
                <div class="article-body">
                    <h2> Mens Clothes</h2>
                    <p style="text-align:justify ; color:black"> <b>
                        Hurry Up With Your Piece, Great Discounts, Our Quality, Our Big Deal, All Sizes Inside, New
                        Version For Stylish Clothes, Great Looks In Excellent Quality, And You Just Have To Choose To
                        Get Your Order Now, Even When You're Home .</b> </p>
                </div>
            </div>
        </article>
        </a>

        <a href="shop.php" style="text-decoration:none ">
        <article>
            <div class="article-wrapper">
                <figure>
                    <img src="./assets/img/womens_img_0.jpg" alt="" />
                </figure>
                <div class="article-body">
                    <h2>Womens Clothes</h2>
                    <p style="text-align:justify; color:black"> <b>
                        Hurry Up With Your Piece, Great Discounts, Our Quality, Our Big Deal, All Sizes Inside, New
                        Version For Stylish Clothes, Great Looks In Excellent Quality, And You Just Have To Choose To
                        Get Your Order Now, Even When You're Home .</b>
                    </p>
                </div>
            </div>
        </article>
        </a>

        <a href="shop.php" style="text-decoration:none ">
        <article>
            <div class="article-wrapper">
                <figure>
                    <img src="./assets/img/kids_img_0.jpg" alt="" />
                </figure>
                <div class="article-body">
                    <h2>Kids Clothes</h2>
                    <p style="text-align:justify; color:black"> <b>
                        Hurry Up With Your Piece, Great Discounts, Our Quality, Our Big Deal, All Sizes Inside, New
                        Version For Stylish Clothes, Great Looks In Excellent Quality, And You Just Have To Choose To
                        Get Your Order Now, Even When You're Home .</b> </p>
                </div>
            </div>
        </article>
        </a>

    </section>

    
    <!-- Start Categories of The Month -->
    <section class="products">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1> LATEST PRODUCTS </h1>
            </div>
        </div>
        <br><br>
        <div class="box-container" style="width:100%">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") ;
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <form action="" method="post" class="box">
                        <img class="image" style="width:100%" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price"><?php echo $fetch_products['price']; ?>JD</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    </form>
                    <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->

    <?php include 'footer.php'; ?>

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/temo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>