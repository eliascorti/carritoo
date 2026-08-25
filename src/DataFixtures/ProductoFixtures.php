<?php

namespace App\DataFixtures;

use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $producto = new Producto();
            $producto
                ->setNombre('Producto'.$i)
                ->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->setPrecio(rand(10, 100))
                ->setImagen('images/producto'.$i.'.jpg');

            $manager->persist($producto);
        }

        $manager->flush();
    }
}
