<?php

    namespace rodls;
    use Rain\Tpl;

    class Page {
        private $tpl;
        private $options = [];
        private $defaults = [
            "header"=>true,
            "footer"=>true,
            "data"=>[]
        ];

        public function __construct($opts = array(), $tpl_dir = "./views/") {
            $this->options = array_merge($this->defaults, $opts);
            $config = array(
                "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
                "cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "./views-cache/",
                "debug"         => false
            );

            Tpl::configure( $config );

            $this->setData($this->options["data"]);
            
            $this->tpl = new Tpl;

            if($this->options["header"] === true) $this->tpl->draw("header");

        }

        private function setData($data = array()){
            foreach($data as $key => $value){
                $this->tpl->assign($key,$value);
            }
        }

        public function setTpl($nome, $data = array(), $retunHTML = false){
            
            $this->setData($data);

            return $this->tpl->draw($nome, $retunHTML);
        }

        public function __destruct() {
            if($this->options["footer"] === true) $this->tpl->draw("footer");

        }
    }

?>