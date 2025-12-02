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

    function onlyNumber($text){
        $max = 1e100;
        $min = -1e100;

        while(true){
            echo $text;
            $input = trim(fgets(STDIN));

            if (!is_numeric($input)) {
                echo "Enter a valid number.\n";
                continue;
            }

            if ($input > $max || $input < $min) {
                echo "Number too large or too small.\n";
                continue;
            }

            return $input;
        }
    }

    
    while(true){    
        echo "Select an Option (1, 2, 3, 4 or q to quit) \n";
        $functions = ["1) Add", "2) Subtract", "3) Multiply", "4) Divide"];
        foreach ($functions as $z) {
            echo "$z\n";
        }
        $option = trim(fgets(STDIN));
        if(strtolower($option) === "q"){
            break;
        }
        if(!in_array($option, [1,2,3,4])){
            echo "Select valid Option";
            continue;
        }

        $x = onlyNumber("Enter x: ");
        $y = onlyNumber("Enter y: ");
        if ($option == "4"){
            while($y == 0){
                echo "Divide by 0 not possible \n";
                $y = onlyNumber("Enter y: ");
            }
        }

        $new = new Math($x, $y);
        
        switch ($option){
            case "1":
                echo $new->add(). "\n";
                break;
            case "2":
                echo $new->subtract(). "\n";
                break;
            case "3" :
                echo $new->multiply(). "\n";
                break;
            case "4" :
                echo $new->divide(). "\n";
                break;
        }
    }
?>
