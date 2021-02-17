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
         * Coupon data, such as code, applied and id.
         *
         * @var array
         */
        private $coupon;


        /**
         * PDO.
         *
         * @var object
         */
        private $pdo;


        /**
         * Customer Inserted Id.
         *
         * @var int
         */
        protected $_customer_id;


        /**
         * Default constructor.
         * 
         * @param object $pdo
         *
         * @return void
         */
        public function __construct($config, $pdo) {

                if(is_object($pdo) && !is_null($pdo)) {
                    $this->setPDO($pdo);
                }


            if(is_array($config)) {

                $this->setNumber($config['order_number']);
                $this->setOrder($config['customer_order']['pizzas']);
                $this->setCustomer($config['customer_information']);
                $this->setCoupon($config['customer_order']['coupons']);

            } else {

                throw new \Exception('Error: __construct() - Configuration data is missing.');
            }
        }


        /**
         * Insert the customer data into the database.
         * 
         * @param array $customer
         *
         * @return int
         */
        public function insertCustomerData($customer = array()) 
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

                foreach ($customer as $key => &$val) {
                    $aInsertSql->bindParam($key, $val);
                }

            $aInsertSql->execute();

                if(!$aInsertSql) {
                    throw new \Exception('Error: insertCustomerData() - Query execute failed.');
                }

            return $this->_customer_id = $this->pdo->lastInsertId();
        }


        /**
         * Order Number Setter.
         *
         * @param int $number
         * 
         * @return void
         */
        private function setNumber($number)
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
        private function setCustomer($customer) 
        {
            $this->customer = $customer;
        }


        /**
         * Customer Data Setter.
         *
         * @return void
         */
        public function getCustomer() 
        {
            return $this->customer;
        }


        /**
         * Coupon Getter.
         *
         * @param array $coupon
         * 
         * @return void
         */
        private function setCoupon($coupon) 
        {
            $this->coupon = $coupon;
        }


        /**
         * Coupon Setter.
         *
         * @return array
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
        private function setOrder($order) 
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
    }
?>