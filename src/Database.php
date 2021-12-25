<?php


    class Database extends Query
    {
        /**
         * The hostname.
         *
         * @var string
         */
        private $hostname;


        /**
         * The username.
         *
         * @var string
         */
        private $username;


        /**
         * The password.
         *
         * @var string
         */
        private $password;


        /**
         * The database.
         *
         * @var string
         */
        private $dbname;


        /**
         * The charset.
         *
         * @var string
         */
        private $charset;


        /**
         * PHP Data Object.
         *
         * @var object
         */
        protected $pdo;


        /**
         * Datbase Class Constructor.
         *
         * @param string $host The hostname.
         * @param string $user The username.
         * @param string $pass The password.
         * @param string $db The database.
         * @param string $charset The charset.
         * 
         * @return void
         */
        public function __construct(string $host, string $user, string $pass, string $db, string $charset)
        {
            $this->hostname = $host;
            $this->username = $user;
            $this->password = $pass;
            $this->dbname   = $db;
            $this->charset  = $charset;
            $this->connect();
        }


        /**
         * Connect to database.
         *
         * @return void
         */
        public function connect()
        {
            $dsn = "mysql:host=$this->hostname;dbname=$this->dbname;charset=$this->charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->pdo = new \PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int) $e->getCode());
            }
        }


        /**
         * Disconnect from database.
         *
         * @return void
         */
        public function disconnect()
        {
            $this->pdo = null;
        }


        /**
         * Database Class Destructor.
         *
         * @return void
         */
        public function __destruct() 
        {
            $this->disconnect();
        }
    }