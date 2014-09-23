<?php
/**
 * mySQL Enabled Order Header
 *
 * This is a mySQL enabled container for OrderHeader data at a typical eCommcerce site. It can easily be extended to include more fields as necessary.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class OrderHeader {
    /**
     * order id for the OrderHeader; this is the primary key
     **/
    private $orderHeaderId;
    /**
     * profile id of the person ordering; this is a foreign key to Profile
     * @see Profile
     **/
    private $profileId;
    /**
     * date and time Order was placed
     **/
    private $orderDate;
    /**
     * date and time order was shipped
     **/
    private $shipDate;
    
    /**
     * constructor for OrderHeader
     *
     * @param mixed $newOrderHeaderId order header id (or null if new object)
     * @param string $newProfileId profile id
     * @param mixed $newOrderDate order date
     * @param mixed $newShipDate ship date
     * @throws UnexpectedValueException when a parameter is of the wrong type
     * @throws RangeException when a parameter is invalid
     **/
    public function __construct($newOrderHeaderId, $newProfileId, $newOrderDate, $newShipDate) {
        try {
            $this->setOrderHeaderId($newOrderHeaderId);
            $this->setProfileId($newProfileId);
            $this->setOrderDate($newOrderDate);
            $this->setShipDate($newShipDate);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to the caller
            throw(new UnexpectedValueException("Unable to construct Order", 0, $unexpectedValue));
        } catch(RangeException $range) {
            // rethrow to the caller
            throw(new RangeException("Unable to construct Order", 0, $range));
        }
    }
    
     /**
     * gets the value of order header id
     *
     * @return mixed order header id (or null if new object)
     **/
    public function getOrderHeaderId() {
        return($this->orderHeaderId);
    }
    
    /**
     * sets the value of order header id
     *
     * @param mixed $newOrderHeaderId order header id (or null if new object)
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if order header id isn't positive
     **/
    public function setOrderHeaderId($newOrderHeaderId) {
        // zeroth, set allow the order header id to be null if a new object
        if($newOrderHeaderId === null) {
            $this->orderHeaderId = null;
            return;
        }
        
        // first, ensure the order id is an integer
        if(filter_var($newOrderHeaderId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("order header id $newOrderHeaderId is not numeric"));
        }
        
        // second, convert the order id to an integer and enforce it's positive
        $newOrderHeaderId = intval($newOrderHeaderId);
        if($newOrderHeaderId <= 0) {
            throw(new RangeException("order header id $newOrderHeaderId is not positive"));
        }
        
        // finally, take the order id out of quarantine and assign it
        $this->orderHeaderId = $newOrderHeaderId;
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
     * @param int $newProfileId profile id
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if profile id isn't positive
     **/
    public function setProfileId($newProfileId) {
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
     * gets the value of order date
     *
     * @return DateTime order date and time as a DateTime object
     * @see http://php.net/manual/en/class.datetime.php
     **/
    public function getOrderDate() {
        return($this->orderDate);
    }
    
    /**
     * sets the value of order date
     *
     * @param mixed $newOrderDate order date as a string in Y-m-d H:i:s format or as a DateTime object
     * @throws RangeException if the input is a string and cannot be parsed
     * @see http://php.net/manual/en/function.date.php
     * @see http://php.net/manual/en/class.datetime.php
     **/
    public function setOrderDate($newOrderDate) {
        // zeroth, if this is a DateTime object, assign it
        if(gettype($newOrderDate) === "object" && get_class($newOrderDate) === "DateTime") {
            $this->orderDate = $newOrderDate;
            return;
        }
        
        // first, cleanse the date string
        $newOrderDate = trim($newOrderDate);
        $newOrderDate = filter_var($newOrderDate, FILTER_SANITIZE_STRING);
        
        // second, use a regular expression to extract the date and verify it
        if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $newOrderDate, $matches)) !== 1) {
            throw(new RangeException("order date $newOrderDate is not a mySQL formatted date"));
        }
        
        // third, verify the date is a valid date
        $year  = intval($matches[1]);
        $month = intval($matches[2]);
        $day   = intval($matches[3]);
        if((checkdate($month, $day, $year)) === false) {
            throw(new RangeException("order date $newOrderDate is not a Gregorian date"));
        }
        
        // finally, convert the date to a DateTime object
        if(($dateTime = DateTime::createFromFormat("Y-m-d H:i:s", $newOrderDate)) === false) {
            throw(new RangeException("order date $newOrderDate cannot be converted to a DateTime object"));
        }
        $this->orderDate = $dateTime;
    }
    
    /**
     * gets the value of ship date
     *
     * @return DateTime ship date and time as a DateTime object
     * @see http://php.net/manual/en/class.datetime.php
     **/
    public function getShipDate() {
        return($this->shipDate);
    }
    
    /**
     * sets the value of ship date
     *
     * @param mixed $newShipDate ship date as a string in Y-m-d H:i:s format or as a DateTime object
     * @throws RangeException if the input is a string and cannot be parsed
     * @see http://php.net/manual/en/function.date.php
     * @see http://php.net/manual/en/class.datetime.php
     **/
    public function setShipDate($newShipDate) {
        // zeroth, if this is a DateTime object, assign it
        if(gettype($newShipDate) === "object" && get_class($newShipDate) === "DateTime") {
            $this->shipDate = $newShipDate;
            return;
        }
        
        // first, cleanse the date string
        $newShipDate = trim($newShipDate);
        $newShipDate = filter_var($newShipDate, FILTER_SANITIZE_STRING);
        
        // second, use a regular expression to extract the date and verify it
        if((preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $newShipDate, $matches)) !== 1) {
            throw(new RangeException("ship date $newShipDate is not a mySQL formatted date"));
        }
        
        // third, verify the date is a valid date
        $year  = intval($matches[1]);
        $month = intval($matches[2]);
        $day   = intval($matches[3]);
        if((checkdate($month, $day, $year)) === false) {
            throw(new RangeException("ship date $newShipDate is not a Gregorian date"));
        }
        
        // finally, convert the date to a DateTime object
        if(($dateTime = DateTime::createFromFormat("Y-m-d H:i:s", $newShipDate)) === false) {
            throw(new RangeException("ship date $newShipDate cannot be converted to a DateTime object"));
        }
        $this->shipDate = $dateTime;
    }
}
?>