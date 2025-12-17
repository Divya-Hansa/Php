<?php
    require "maths.php";
    $result = "";
    $error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $x = $_POST["x"];
        $y = $_POST["y"];
        $op = $_POST["operation"];
    
    $max = 1e100;
    $min = -1e100;

    if($x > $max || $x < $min ){
        $error = "x is too large. Please enter valid number.";
    }

    if($y > $max || $y < $min ){
        $error = "y is too large. Please enter valid number.";
    }

    if ($op == "divide" && $y == 0) {
        $error = " Cannot divide by zero. Please enter a valid number for Y.";
    }

    if(!$error) {
        $new = new Math($x, $y);

        switch($op){
            case "add" : $result = $new->add(); break;
            case "subtract" : $result = $new->subtract(); break;
            case "multiply" : $result = $new->multiply(); break;
            case "divide" : $result = $new->divide(); break;  
        }
    }
}
?>

<html>
    <body style="
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    ">
        <form method = "POST"
            style=
            "display: flex;
            flex-direction: column;
            gap: 5px;
            width: 25rem"
            >
            <h2>Simple Calculator</h2>
            <label>Enter x:</label>
            <input type="number" name="x" required> </input>
            <label>Enter y:</label>
            <input type="number" name="y" required> </input>
            <label>Math :</label>
            <select name="operation" required>
                <option value="" disabled selected>Choose</option>
                <option value="add">Add</option>
                <option value="subtract">Subtract</option>
                <option value="multiply">Multiply</option>
                <option value="divide">Divide</option>
            </select>
            
            <button type="submit" style="background: green; cursor: pointer; height: 40px">Submit</button>
        </form>
        <?php if($error){
                echo "<div>$error</div>";
        }
        ?>
        <?php
            if($result !== ""){
                echo "<div>$result</div>";
            }
        ?>
    </body>
</html>