<?php
    /* Copyright (c) - 2021 by Junyi Xie */	
    
    namespace Sopranos;

    /**
     * Sopranos Pizzabar Orders class
     *     
     * @author Junyi Xie
     * @version 1.0
     */
    class Orders 
    {

        /**
         * Website base URL.
         */
        const BASE_URL = 'http://localhost:8080/sopranos/';


        /**
         * The order number.
         *
         * @var int
         */
        private $number;


        /**
         * The customer order(s) put in an array. 
         *
         * @var array
         */
        private $order;


        /**
         * The customer data put in an array.
         *
         * @var array
         */
        private $customer;


        /**
         * Coupon id.
         *
         * @var array
         */
        private $coupon;


        /**
         * Customer Inserted Id.
         *
         * @var int
         */
        private $_customer_id;


        /**
         * Order Inserted Id.
         *
         * @var int
         */
        private $_order_id;


        /**
         * Pizza Size Inserted Id.
         *
         * @var int
         */
        private $_size_id;


        /**
         * Pizza Topping Inserted Id.
         *
         * @var int
         */
        private $_topping_id;


        /**
         * Pizza Type Inserted Id.
         *
         * @var int
         */
        private $_type_id;


        /**
         * Pizza Order Inserted Id.
         *
         * @var int
         */
        private $_pizza_id;


        /**
         * Pizza Quantity.
         *
         * @var int
         */
        private $_pizza_quantity;


        /**
         * PDO.
         *
         * @var object
         */
        private $pdo;


        /**
         * Default constructor.
         * 
         * @param object $pdo
         *
         * @return void
         * 
         * @throws \Exception - Config data not complete.
         */
        public function __construct($config, $pdo) {

                if(is_object($pdo) && !is_null($pdo)) {
                    $this->setPDO($pdo);
                }


            if(is_array($config)) {

                $this->setNumber($config['number']);
                $this->setOrder($config['order']);
                $this->setCustomer($config['customer']);
                $this->setCoupon($config['coupon']);

            } else {

                throw new \Exception('Error: __construct() - Configuration data is missing.');
            }
        }


        /**
         * Check for duplicate ordernumber inside the order table.
         * 
         * @return boolean
         */
        private function checkOrderNumber() 
        {

            $sSql = "
                SELECT order_number FROM orders 
                WHERE 1
                AND order_number = '".$this->getNumber()."'
            ";

            $aOrderNumberSql = $this->pdo->query($sSql);
            $aOrderNumberSql->fetchAll(\PDO::FETCH_ASSOC);

            if($aOrderNumberSql->rowCount() > 0) {

                return true;
            } 

            return false;
        }

        
        /**
         * Insert the customer data into the database.
         * 
         * @param array $customer
         *
         * @return void
         * 
         * @throws \Exception - Query failed.
         */
        public function insertCustomerData() 
        {

            $sSql = "
                INSERT INTO customers 
                SET 
                    first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    phone = :phone, 
                    adres = :adres, 
                    zipcode = :zipcode, 
                    country = :country, 
                    city = :city
            ";

            $aInsertSql = $this->pdo->prepare($sSql);

                foreach ($this->getCustomer() as $key => &$val) {
                    $aInsertSql->bindParam($key, $val);
                }

            $aInsertSql->execute();

                if(!$aInsertSql) {
                    throw new \Exception('Error: insertCustomerData() - Query execute failed.');
                }

            return $this->setCustomerId($this->pdo->lastInsertId());    
        }


        /**
         * Insert into the orders table with the last inserted id for customer, coupon id and other data.
         * 
         * @param array $coupon
         *
         * @return void
         * 
         * @throws \Exception - Query failed.
         */
        public function insertOrderData() 
        {

            // generate new order number in case it already exists.
            if($this->checkOrderNumber()) {
                $this->setNumber(generateUniqueId());
            } 

            $sSql = "
                INSERT INTO orders 
                SET 
                    customer_id = :customer_id, 
                    coupon_id = :coupon_id, 
                    order_number = :order_number, 
                    check_in = :check_in, 
                    check_out = :check_out, 
                    order_status = :order_status 
            ";

            $aInsertSql = $this->pdo->prepare($sSql);

            $aInsertSql->bindValue(':customer_id', $this->getCustomerId());
            $aInsertSql->bindValue(':coupon_id', $this->getCoupon());
            $aInsertSql->bindValue(':order_number', $this->getNumber());
            $aInsertSql->bindValue(':check_in', date("YmdHis"));
            $aInsertSql->bindValue(':check_out', date("YmdHis"));
            $aInsertSql->bindValue(':order_status', 0);
            $aInsertSql->execute();

                if(!$aInsertSql) {
                    throw new \Exception('Error: insertOrderData() - Query execute failed.');
                }

            if(!is_null($this->getCoupon()) && $this->getCoupon() > 0) {
                $this->updateCoupon($this->getCoupon());
            }

            return $this->setOrderId($this->pdo->lastInsertId());
        }


        /**
         * Update the coupon table when a code has been used.
         * 
         * @param int $coupon_id
         *
         * @return boolean
         * 
         * @throws \Exception - Query failed.
         */
        protected function updateCoupon($coupon_id = 0) {

            $sSql = "
                UPDATE coupons 
                SET 
                    quantity = quantity - 1 
                    WHERE 1 
                    AND quantity > 0
                    AND id = :coupon_id
                    LIMIT 1
            ";   

            $aUpdateSql = $this->pdo->prepare($sSql);
            
            $aUpdateSql->BindParam(':coupon_id', $coupon_id);
            $aUpdateSql->execute();

                if(!$aUpdateSql) {
                    throw new \Exception('Error: updateCoupon() - Query execute failed.');
                }

            return true;
        }


        /**
         * Bind the pizza data
         * 
         */
        public function setPizzaData() {

            return $this->getOrder();              
        }


        /**
         * Update the pizza_topping and pizza_type tables for the quantity values.
         * 
         */
        protected function updatePizzaValue() {

            $sSql = "

            ";   

            
        }


        /**
         * Insert the available pizza data into the orders_pizza table.
         * 
         */
        public function insertPizzaOrder() {

            $sSql = "
                INSERT INTO orders_pizza
                SET
                    order_id = :order_id,
                    size_id = :size_id,
                    type_id = :type_id,
                    quantity = :quantity,
                    status = :status
            ";   

            $aInsertSql = $this->pdo->prepare($sSql);

            $aInsertSql->bindValue(':order_id', $this->getOrderId());
            $aInsertSql->bindValue(':size_id', $this->getSizeId());
            $aInsertSql->bindValue(':type_id', $this->getTypeId());
            $aInsertSql->bindValue(':quantity', $this->getPizzaQuantity());
            $aInsertSql->bindValue(':status', 0);
            $aInsertSql->execute();

                if(!$aInsertSql) {
                    throw new \Exception('Error: insertPizzaOrder() - Query execute failed.');
                }

            return $this->setPizzaId($this->pdo->lastInsertId());
        }


        /**
         * Insert the topping ids into the topping_combination table.
         * 
         */
        private function insertToppingCombination() {

            $sSql = "

            ";   

            
        }


        /**
         * Order Number Setter.
         *
         * @param int $number
         * 
         * @return void
         */
        private function setNumber($number = 0)
        {
            $this->number = $number;
        }


        /**
         * Order Number Getter.
         *
         * @return int
         */
        public function getNumber()
        {
            return $this->number;
        }


        /**
         * Customer Data Setter.
         *
         * @param array $customer
         * 
         * @return void
         */
        private function setCustomer($customer = array()) 
        {
            $this->customer = $customer;
        }


        /**
         * Customer Data Getter.
         *
         * @return array
         */
        public function getCustomer() 
        {
            return $this->customer;
        }


        /**
         * Coupon Setter.
         *
         * @param int $coupon
         * 
         * @return void
         */
        private function setCoupon($coupon = 0) 
        {
            $this->coupon = $coupon;
        }


        /**
         * Coupon Getter.
         *
         * @return int
         */
        public function getCoupon() 
        {
            return $this->coupon;
        }


        /**
         * Customer Order Setter.
         *
         * @param array $order
         * 
         * @return void
         */
        private function setOrder($order = array()) 
        {
            $this->order = $order;
        }


        /**
         * Customer Order Getter.
         *
         * @return array
         */
        public function getOrder() 
        {
            return $this->order;
        }


        /**
         * Last inserted Customer Id Setter.
         *
         * @param int $customer_id
         * 
         * @return void
         */
        private function setCustomerId($customer_id = 0) 
        {
            $this->_customer_id = $customer_id;
        }


        /**
         * Last inserted Customer Id Getter.
         *
         * @return int
         */
        public function getCustomerId() 
        {
            return $this->_customer_id;
        }


        /**
         * Last inserted Order Id Setter.
         *
         * @param int $order_id
         * 
         * @return void
         */
        private function setOrderId($order_id = 0) 
        {
            $this->_order_id = $order_id;
        }


        /**
         * Last inserted Order Id Getter.
         *
         * @return int
         */
        public function getOrderId() 
        {
            return $this->_order_id;
        }


        /**
         * Last inserted Pizza Size Id Setter.
         *
         * @param int $size_id
         * 
         * @return void
         */
        private function setSizeId($size_id = 0) 
        {
            $this->_size_id = $size_id;
        }


        /**
         * Last inserted Pizza Size Id Getter.
         *
         * @return int
         */
        public function getSizeId() 
        {
            return $this->_size_id;
        }


        /**
         * Last inserted Pizza Topping Id Setter.
         *
         * @param int $topping_id
         * 
         * @return void
         */
        private function setToppingId($topping_id = 0) 
        {
            $this->_topping_id = $topping_id;
        }


        /**
         * Last inserted Pizza Topping Id Getter.
         *
         * @return int
         */
        public function getToppingId() 
        {
            return $this->_topping_id;
        }


        /**
         * Last inserted Pizza Type Id Setter.
         *
         * @param int $type_id
         * 
         * @return void
         */
        private function setTypeId($type_id = 0) 
        {
            $this->_type_id = $type_id;
        }


        /**
         * Last inserted Pizza Type Id Getter.
         *
         * @return int
         */
        public function getTypeId() 
        {
            return $this->_type_id;
        }


        /**
         * Last inserted Pizza Order Id Setter.
         *
         * @param int $pizza_id
         * 
         * @return void
         */
        private function setPizzaId($pizza_id) 
        {
            $this->_pizza_id = $pizza_id;
        }


        /**
         * Last inserted Pizza Order Id Getter.
         *
         * @return int
         */
        public function getPizzaId() 
        {
            return $this->_pizza_id;
        }


        /**
         * Pizza Quantity Setter.
         *
         * @param int $pizza_quantity
         * 
         * @return void
         */
        private function setPizzaQuantity($pizza_quantity) 
        {
            $this->_pizza_quantity = $pizza_quantity;
        }


        /**
         * Pizza Quantity Getter.
         *
         * @return int
         */
        public function getPizzaQuantity() 
        {
            return $this->_pizza_quantity;
        }


        /**
         * PDO Setter.
         *
         * @param object $pdo
         * 
         * @return void
         */
        private function setPDO($pdo) 
        {
            $this->pdo = $pdo;
        }


        /**
         * Class Destructor.
         *
         * @return boolean
         */
        // public function __destruct() {
        //     return clearSession();
        // }
    }
?>