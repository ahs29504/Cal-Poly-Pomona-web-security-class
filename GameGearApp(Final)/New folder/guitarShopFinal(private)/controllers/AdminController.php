<?php

/**
 * Controller that handles administrator functions of the guitarShop
 * application.
 *
 * @author jam
 * @version 210307
 */
class AdminController extends DefaultController {

    protected $model = null;

    public function __construct() {
        parent::__construct();
    }

    public function loginGET() {
        Page::$title = 'guitarShop - Login';
		$vm = ProductsVM::getCategoriesInstance();
        require(APP_NON_WEB_BASE_DIR . 'views/login.php');
    }
    
    public function loginPOST() {
		after_successful_logout();
    	$vm = LoginVM::getInstance();
    	if ($vm->userType === LoginVM::VALID_LOGIN) {
    		$this->listProducts();
    	} else {
    		$vm = ProductsVM::getCategoriesInstance();
    		Page::$title = 'guitarShop - Invalid Credentials';
    		require(APP_NON_WEB_BASE_DIR .'views/loginFailed.php');
    	}
    }
	
	public function registerGET() {
        $vm = ProductsVM::getCategoriesInstance();
        Page::$title = 'guitarShop - Register';
        require(APP_NON_WEB_BASE_DIR . 'views/register.php');
    }
    
    public function registerPOST() {
        $vm = RegisterVM::getInstance();
        if ($vm->registrationType === RegisterVM::VALID_REGISTRATION) {
            Page::$title = 'guitarShop - New Account';
            require(APP_NON_WEB_BASE_DIR .'views/registrationSuccess.php');
        } else {
            Page::$title = 'guitarShop - Invalid Registration';
            require(APP_NON_WEB_BASE_DIR .'views/registrationErrors.php');
        }
    }

    public function listProducts() {
		before_every_protected_page();
        $vm = ProductsVM::getCategoryInstance();
        Page::$title = 'Listing Mgr. - ' . $vm->category->name;
        require(APP_NON_WEB_BASE_DIR . 'views/adminProductList.php');
    }

    public function viewProduct() {
		before_every_protected_page();
        $vm = ProductsVM::getProductInstance();
        Page::$title = 'Listing Mgr. - ' . $vm->product->name;
        require(APP_NON_WEB_BASE_DIR . 'views/adminProductView.php');
    }

    public function deleteProduct() {
		before_every_protected_page();
        $vmDelete = ProductsVM::getDeleteInstance();
        $vm = ProductsVM::getCategoryInstance($vmDelete->category->id);
        Page::$title = 'Listing Mgr. - ' . $vm->category->name;
        require(APP_NON_WEB_BASE_DIR . 'views/adminProductList.php');
    }
    
    /**
     * Supports views that display add new product listing form
     */
    public function showAddProduct() {
		before_every_protected_page();
		$vm = ProductsVM::getCategoriesInstance();
        Page::$title = 'Listing Mgr. - Add Product';
        require(APP_NON_WEB_BASE_DIR . 'views/addProduct.php');
    }
    
    /**
     * Adds a new product listing to the database or updates an existing listing
     */
    public function addEditProduct() {
		before_every_protected_page();
        $vmAdd = ProductsVM::getAddEditInstance();
        $vm = ProductsVM::getCategoryInstance($vmAdd->category->id);
        Page::$title = 'Listing Mgr. - ' . $vm->category->name;
        require(APP_NON_WEB_BASE_DIR . 'views/adminProductList.php');
    }
    
	
	 /**
     * Displays the form to edit a product listing
     */
    public function showEditProduct() {
        $vm = ProductsVM::getEditProductInstance();
        Page::$title = 'Listing Mgr. - Edit ' . $vm->product->name;
        require(APP_NON_WEB_BASE_DIR . 'views/editProduct.php');
    }
	
	
	public function logout() { 
	after_successful_logout(); 
	require(APP_NON_WEB_BASE_DIR .'views/home.php'); 
	}
	
}