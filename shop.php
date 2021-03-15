<?php
    /* Copyright (c) - 2021 by Junyi Xie */	

    include_once("inc/connect.php");
    include_once("inc/functions.php");
    include_once("inc/class.php");

    if(isset($_POST) && !empty($_POST)) {
        // FIX THIS WITH AJAX and show MODAL
        $bBoolean = saveCustomerOrder($_POST);

        if($bBoolean) {
            header("location: checkout.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Shop · Sopranos Pizzabar</title>
    <meta charset="UTF-8">
    <meta name="author" content="Junyi Xie">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo date("YmdHis") ?>" media="screen">
</head>
<body>

<?php include_once("inc/header.php") ?>

<div class="site__content_container">

    <div class="site__main">

        <div class="site__wrapper">

            <div class="site__shop_product_container">

                <div class="image_stack__container___wrapper">
                
                    <div class="image_stack__container">
                    
                        <div class="image_stack__inner">

                            <?php $aSqlTypeImages = $pdo->query("SELECT * FROM images AS i LEFT JOIN pizzas_type AS pt ON pt.image_id = i.id WHERE 1 ORDER BY pt.id LIMIT 0, 100")->fetchAll(PDO::FETCH_ASSOC); ?> 

                            <div class="image_stack__images">
                            
                                <div class="image_stack__image_wrap image_stack__image_wrap--active">

                                    <img class="image_stack__image js-image_stack__image" src="assets/images/layout/<?= $aSqlTypeImages[0]['link']; ?>" id="image_stack__image_preview">

                                </div>

                            </div>
                        
                            <nav class="image_stack__nav">
                            
                                <ul class="image_stack__nav_list">

                                    <?php foreach($aSqlTypeImages as $key => $aImageTypes): ?>
                                    
                                    <li class="image_stack__nav_item js-stack__nav_item">                                    
                                    
                                        <img class="image_stack__nav_item_thumb js-stack__nav_thumbnail" data-shop-product-id="<?= $aImageTypes['id']; ?>" src="assets/images/layout/<?= $aImageTypes['link']; ?>" id="product_nav_thumbnail-<?= $aImageTypes['id']; ?>">

                                    </li>

                                    <?php endforeach; ?>

                                </ul>

                            </nav>

                        </div>

                    </div>

                </div>

                <div class="shop__column--product">

                    <div class="shop__heading-product">

                        <h2 class="shop__title">Sopranos Shop</h2>

                        <span class="shop__location"><i class="fas fa-map-marker-alt"></i><?= $aSopranosBranches['city']; ?>, <?= $aSopranosBranches['country']; ?></span>

                    </div>

                    <div class="shop__description_container">

                        <p class="shop__description--text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sapiente possimus sint amet ducimus repellat veniam natus. Eum pariatur non eius perspiciatis obcaecati distinctio consequatur modi voluptatum, deserunt vel praesentium!</p>

                        <p class="shop__description--text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sapiente possimus sint amet ducimus repellat veniam natus. Eum pariatur non eius perspiciatis obcaecati distinctio consequatur modi voluptatum, deserunt vel praesentium!</p>

                        <p class="shop__description--text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident sapiente possimus sint amet ducimus repellat veniam natus. Eum pariatur non eius perspiciatis obcaecati distinctio consequatur modi voluptatum, deserunt vel praesentium!</p>

                    </div>

                    <div class="shop__purchase_container">

                        <form class="shop_form_container" id="shop_form" action="shop.php" accept-charset="UTF-8" method="post">
                        
                            <div class="product_dropdown__container">

                                <div class="product__type_label">

                                    <h2 class="product_dropdown__label">Available Products:</h2>

                                </div>

                                <div class="product__type_dropdown_container">

                                    <select class="product__type_dropdown js-product__type_dropdown" name="type_id" id="shop_type_dropdown" required>

                                        <option value selected disabled hidden>Select Pizza...</option>
 
                                        <?php foreach($aTypePizzas as $key => $aType): ?>

                                            <option class="js-product_option" value="<?= $aType['id']; ?>" <?php if($aType['quantity'] == 0): ?> disabled <?php endif; ?>><?= $aType['name']; ?> - €<?= number_format((float)$aType['price'], 2, '.', ''); ?> EUR <?php if($aType['quantity'] == 0): ?>| OUT OF STOCK<?php endif; ?></option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                            </div>

                            <div class="product__container">

                                <nav class="product__nav">

                                    <ul class="product__list">

                                        <?php foreach($aSqlTypeImages as $key => $aTypeImages): ?>
                                     
                                        <li class="product__single js-product-thumbnails<?php if($aTypeImages['quantity'] == 0 ): ?> disabled<?php endif; ?>" data-shop-product-id="<?= $aTypeImages['id']; ?>" id="product_thumbnail-<?= $aTypeImages['id']; ?>">
                                            
                                            <div class="product__img-wrap">

                                                <img class="product__thumb" src="assets/images/layout/<?= $aTypeImages['link']; ?>">

                                            </div>

                                        </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </nav>

                            </div>

                            <div class="shop_page__size_quantity_container">

                                <div class="product__size_container">

                                    <div class="product__size_label">

                                        <h2 class="product_dropdown__label">Select Size: </h2>
    
                                    </div>

                                    <div class="product__size_selector_menu_container">

                                        <select class="product__size_selector_menu" name="size_id" id="shop_size_selector">

                                            <?php foreach($aSizePizzas as $key => $aSize): ?>

                                            <option value="<?= $aSize['id']; ?>"><?= $aSize['size']; ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="product__quantity_container">

                                    <div class="product__quantity_label">

                                        <h2 class="product_dropdown__label">Quantity:</h2>

                                    </div>

                                    <div class="product__quantity_input_field_container">
                                
                                        <input class="product__quantity_input_field" type="number" name="quantity" min="1" max="999" value="1" id="shop_quantity_input">
                                    
                                    </div>

                                </div>

                            </div>

                            <div class="product__toppings_container">

                                <div class="product__toppings_label">

                                    <h2 class="product_dropdown__label">Toppings (optional): </h2>

                                </div>
                                
                                <div class="product__topping_list_container">

                                    <ul class="product__topping_list">

                                        <?php foreach($aToppingPizzas as $key => $aTopping): ?>

                                            <li class="product__topping_list_item">

                                                <span class="product__topping--label"><?= $aTopping['name']; ?> (+ €<?= number_format((float)$aTopping['price'], 2, '.', ''); ?>)</span>

                                                <input class="product__topping_checkbox--type" type="checkbox" name="topping_id[<?= $aTopping['id']; ?>]" value="<?= $aTopping['name']; ?>">

                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </div>

                            </div>

                            <div class="shop_transaction">

                                <button class="shop_button--transaction shop_form__submit" type="submit" value="Add to Cart">Add to Cart</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- TO DO, CREATE MODAL     -->

<?php include_once("inc/footer.php") ?>

<?php print('<!--'.date("YmdHis").'-->'); $jsFiles = getFiles(); echo loadFiles($jsFiles); ?>

</body>
</html>