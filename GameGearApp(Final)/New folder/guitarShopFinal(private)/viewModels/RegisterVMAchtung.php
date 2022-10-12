<?php

/**
 * View model for user registration functions.
 *
 * @author jam
 * @version 210307
 */
class RegisterVM {

    public $enteredPW;
    public $enteredConfPW;
    public $registrationType;
    public $errorMsg;
    public $statusMsg;
    public $newUser;
	public $categories;
	private $categoryDAM;
	private $userDAM;

    
    // User type constants used for switching in the controller.
    const VALID_REGISTRATION = 'valid_registration';
    const INVALID_REGISTRATION = 'invalid_registration';
    
    public function __construct() {
		$this->categoryDAM = new CategoryDAM();
		$this->userDAM = new UserDAM();
        $this->errorMsg = '';
        $this->statusMsg = array();
        $this->enteredPW = '';
        $this->enteredConfPW = '';
        $this->registrationType = self::INVALID_REGISTRATION;
        $this->newUser = null;
		$this->categories = $this->categoryDAM->readCategories();
    }

    public static function getInstance() {
        $vm = new self();
        
        $varArray = array('email' => emailPost('email'),
        		'lastName' => hPOST('lastName'),
        		'firstName' => hPOST('firstName'),
        		'phoneNumber' => hPOST('phoneNumber'));
        $vm->newUser = new User($varArray);
        $vm->enteredPW = hPOST('password');
        $vm->enteredConfPW = hPOST('confirmPassword');
        if ($vm->validateUserInput()) {
			$vm->newUser->password = password_hash($vm->enteredPW,PASSWORD_DEFAULT);
			$vm->userDAM->writeUser($vm->newUser);
            $vm->registrationType = self::VALID_REGISTRATION;
			
        }
        return $vm;
    }
      
    private function validateUserInput() {
      	$success = false;
		
		if ($this->newUser->lastName == null){
			$this->errorMsg = 'Last name is required.';
		} else if ($this->newUser->firstName == null) {
			$this->errorMsg = 'First name is required.'; 
		} else if ($this->newUser->email == null) {
			$this->errorMsg = 'A valid email is required';
		} else if ($this->newUser->phoneNumber == null){
			$this->errorMsg = 'A valid phone number is requred.';
		}else if(!preg_match("/\A\(?\d{3}\)?\s?\-?\d{3}\s?\-?\d{4}\Z/", $this->newUser->phoneNumber, $match)){
            $this->errorMsg = 'A Valid phone number format is required;XXX-XXX-XXXX .';	
		} else if ($this->enteredPW == null) {
		 	$this->errorMsg = 'Password required';
		} else if ($this->enteredConfPW == null) {
			$this->errorMsg = 'Password confirmation required.';
		} else if ($this->enteredConfPW != $this->enteredPW){
			$this->errorMsg = 'Password and confirmation password are different.';
		} else {
			$success = true;
		}
		return $success;
	
		} 
		
}
		
	//		} else if (preg_match('/\A[2-9]\d{3}-\d{3}-\d{4}\Z/',$phoneNumber)){
//		$this->errorMsg = 'A valid phone number is required'; 
	
	
	
	/*
	
	$username = $_POST['username']
	
	
	Validate Presense On (Loops through required fields & Looks for $_POST Superglobal)
	
	function validate_presence_on($required_fields) {
		global $errors;
		foreach($required_fields as $varArray) {
		if (!has_presence($_POST[$varArray])) {
      $errors[$varArray = "'" . $varArray . "' can't be blank";
    }
	}
	}
	
	// * validate value has presence
	// use trim() so empty spaces don't count
	// use === to avoid false positives
	// empty() would consider "0" to be empty
	
	private function has_presence($value) {
		$trimmed_value = trim($value);
			return isset($trimmed_value) && $trimmed_value !== "";
	}
	
	
	// * validate value has string length
	// leading and trailing spaces will count
	// options: exact, max, min
	// has_length($first_name, ['exact' => 20])
	// has_length($first_name, ['min' => 5, 'max' => 100])
	private function has_length($value, $options=[]) {
	
	if(isset($options['max']) && (strlen($value) > (int)$options['max'])) {
		return false;
	}
	
	if(isset($options['min']) && (strlen($value) < (int)$options['min'])) {
		return false;
	}
	if(isset($options['exact']) && (strlen($value) != (int)$options['exact'])) {
		return false;
	}
	return true;
	}


//Validate Regex
// * validate value has a format matching a regular expression
// Be sure to use anchor expressions to match start and end of string.
// (Use \A and \Z, not ^ and $ which allow line returns.)

//Example: 
// has_format_matching('1234', '/\d{4}/') is true
// has_format_matching('12345', '/\d{4}/') is also true
 has_format_matching('12345', '/\A\d{4}\Z/') is false 
	private function has_format_matching($value, $regex='/\A[2-9]\d{2}-\d{3}-\d{4}\Z/') {
	return preg_match($regex, $value);
}

// * validate value is a number
// submitted values are strings, so use is_numeric instead of is_int
// options: max, min
// has_number($items_to_order, ['min' => 1, 'max' => 5])

	private function has_number($value, $options=[]) {
	if(!is_numeric($value)) {
		return false;
	}
	if(isset($options['max']) && ($value > (int)$options['max'])) {
		return false;
	}
	if(isset($options['min']) && ($value < (int)$options['min'])) {
		return false;
	}
	return true;
}

}

// * validate value is inclused in a set
	private function has_inclusion_in($value, $set=[]) {
  return in_array($value, $set);
}

// * validate value is excluded from a set
	private function has_exclusion_from($value, $set=[]) {
  return !in_array($value, $set);
}
*/

		// If all validation tests pass, set $success = true.
        
      