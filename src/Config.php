<?php
    

    class Config
    {
        /**
        * The data from config file.
        *
        * @var array
        */
        private $items = array();   


        /**
         * Loads the specified config file.
         *
         * @param string $filename Name of the config file to be loaded in.
         * 
         * @return void
         */
        public function loadConfig($filename = 'config')
        {
            $this->items = require_once('config/' . $filename . '.php');
        }


        /**
         * Get the config items.
         *
         * @return array
         */
        public function getConfig()
        {
            return $this->items;
        }
    }