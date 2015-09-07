<!-- navbar -->
<div style= background-color:#012169; class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Your Site</a>
        </div>
 
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="My incredible Products" ? "class='active'" : ""; ?> >
                    <a href="index.php">Products</a>
                </li>
                <li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
                    <a href="cart.php">
                        <?php
                        // count products in cart (session)
                        if(isset($_SESSION['cart_items'])){
                        $cart_count=count($_SESSION['cart_items']);
                        } 
                            //or count products in saved cart (cookie) 
                            else if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == "logged in"){
                          
                          
                            $cookie_name = "saved_cart" . $_SESSION["username"];
                             $cart_count=count(json_decode($_COOKIE[$cookie_name], true));
                             $cart_count = "Here is your saved cart with " . $cart_count . " product(s)";
                        
                        } else {
                            
                                $cart_count = 0;
                            }

                            

                        ?>
                        Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
                    </a>
                </li>
               <!-- <li><a href="login.php">Customer Log In / Create Profile</a></li>-->
                <li><a href="logout.php">Empty Cart</a></li>

            </ul>
        </div><!--/.nav-collapse -->
        </div>

</div>
<!-- /navbar -->
