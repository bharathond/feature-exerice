<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\ProductModel;
use App\Models\ProductSpecialModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function index(){
        $product = DB::table('product')->get();
        $response = $this->actingAs($user, 'web')->json('POST', '/home',$product);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Product Created!"]);
        $response->assertJson(['data' => $product]);
    }

    public function testStore(){

        $product = ProductModel::factory()->make([
            'name' => 'E',
            'price' => 35,
        ]);

        return response()->json(array('success' => true))
        ->assertStatus(200)->assertJson(['status' => true])->assertJson(['message' => "Product Created!"]);
        
    }

    public function splstore(Request $request){
        $product = ProductSpecialModel::factory()->make([
            'item_id' => '1',
            'special_qty' => '5',
            'special_price' => '15'
        ]);
        return response()->json(array('success' => true))
        ->assertStatus(200)->assertJson(['status' => true])->assertJson(['message' => "Special Item Created!"]);
    }

    public function cart(Request $request){
        $data = $request->all();
        $returnHTML = '';
        if(!empty($data['cart'])){
            foreach($data['cart'] as $key => $cart){
                $ids[] = $cart['model_id']; 
            }
            $product = DB::table('product')->whereIn('id' , $ids)->get();
            $returnHTML = view('cart')->with(['product' => $product,'cart' => $data['cart']])->render();
        }
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
