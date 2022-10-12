

<?php require('views/guitarShopHeader.php'); ?>


<main>
<section>
    <h1>Register for GameGear App</h1>
    <?php 
        if ($vm != null) {
            if ($vm->errorMsg != '') { ?>
            <p> <?php echo $vm->errorMsg; ?></p>
    <?php }
        }?>
    <form action="." method="post" id="add_edit_product_form">
        <input type="hidden" name="ctlr" value="admin" />
        <input type="hidden" name="action" value="register" />
		
        
        <label>Email:</label>
        <input type="text" name="email"><br>

        <label>First Name:</label>
        <input type="text" name="firstName"><br>

        <label>Last Name:</label>
        <input type="text" name="lastName"><br>
		
		<label>Phone Number:</label>
        <input type="text" name="phoneNumber"><br>

        <label>Password:</label>
        <input type="password" name="password"><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirmPassword"><br>

        <label>&nbsp;</label>
        <input type="submit" value="Sign Up">
		<?php echo csrf_token_tag(); ?>
    </form>
    
</section>
</main>
<?php require('views/guitarShopFooter.php');