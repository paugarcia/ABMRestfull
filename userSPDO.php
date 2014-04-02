<?php
    class userSPDO extends PDO
    {
            private static $instance = null;

                const dsn  = 'mysql:dbname=abmrestfull;host=localhost';
                const usuari = "root";
                const password = "";
            public function __construct()
            {
                   
                    try{
                        parent::__construct(self::dsn, self::usuari, self::password);}
                    catch (PDOException $e) {
                     echo 'Connection failed: ' . $e->getMessage();}

            }

            public static function singleton()
            {
                    if( self::$instance == null )
                    {
                            self::$instance = new self();
                    }
                    return self::$instance;
            }
            
    }

