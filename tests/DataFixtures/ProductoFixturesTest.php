<?php

namespace App\Tests\DataFixtures;

use App\DataFixtures\ProductoFixtures;
use App\Entity\Producto;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\ClassMetadataFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class ProductoFixturesTest extends TestCase
{
    public function testLoadCreatesTenProducts(): void
    {
        $persisted = [];
        $manager = new class($persisted) implements ObjectManager {
            /**
             * @param array<int, object> $persisted
             */
            public function __construct(private array &$persisted)
            {
            }

            public function find(string $className, mixed $id): ?object
            {
                return null;
            }

            public function persist(object $object): void
            {
                $this->persisted[] = $object;
            }

            public function remove(object $object): void
            {
            }

            public function clear(): void
            {
            }

            public function detach(object $object): void
            {
            }

            public function refresh(object $object): void
            {
            }

            public function flush(): void
            {
            }

            public function getRepository(string $className): ObjectRepository
            {
                throw new \BadMethodCallException('Not needed for this test.');
            }

            public function getClassMetadata(string $className): ClassMetadata
            {
                throw new \BadMethodCallException('Not needed for this test.');
            }

            public function getMetadataFactory(): ClassMetadataFactory
            {
                throw new \BadMethodCallException('Not needed for this test.');
            }

            public function initializeObject(object $obj): void
            {
            }

            public function contains(object $object): bool
            {
                return false;
            }

            public function isUninitializedObject(mixed $value): bool
            {
                return false;
            }
        };

        (new ProductoFixtures())->load($manager);

        self::assertCount(10, $persisted);

        foreach ($persisted as $index => $producto) {
            $number = $index + 1;

            self::assertInstanceOf(Producto::class, $producto);
            self::assertSame('Producto'.$number, $producto->getNombre());
            self::assertStringStartsWith('Lorem', $producto->getDescripcion());
            self::assertGreaterThanOrEqual(10, $producto->getPrecio());
            self::assertLessThanOrEqual(100, $producto->getPrecio());
            self::assertSame('images/producto'.$number.'.jpg', $producto->getImagen());
        }
    }
}
