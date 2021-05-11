<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="base_url" content="{{ URL::to('/') }}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="{{asset('js/app.js')}}"></script>
</head>
<body>

<h1>Super Market</h1>
<div class="right-cont">
    <a class="btn btn-primary" href="<?php echo URL::to('/').'/product/create';?>">Add Item</a>
    <a class="btn btn-primary" href="<?php echo URL::to('/').'/product/specialItem';?>">Add Special Price</a>
    <a class="btn btn-primary clear-list" href="javascript:void(0)">Clear List</a>
</div>
<table id="productIndex">
  <tr>
    <th>Item</th>
    <th>Unit Price</th>
    <th>Action</th>
  </tr>
  <?php foreach($product as $item){ ?>
    <tr>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->price; ?></td>
        <td>
            <input class="qty" name="qty" placeholder='Qty'  min="1" max="5" />  X <?php echo $item->price; ?> 
            <a class="add_list" data-id="<?php echo $item->id; ?>" href="javascript:void(0)">add to cart</a>
        </td>
    </tr>
  <?php
    }
  ?>
</table>
<br>
<br>
<br>
<div id='load_cart'>
</div>

</body>
</html>
