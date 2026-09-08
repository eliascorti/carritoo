<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;

class UsuarioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $password = ' $2y$13$.3VfaPugJAay3lDdA7HnGOr4J4s2VrVA2FAsidSNdtx8Jt6vRNeXS';
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 5; $i++) {
            $usuario = new Usuario();
        
            $usuario ->setNombre('Usuario' . $i);
            $usuario ->setEmail('usuario' . $i . '@gmail.com');
            $usuario ->setPassword($password);  

            $manager->persist($usuario);
        }

        $manager->flush();
    }
}
