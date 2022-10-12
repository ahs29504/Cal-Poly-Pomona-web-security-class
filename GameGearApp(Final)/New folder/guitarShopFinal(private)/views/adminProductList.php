<?php require('views/guitarShopAdminHeader.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
  
  
  
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
                  <div class="well">
        <h4>My Profile</h4>
      
 </br>


   <h4>Listing Categories</h4>
                <ul>
                    <!-- display links for all categories -->
                    <?php foreach ($vm->categories as $category) { ?>
                        <li>
                            <a href="?ctlr=admin&amp;action=listProducts&amp;categoryId=<?php echo $category->id; ?>">
                                <?php echo $category->name; ?>
                            </a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </nav>
	
 </br>

        <p><a href="?ctlr=admin&amp;action=addProduct&amp;add_edit_product_form=">Add Product</a></p>	
  
  </br>


        <p><a href=".">Logout</a></p>
       
      </div>
	  
	 </br>
     
        </div>
        <div class="col-lg-6">
            
<h1>My Game Listings</h1>
    <p>To view or edit, select the product.</p>
    <p>To add a product, select the "Add Product" link.</p>
    <?php if (count($vm->products) == 0) { ?>
        <ul><li>There are no products for this category.</li></ul>
    <?php } else { ?>
        <h2><?php echo $vm->category->name; ?></h2>
        <ul>
            <?php foreach ($vm->products as $product) { ?>
            <li>
                <a href="?ctlr=admin&amp;action=viewProduct&amp;productId=<?php
                          echo $product->id; ?>">
                    <?php echo $product->name; ?>
                </a>
            </li>
            <?php } ?>
     
    <?php } ?>
        </div>
    </div>
</div>






<?php require('views/guitarShopFooter.php');