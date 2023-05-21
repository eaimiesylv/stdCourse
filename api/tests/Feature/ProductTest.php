<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
   use RefreshDatabase;
    public function test_if_homepage_contain_empty_table()
    {
        $response = $this->get('/');
        $response->assertSee('No product found');
        $response->assertStatus(200);
    }
    public function test_if_homepage_contain_non_empty_table()
    {
        $p=Product::create([
            'product_name'=>'bean',
            'price'=>30
        ]);
        $response = $this->get('/');
        $response->assertDontSee('No product found');
        $response->assertStatus(200);
        $response->assertViewHas('products',function($collection)use($p){
            return $collection->contains($p);
        });
    }
    public function test_if_table_does_not_contain_11th_record()
    {
       for($i=0; $i<=11; $i++){
            $p=Product::create([
                'product_name'=>'bean',
                'price'=>30
            ]);
       }
        $response = $this->get('/');
        $response->assertDontSee('No product found');
        $response->assertStatus(200);
        $response->assertViewHas('products',function($collection)use($p){
            return !$collection->contains($p);
        });
    }
}
