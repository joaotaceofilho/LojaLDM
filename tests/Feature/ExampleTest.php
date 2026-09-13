<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_product_images_are_stored_when_a_product_is_created(): void
    {
        Storage::fake('public');

        $brand = Brand::create([
            'name' => 'Marca teste',
            'slug' => 'marca-teste',
        ]);

        $category = Category::create([
            'name' => 'Categoria teste',
            'slug' => 'categoria-teste',
        ]);

        $response = $this->post('/pagina/add', [
            'name' => 'Produto teste',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'price' => '29.90',
            'qty' => 3,
            'description' => 'Descrição do produto teste',
            'private' => 0,
            'images' => [
                UploadedFile::fake()->create('principal.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('secundaria.png', 100, 'image/png'),
            ],
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseCount('product_images', 2);
        $this->assertDatabaseHas('product_images', [
            'is_main' => 1,
            'position' => 0,
        ]);
        $this->assertDatabaseHas('product_images', [
            'is_main' => 0,
            'position' => 1,
        ]);

        ProductImage::query()->each(function (ProductImage $image): void {
            Storage::disk('public')->assertExists($image->image);
        });
    }
}
