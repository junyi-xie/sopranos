<footer class="site__footer">
        
    <div class="site__footer_wrapper">

        <div class="site__footer_content">

            <nav class="footer__nav">

                <div class="site__social">

                    <a class="site__logo_link" href="index.php"><img class="site__logo_image" src="assets/images/layout/sopranos-logo.png"></a>

                    <?php /* <ul class="site__social_links"><li class="site__social_link"><a class="icon__facebook_link" target="_blank" href="#"><i class="fa fa-facebook-f"></i></a></li><li class="site__social_link"><a class="icon__twitter_link" target="_blank" href="#"><i class="fa fa-twitter"></i></a></li><li class="site__social_link"><a class="icon__instagram_link" target="_blank" href="#"><i class="fa fa-instagram"></i></a></li><li class="site__social_link"><a class="icon__pinterest_link" target="_blank" href="#"><i class="fa fa-pinterest"></i></a></li></ul> */ ?>

                </div>
                
                <ul class="nav__items">

                    <h3 class="nav__header">Explore</h3>

                    <li class="nav__item"><a class="nav__item_link" href="index.php">Home</a></li>    

                    <li class="nav__item"><a class="nav__item_link" href="about.php">About Us</a></li>                

                    <li class="nav__item"><a class="nav__item_link" href="shop.php">Store Page</a></li>      

                    <li class="nav__item"><a class="nav__item_link" href="cart.php">Shopping Cart</a></li>    

                </ul>

                <ul class="nav__items">

                    <h3 class="nav__header">Visit</h3>

                    <li class="nav__item"><?php echo $aBrancheSopranos['name'] ?></li>    

                    <li class="nav__item"><?php echo $aBrancheSopranos['adres'] ?></li>                

                    <li class="nav__item"><?php echo $aBrancheSopranos['zipcode']."\t".$aBrancheSopranos['city'] ?></li>      

                </ul>

                <ul class="nav__items">

                    <h3 class="nav__header">Connect</h3>

                    <li class="nav__item"><?php echo '<a class="nav__item_link" href="mailto:'.$aBrancheSopranos['email'].'">'.$aBrancheSopranos['email'].'</a>' ?></li>    

                    <li class="nav__item"><?php echo '<a class="nav__item_link" href="tel:'.$aBrancheSopranos['phone'].'">'.$aBrancheSopranos['phone'].'</a>' ?></li>                

                </ul>

                <ul class="nav__items">

                    <h3 class="nav__header">Follow</h3>

                    <li class="nav__item"><a class="icon__facebook_link" target="_blank" href="#">Facebook</a></li>    

                    <li class="nav__item"><a class="icon__twitter_link" target="_blank" href="#">Twitter</a></li>                

                    <li class="nav__item"><a class="icon__instagram_link" target="_blank" href="#">Instagram</a></li>      

                    <li class="nav__item"><a class="icon__pinterest_link" target="_blank" href="#">Pinterest</a></li>    

                </ul>

                <ul class="nav__items">

                    <h3 class="nav__header">Legal</h3>

                    <li class="nav__item"><a class="nav__item_link" href="http://localhost:8080/sopranos/terms.php">Terms</a></li>    

                    <li class="nav__item"><a class="nav__item_link" href="http://localhost:8080/sopranos/privacy.php">Privacy</a></li>                

                </ul>
                            
            </nav>

            <div class="footer__legal">
            
                <div class="site__copyright">

                    <p>Copyright &copy; <?php echo date("Y")?> Sopranos Pizzabar. All Rights Reserved.</p>

                </div>

            </div>

        </div>

    </div>

</footer>