<?php
/**
 * mySQL Enabled OrderLine
 *
 * This is a mySQL enabled container for OrderLine data at a typical eCommcerce site. It can easily be extended to include more fields as necessary.
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/
class OrderLine {
    /**
     * order id of the parent order; this is a foreign key to Order
     * @see Profile
     **/
    private $orderId;
    /**
     * product id of the product ordered; this is a foreign key to Product
     * @see Profile
     **/
    private $productId;
    /**
     * quantity ordered
     **/
    private $quantity;
    /**
     * discount amount for this OrderLine
     **/
    private $discount;
    
    /**
     * constructor for OrderLine
     *
     * @param int $newOrderId order id
     * @param int $newProductId product id
     * @param int $newQuantity quantity
     * @param float $newDiscount discount amount
     * @throws UnexpectedValueException when a parameter is of the wrong type
     * @throws RangeException when a parameter is invalid
     **/
    public function __construct($newOrderId, $newProductId, $newQuantity, $newDiscount) {
        try {
            $this->setOrderId($newOrderId);
            $this->setProductId($newProductId);
            $this->setQuantity($newQuantity);
            $this->setDiscount($newDiscount);
        } catch(UnexpectedValueException $unexpectedValue) {
            // rethrow to the caller
            throw(new UnexpectedValueException("Unable to construct OrderLine", 0, $unexpectedValue));
        } catch(RangeException $range) {
            // rethrow to the caller
            throw(new RangeException("Unable to construct OrderLine", 0, $range));
        }
    }
    
    /**
     * gets the value of order id
     *
     * @return int order id
     **/
    public function getOrderId() {
        return($this->orderId);
    }
    
    /**
     * sets the value of order id
     *
     * @param int $newOrderId order id
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if order id isn't positive
     **/
    public function setOrderId($newOrderId) {
        
        // first, ensure the order id is an integer
        if(filter_var($newOrderId, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("order id $newOrderId is not numeric"));
        }
        
        // second, convert the order id to an integer and enforce it's positive
        $newOrderId = intval($newOrderId);
        if($newOrderId <= 0) {
            throw(new RangeException("order id $newOrderId is not positive"));
        }
        
        // finally, take the order id out of quarantine and assign it
        $this->orderId = $newOrderId;
    }
    
    /**
     * gets the value of product id
     *
     * @return int value of product id
     **/
    public function getProductId() {
        return($this->productId);
    }
    
    /**
     * sets the value of product id
     *
     * @param int $newProductId product id
     * @throws UnexpectedValueException if not an integer or null
     * @throws RangeException if product id isn't positive
     **/
    public function setProductId($newProductId) {
        // first, ensure the profile id is an integer
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
     * gets the value of quantity
     *
     * @return mixed value of quantity
     **/
    public function getQuantity() {
        return($this->quantity);
    }
    
    /**
     * sets the value of quantity
     *
     * @param int $newQuantity quantity
     * @throws UnexpectedValueException if not an integer
     * @throws RangeException if quantity isn't positive
     **/
    public function setQuantity($newQuantity) {
        // first, ensure the profile id is an integer
        if(filter_var($newQuantity, FILTER_VALIDATE_INT) === false) {
            throw(new UnexpectedValueException("quantity $newQuantity is not numeric"));
        }
        
        // second, convert the profile id to an integer and enforce it's positive
        $newQuantity = intval($newQuantity);
        if($newQuantity <= 0) {
            throw(new RangeException("quantity $newQuantity is not positive"));
        }
        
        // finally, take the quantity out of quarantine and assign it
        $this->quantity = $newQuantity;
    }
    
    /**
     * gets the value of discount
     *
     * @return mixed value of discount
     **/
    public function getDiscount() {
        return($this->discount);
    }
    
    /**
     * sets the value of discount
     *
     * @param int $newDiscount discount
     * @throws UnexpectedValueException if not a double
     * @throws RangeException if discount isn't negative
     **/
    public function setDiscount($newDiscount) {
        // first, ensure the profile id is an integer
        if(filter_var($newDiscount, FILTER_VALIDATE_FLOAT) === false) {
            throw(new UnexpectedValueException("discount $newDiscount is not numeric"));
        }
        
        // second, convert the profile id to an integer and enforce it's negative
        $newDiscount = floatval($newDiscount);
        if($newDiscount >= 0) {
            throw(new RangeException("discount $newDiscount is not negative"));
        }
        
        // finally, take the discount out of quarantine and assign it
        $this->discount = $newDiscount;
    }
}
?>
