<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dish;

class DishApiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     * 
     */

    public function test_I_can_create_a_dishes()
    {
        $dish = Dish::create([
            'name' => 'Caracoles en salsa',
            'img' => 'http://www.test.com',
            'ingredients' => 'caracoles',
            'price' => 30,
        ]);

        $response = $this->postJson('/api/dishes', [
            'name' => $dish->name,
            'img' => $dish->img,
            'ingredients' => $dish->ingredients,
            'price' => $dish->price
        ], [
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(200)
            ->assertJson(['name' => 'Caracoles en salsa']);
    }

    public function test_I_can_get_all_dishes()
    {
        $dishes = Dish::factory(2)->create();
        $dishOne = $dishes[0];

        $response = $this->getJson('/api/dishes');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => $dishOne->name,
            ]);
    }

    public function test_I_can_get_one_dish()
    {
        $dish = Dish::factory()->create();

        $response = $this->getJson('/api/dishes/1');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $dish->name]);
    }

    public function test_I_can_delete_a_dish()
    {
        $dish = Dish::factory()->create();

        $response = $this->deleteJson('/api/dishes/' . $dish->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('dishes', [
            'name' => $dish->name,
        ]);

    }

    public function test_I_can_update_a_dish()
    {
        $dish = Dish::factory()->create();

        $response = $this->putJson('/api/dishes/' . $dish->id, [
            'name' => 'New name',
            'ingredients' => 'hola ingrediente',
            'price' => 50,
            'img' => 'http://www.test.com',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'New name'
            ]);
        
        $this->assertDatabaseHas('dishes', [
            'name' => 'New name',
        ]);

        $this->assertDatabaseHas('dishes', [
            'name' => 'New name',
        ]);
    }
}
