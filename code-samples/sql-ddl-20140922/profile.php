<?php
/**
 * mySQL Enabled Profile
 *
 * This is a mySQL enabled container for a Profile containing ancillary data on a user at a typical eCommcerce site. It can easily be extended to include more fields as necessary.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @see User
 **/
class Profile {
    /**
     * profile id for this Profile; this is the primary key
     **/
    private $profileId;
    /**
     * user id for this Profile
     * @see User
     **/
    private $userId;
    /**
     * full name of the person
     **/
    private $name;
    /**
     * first line of the postal address
     **/
    private $address1;
    /**
     * second line of the postal address
     **/
    private $address2;
    /**
     * city in the Profile's address
     **/
    private $city;
    /**
     * state in the Profile's address
     **/
    private $state;
    /**
     * zip code in the Profile's address
     **/
    private $zipCode;
    /**
     * phone number associated with this Profile
     **/
    private $phone;
    
    /**
     * constructor for Profile
     *
     * @param mixed $newProfileId profile id (or null if new object)
     * @param int $newUserId user id
     * @param string $newName full name of the person
     * @param string $newAddress1 first line of postal address
     * @param mixed $newAddress2 second line of postal address
     * @param string $newCity city in the Profile's address
     * @param string $newState state in the Profile's address
     * @param string $newZipCode zip code in the Profile's address
     * @param string $newPhone phone number associated with the Profile
     * @throws UnexpectedValueException when a parameter is of the wrong type
     * @throws RangeException when a parameter is invalid
     **/
    public function __construct($newProfileId, $newUserId, $newName, $newAddress1, $newAddress2, $newCity, $newState, $newZipCode, $newPhone) {
        try {
            $this->setProfileId($newProfileId);
            $this->setUserId($newUserId);
            $this->setName($newName);
            $this->setAddress1($newAddress1);
            $this->setAddress2($newAddress2);
            $this->setCity($newCity);
            $this->setState($newState);
            $this->setZipCode($newZipCode);
            $this->setPhone($newPhone);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to the caller
            throw(new UnexpectedValueException("Unable to construct Profile", 0, $unexpectedValue));
        } catch(RangeException $range) {
            // rethrow to the caller
            throw(new RangeException("Unable to construct Profile", 0, $range));
        }
    }
    
    /**
     * gets the value of profile id
     *
     * @return mixed value of profile id (or null if new object)
     **/
    public function getProfileId() {
        return($this->profileId);
    }

    /**
     * sets the value of profile id
     *
     * @param mixed $newProfileId profile id (or null if new object)
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if profile id isn't positive
     **/
    public function setProfileId($newProfileId) {
        // zeroth, set allow the profile id to be null if a new object
        if($newProfileId === null) {
            $this->profileId = null;
            return;
        }
        
        // first, ensure the profile id is an integer
        if(filter_var($newProfileId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("profile id $newProfileId is not numeric"));
        }
        
        // second, convert the profile id to an integer and enforce it's positive
        $newProfileId = intval($newProfileId);
        if($newProfileId <= 0) {
            throw(new RangeException("profile id $newProfileId is not positive"));
        }
        
        // finally, take the profile id out of quarantine and assign it
        $this->profileId = $newProfileId;
    }

    /**
     * gets the value of user id
     *
     * @return int value of user id
     **/
    public function getUserId() {
        return($this->userId);
    }

    /**
     * sets the value of user id
     *
     * @param $newUserId int user id
     * @throws UnexpectedValueException if not an integer
     * @throws RangeException if user id isn't positive
     **/
    public function setUserId($newUserId) {
        // first, ensure the user id is an integer
        if(filter_var($newUserId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("user id $newUserId is not numeric"));
        }
        
        // second, convert the user id to an integer and enforce it's positive
        $newUserId = intval($newUserId);
        if($newUserId <= 0) {
            throw(new RangeException("user id $newUserId is not positive"));
        }
        
        // finally, take the user id out of quarantine and assign it
        $this->userId = $newUserId;
    }

    /**
     * gets the value of name
     *
     * @return string value of name
     **/
    public function getName() {
        return($this->name);
    }

