<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>

<h3>Create Product</h3>

<div class="container">
  <form action="<?php echo URL::to('/').'/product/store';?>" method="post">
     @csrf
    <label for="item">Item Name</label>
    <input type="text" id="item" name="itemName" placeholder="Item Name..">

    <label for="proce">Price</label>
    <input type="text" id="price" name="price" placeholder="Your Price..">

    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
