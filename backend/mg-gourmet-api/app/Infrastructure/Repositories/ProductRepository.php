<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function findByUser(int $userId): array
    {
        return Product::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product->fresh();
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function all(): array
    {
        return Product::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }
}