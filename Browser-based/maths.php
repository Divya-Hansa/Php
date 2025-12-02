<?php 
    class Math {
        public $x;
        public $y;

        function __construct($x, $y){
            $this ->x =$x;
            $this ->y =$y;
        }

        function add(){
            return $this ->x + $this ->y;
        }

        function subtract(){
            return $this ->x - $this ->y;
        }

        function multiply(){
            return $this ->x * $this ->y;
        }

        function divide(){
            return $this ->x / $this ->y;
        }
    }
?>