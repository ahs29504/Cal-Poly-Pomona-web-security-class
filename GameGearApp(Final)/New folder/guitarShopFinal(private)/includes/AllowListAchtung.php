<?php

/**
 * Contains GET request allow-list for the guitarShop application.
 * 
 * @author jam
 * @version 210220
 */
class AllowList {
    
    // Set the allow list.
    private static $allowList = array('listProducts','editProduct', 'viewProduct', 'login', 'addProduct',
    		'register', 'deleteProduct');
    
		
    public static function getList() {
        return self::$allowList;
    }
	
	
}