    /**
     * sets the value of name
     *
     * @param string $newName name
     **/
    public function setName($newName) {
        // filter the name as a generic string
        $newName = trim($newName);
        $newName = filter_var($newName, FILTER_SANITIZE_STRING);
        
        // then just take the name out of quarantine
        $this->name = $newName;
    }

    /**
     * gets the value of the first line of the postal address
     *
     * @return string first line of the postal address
     **/
    public function getAddress1() {
        return($this->address1);
    }

    /**
     * sets the value of the first line of the postal address
     *
     * @param string $newAddress1 first line of the postal address
     **/
    public function setAddress1($newAddress1) {
        // filter the address as a generic string
        $newAddress1 = trim($newAddress1);
        $newAddress1 = filter_var($newAddress1, FILTER_SANITIZE_STRING);
        
        // then just take the address out of quarantine
        $this->address1 = $newAddress1;
    }

    /**
     * gets the value of the second line of the postal address
     *
     * @return string second line of the postal address
     **/
    public function getAddress2() {
        return($this->address2);
    }

    /**
     * sets the value of the second line of the postal address
     *
     * @param mixed $newAddress2 second line of the postal address or null
     **/
    public function setAddress2($newAddress2) {
        // zeroth, set allow the address2 to be null if it doesn't apply
        if($newAddress2 === null) {
            $this->address2 = null;
            return;
        }
        
        // filter the address as a generic string
        $newAddress2 = trim($newAddress2);
        $newAddress2 = filter_var($newAddress2, FILTER_SANITIZE_STRING);
        
        // then just take the address out of quarantine
        $this->address2 = $newAddress2;
    }

    /**
     * gets the value of city
     *
     * @return string city
     **/
    public function getCity() {
        return($this->city);
    }

    /**
     * sets the value of city
     *
     * @param string $newCity city
     **/
    public function setCity($newCity) {
        // filter the city as a generic string
        $newCity = trim($newCity);
        $newCity = filter_var($newCity, FILTER_SANITIZE_STRING);
        
        // then just take the city out of quarantine
        $this->city = $newCity;
    }

    /**
     * gets the value of state
     *
     * @return string state
     **/
    public function getState() {
        return($this->state);
    }

    /**
     * sets the value of state
     *
     * @param string $newState USPS state abbreviation
     * @throws RangeException when input doesn't conform to USPS standards
     **/
    public function setState($newState) {
        // verify the state is a two letter abbreviation
        $newState      = trim($newState);
        $filterOptions = array("options" => array("regexp" => "/^[A-Z]{2}$/"));
        if(filter_var($newState, FILTER_VALIDATE_REGEXP, $filterOptions) === false) {
            throw(new RangeException("state $newState is not a postal abbreviation"));
        }
        
        // finally, take the state out of quarantine
        $this->state = $newState;
    }

    /**
     * gets the value of zip code
     *
     * @return string zip code
     **/
    public function getZipCode() {
        return($this->zipCode);
    }

    /**
     * sets the value of zip code
     *
     * @param string $newZipCode zip code
     * @throws RangeException when input doesn't conform to USPS standards
     **/
    public function setZipCode($newZipCode) {
        // verify the zip code is in valid form
        $newZipCode    = trim($newZipCode);
        $filterOptions = array("options" => array("regexp" => "/^\d{5}(-\d{4})?$/"));
        if(filter_var($newZipCode, FILTER_VALIDATE_REGEXP, $filterOptions) === false) {
            throw(new RangeException("zip $newZipCode is not a ZIP code"));
        }
        
        // finally, take the zip code out of quarantine
        $this->zipCode = $newZipCode;
    }

    /**
     * gets the value of phone
     *
     * @return string phone
     **/
    public function getPhone() {
        return($this->phone);
    }

    /**
     * sets the value of phone
     *
     * @param string $newPhone phone
     **/
    public function setPhone($newPhone) {
        // filter phone as a generic string
        $newPhone = trim($newPhone);
        $newPhone = filter_var($newPhone, FILTER_SANITIZE_STRING);
        
        // then just take the phone out of quarantine
        $this->phone = $newPhone;
    }
}
?>