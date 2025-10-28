<?php

namespace App\Domain\Product;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    
    public function findByUser(int $userId): array;
    
    public function create(array $data): Product;
    
    public function update(int $id, array $data): Product;
    
    public function delete(int $id): bool;
    
    public function all(): array;
}