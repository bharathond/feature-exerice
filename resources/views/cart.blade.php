<?php 
use App\Models\ProductSpecialModel;
use Illuminate\Support\Facades\DB;
$total = 0;
?>
<style>
#productCart {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  
  #productCart td th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #productCart tr:nth-child(even){background-color: #f2f2f2;}
  
  #productCart tr:hover {background-color: #ddd;}
  
  #productCart th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
</style>
<h1>Cart Items</h1>
<table id="productCart">
  <tr>
    <th>Item</th>
    <th>Unit Price</th>
    <th>Quantity</th>
    <th>Special Price</th>
  </tr>
  <?php foreach($product as $item){ ?>
    <tr>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->price; ?></td>
        <?php 
            $splPrice = DB::table('special_items')->where('item_id', $item->id)->orderBy('special_price', 'ASC')->get();
            if($cart[$item->id]['qty'] > 1){
                $specialPrice = 0;
                $qty = $cart[$item->id]['qty'];
                $divQty = $qty/2;
                $cnt = count($splPrice);
                if($cnt > 1){
                    if(($qty%2) == 0){
                        $specialPrice += ($divQty - 1) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                        $specialPrice += ($divQty + 1) * ($splPrice[1]->special_price/$splPrice[1]->special_qty);
                    }
                    else{
                        $specialPrice += ($divQty + 0.5) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                        $specialPrice += ($divQty - 0.5) * ($splPrice[1]->special_price/$splPrice[1]->special_qty);
                    }
                }
                else{
                    if(($qty%2) == 0){
                        $specialPrice += ($divQty - 1) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                        $specialPrice += ($divQty + 1) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                    }
                    else{
                        $specialPrice += ($divQty + 0.5) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                        $specialPrice += ($divQty - 0.5) * ($splPrice[0]->special_price/$splPrice[0]->special_qty);
                    } 
                }
            }
            else{
                $specialPrice = $item->price;
            }
            $total += $specialPrice;
        ?>

        <td><?php echo $cart[$item->id]['qty']; ?></td>
        <td><?php echo round($specialPrice,2); ?></td>
    </tr>
  <?php
    }
  ?>
  <tr>
    <td></td>
    <td></td>
    <td>Total</td>
    <td><?php echo round($total,2); ?></td>
  </tr>
</table>