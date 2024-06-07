<!DOCTYPE html>
<html>
<head>
<title>Simple Calculator</title>
<style>
  /* Add some basic styling for the form */
  body {
    font-family: sans-serif;
  }
  .calculator {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  input[type="text"] {
    padding: 10px;
    margin: 5px;
    border: 1px solid #ccc;
  }
  input[type="submit"] {
    padding: 10px 20px;
    margin: 5px;
    background-color: #4CAF50;
    color: white;
    border: none;
  }
</style>
</head>
<body>
<div class="calculator">
  <h1>Simple Calculator</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="text" name="num1" placeholder="Enter first number">
    <select name="operator">
      <option value="add">+</option>
      <option value="subtract">-</option>
      <option value="multiply">*</option>
      <option value="divide">/</option>
    </select>
    <input type="text" name="num2" placeholder="Enter second number">
    <input type="submit" value="Calculate">
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operator = $_POST["operator"];
    $result = "";
    $error = "";

    // Basic validation
    if (empty($num1) || empty($num2)) {
      $error = "Please enter both numbers.";
    } else {
      // Convert inputs to numbers
      $num1 = (float)$num1;
      $num2 = (float)$num2;
      
      // Perform calculation based on operator
      switch ($operator) {
        case "add":
          $result = $num1 + $num2;
          break;
        case "subtract":
          $result = $num1 - $num2;
          break;
        case "multiply":
          $result = $num1 * $num2;
          break;
        case "divide":
          if ($num2 == 0) {
            $error = "Cannot divide by zero.";
          } else {
            $result = $num1 / $num2;
          }
          break;
        default:
          $error = "Invalid operator selected.";
          break;
      }
    }
  }
  ?>
  <?php if (!empty($result) || $result === 0) {
    echo "Result: $result";
  } ?>
  <?php if (!empty($error)) {
    echo "<p style='color: red;'>Error: $error</p>";
  } ?>
</div>
</body>
</html>
