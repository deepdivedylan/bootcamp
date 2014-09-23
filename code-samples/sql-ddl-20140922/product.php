<?php
/**
 * mySQL Enabled Product
 *
 * This is a mySQL enabled container for Product data at a typical eCommcerce site. It can easily be extended to include more fields as necessary.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class Product {
    /**
     * product id for the Product; this is the primary key
     **/
    private $productId;
    /**
     * product name
     **/
    private $productName;
    /**
     * product description
     **/
    private $description;
    /**
     * product price
     **/
    private $price;
    
    /**
     * constructor for Product
     *
     * @param mixed $newProductId product id (or null if new object)
     * @param string $newProductName product name
     * @param string $newDescription description
     * @param float $newPrice price
     * @throws UnexpectedValueException when a parameter is of the wrong type
     * @throws RangeException when a parameter is invalid
     **/
    public function __construct($newProductId, $newProductName, $newDescription, $newPrice) {
        try {
            $this->setProductId($newProductId);
            $this->setProductName($newProductName);
            $this->setDescription($newDescription);
            $this->setPrice($newPrice);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to the caller
            throw(new UnexpectedValueException("Unable to construct Product", 0, $unexpectedValue));
        } catch(RangeException $range) {
            // rethrow to the caller
            throw(new RangeException("Unable to construct Product", 0, $range));
        }
    }
    
    /**
     * gets the value of product id
     *
     * @return mixed product id (or null if new object)
     **/
    public function getProductId() {
        return($this->productId);
    }
    
    /**
     * sets the value of product id
     *
     * @param mixed $newProductId product id (or null if new object)
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if product id isn't positive
     **/
    public function setProductId($newProductId) {
        // zeroth, set allow the product id to be null if a new object
        if($newProductId === null) {
            $this->productId = null;
            return;
        }
        
        // first, ensure the product id is an integer
        if(filter_var($newProductId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("product id $newProductId is not numeric"));
        }
        
        // second, convert the product id to an integer and enforce it's positive
        $newProductId = intval($newProductId);
        if($newProductId <= 0) {
            throw(new RangeException("product id $newProductId is not positive"));
        }
        
        // finally, take the product id out of quarantine and assign it
        $this->productId = $newProductId;
    }
    
    /**
     * gets the value of product name
     *
     * @return string product name
     **/
    public function getProductName() {
        return($this->productName);
    }
    
    /**
     * sets the value of product name
     *
     * @param string $newProductName product name
     **/
    public function setProductName($newProductName) {
        // filter the product name as a generic string
        $newProductName = trim($newProductName);
        $newProductName = filter_var($newProductName, FILTER_SANITIZE_STRING);
        
        // then just take the product name out of quarantine
        $this->productName = $newProductName;
    }
    
    /**
     * gets the value of description
     *
     * @return string description
     **/
    public function getDescription() {
        return($this->description);
    }
    
    /**
     * sets the value of product name
     *
     * @param string $newDescription product name
     **/
    public function setDescription($newDescription) {
        // filter the description as a generic string
        $newDescription = trim($newDescription);
        $newDescription = filter_var($newDescription, FILTER_SANITIZE_STRING);
        
        // then just take the description out of quarantine
        $this->description = $newDescription;
    }
    
    /**
     * gets the value of price
     *
     * @return float price
     **/
    public function getPrice() {
        return($this->price);
    }
    
    /**
     * sets the value of price
     *
     * @param float $newPrice price
     * @throws UnexpectedValueException if not a double
     * @throws RangeException if price isn't positive
     **/
    public function setPrice($newPrice) {
        // first, ensure the product id is a double
        if(filter_var($newPrice, FILTER_VALIDATE_FLOAT) === false) {
            throw(new UnexpectedValueException("product id $newProductId is not numeric"));
        }
        
        // second, convert the product id to a double and enforce it's positive
        $newPrice = floatval($newPrice);
        if($newPrice <= 0) {
            throw(new RangeException("product id $newPrice is not positive"));
        }
        
        // finally, take the product id out of quarantine and assign it
        $this->price = $newPrice;
    }
}
?>