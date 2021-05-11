<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<h3>Create Product</h3>

<div class="container">
  <form action="<?php echo URL::to('/').'/product/specialItemStore';?>" method="post">
  @csrf
    <label for="itemId">Item Name</label>
    <select id="itemId" name="itemId">
      <?php 
        foreach($product as $item){
            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
      ?>
    </select>

    <label for="splQty">Quantity to Offer</label>
    <input type="text" id="splQty" name="splQty" placeholder="Your Quantity to offer..">

    <label for="splPrice">Special Price</label>
    <input type="text" id="splPrice" name="splPrice" placeholder="Your Special Price..">

    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
