<?php
/**
 * mySQL Enabled User
 *
 * This is a mySQL enabled container for User authentication at a typical eCommcerce site. It can easily be extended to include more fields as necessary.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @see Profile
 **/
class User {
    /**
     * user id for the User; this is the primary key
     **/
    private $userId;
    /**
     * email for the User; this is a unique field
     **/
    private $email;
    /**
     * SHA512 PBKDF2 hash of the password
     **/
    private $password;
    /**
     * salt used in the PBKDF2 hash
     **/
    private $salt;
    /**
     * authentication token used in new accounts and password resets
     **/
    private $authenticationToken;
    
    /**
     * constructor for User
     *
     * @param mixed $newUserId user id (or null if new object)
     * @param string $newEmail email
     * @param string $newPassword PBKDF2 hash of the password
     * @param string $newSalt salt used in the PBKDF2 hash
     * @param mixed $newAuthenticationToken authentication token used in new accounts and password resets (or null if active User)
     * @throws UnexpectedValueException when a parameter is of the wrong type
     * @throws RangeException when a parameter is invalid
     **/
    public function __construct($newUserId, $newEmail, $newPassword, $newSalt, $newAuthenticationToken) {
        try {
            $this->setUserId($newUserId);
            $this->setEmail($newEmail);
            $this->setPassword($newPassword);
            $this->setSalt($newSalt);
            $this->setAuthenticationToken($newAuthenticationToken);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to the caller
            throw(new UnexpectedValueException("Unable to construct User", 0, $unexpectedValue));
        } catch(RangeException $range) {
            // rethrow to the caller
            throw(new RangeException("Unable to construct User", 0, $range));
        }
    }
    
    /**
     * gets the value of user id
     *
     * @return mixed user id (or null if new object)
     **/
    public function getUserId() {
        return($this->userId);
    }
    
    /**
     * sets the value of user id
     *
     * @param mixed $newUserId user id (or null if new object)
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if user id isn't positive
     **/
    public function setUserId($newUserId) {
        // zeroth, set allow the user id to be null if a new object
        if($newUserId === null) {
            $this->userId = null;
            return;
        }
        
        // first, ensure the user id is an integer
        if(filter_var($newUserId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("user id $newUserId is not numeric"));
        }
        
        // second, convert the user id to an integer and enforce it's positive
        $newUserId = intval($newUserId);
        if($newUserId <= 0) {
            throw(new RangeException("user id $newUserId is not positive"));
        }
        
        // finally, take the profile id out of quarantine and assign it
        $this->userId = $newUserId;
    }
    
    /**
     * gets the value of email
     *
     * @return string value of email
     **/
    public function getEmail() {
        return($this->email);
    }
    
    /**
     * sets the value of email
     *
     * @param string $newEmail email
     * @throws UnexpectedValueException if the input doesn't appear to be an Email
     **/
    public function setEmail($newEmail) {
        // sanitize the Email as a likely Email
        $newEmail = trim($newEmail);
        if(($newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL)) == false) {
            throw(new UnexpectedValueException("email $newEmail does not appear to be an email address"));
        }
        
        // then just take email out of quarantine
        $this->email = $newEmail;
    }
    
    /**
     * gets the value of password
     *
     * @return string value of password
     **/
    public function getPassword() {
        return($this->password);
    }
    
    /**
     * sets the value of password
     *
     * @param string $newPassword SHA512 PBKDF2 hash of the password
     * @throws RangeException when input isn't a valid SHA512 PBKDF2 hash
     **/
    public function setPassword($newPassword) {
        // verify the password is 128 hex characters
        $newPassword   = trim($newPassword);
        $newPassword   = strtolower($newPassword);
        $filterOptions = array("options" => array("regexp" => "/^[\da-f]{128}$/"));
        if(filter_var($newPassword, FILTER_VALIDATE_REGEXP, $filterOptions) === false) {
            throw(new RangeException("password is not a valid SHA512 PBKDF2 hash"));
        }
        
        // finally, take the password out of quarantine
        $this->password = $newPassword;
    }
    
    /** 
     * gets the value of salt
     *
     * @return string value of salt
     **/
    public function getSalt() {
        return($this->salt);
    }
    
    /**
     * sets the value of salt
     *
     * @param string $newSalt salt (64 hexadecimal bytes)
     * @throws RangeException when input isn't 64 hexadecimal bytes
     **/
    public function setSalt($newSalt) {
        // verify the salt is 64 hex characters
        $newSalt   = trim($newSalt);
        $newSalt   = strtolower($newSalt);
        $filterOptions = array("options" => array("regexp" => "/^[\da-f]{64}$/"));
        if(filter_var($newSalt, FILTER_VALIDATE_REGEXP, $filterOptions) === false) {
            throw(new RangeException("salt is not 64 hexadecimal bytes"));
        }
        
        // finally, take the salt out of quarantine
        $this->salt = $newSalt;
    }
    
    /**
     * gets the value of authentication token
     *
     * @return mixed value of authentication token (or null if active User)
     **/
    public function getAuthenticationToken() {
        return($this->authenticationToken);
    }
    
    /**
     * sets the value of authentication token
     *
     * @param mixed $newAuthenticationToken authentication token (32 hexadecimal bytes) (or null if active User)
     * @throws RangeException when input isn't 32 hexadecimal bytes
     **/
    public function setAuthenticationToken($newAuthenticationToken) {
        // zeroth, set allow the authentication token to be null if an active object
        if($newAuthenticationToken === null) {
            $this->authenticationToken = null;
            return;
        }
        
        // verify the authentication token is 32 hex characters
        $newAuthenticationToken   = trim($newAuthenticationToken);
        $newAuthenticationToken   = strtolower($newAuthenticationToken);
        $filterOptions = array("options" => array("regexp" => "/^[\da-f]{32}$/"));
        if(filter_var($newAuthenticationToken, FILTER_VALIDATE_REGEXP, $filterOptions) === false) {
            throw(new RangeException("salt is not 64 hexadecimal bytes"));
        }
        
        // finally, take the authentication token out of quarantine
        $this->authenticationToken = $newAuthenticationToken;
    }
}
?>