<?php

namespace App\Domain\Product;

use Illuminate\Http\UploadedFile;

interface ProductServiceInterface
{
    public function getProductsByUser(int $userId);
    public function createProduct(array $data, ?UploadedFile $image): Product;
    public function getProductById(int $id): ?Product;
    public function updateProduct(int $id, array $data, ?UploadedFile $image): ?Product;
    public function deleteProduct(int $id): bool;
    public function canUserAccessProduct(int $productId, int $userId): bool;
}
