<?php

namespace App\Application\Services;
use App\Domain\Product\ProductServiceInterface;
use App\Domain\Product\ProductRepositoryInterface;
use App\Domain\Product\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductService implements ProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->all();
    }

    public function getProductsByUser(int $userId): array
    {
        return $this->productRepository->findByUser($userId);
    }

    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct(array $data, ?UploadedFile $image = null): Product
    {
        if ($image) {
            $data['image'] = $this->handleImageUpload($image);
        }

        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data, ?UploadedFile $image = null): Product
    {
        $product = $this->productRepository->findById($id);
        
        if (!$product) {
            throw new \Exception('Product not found');
        }

        if ($image) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $this->handleImageUpload($image);
        }

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): bool
    {
        $product = $this->productRepository->findById($id);
        
        if (!$product) {
            throw new \Exception('Product not found');
        }

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return $this->productRepository->delete($id);
    }

    public function canUserAccessProduct(int $productId, int $userId): bool
    {
        $product = $this->productRepository->findById($productId);
        return $product && $product->isOwnedBy($userId);
    }

    private function handleImageUpload(UploadedFile $image): string
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        return $image->storeAs('products', $imageName, 'public');
    }
}