<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usuario;

class UsuarioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Hash generado con `php bin/console security:hash-password 123`.
        $password = '$2y$13$LrndeyV1e7Q8hoIGh3LzoeMoD/SisUecW.d/d0Z7yFzjSPKSSMcwC';

        for ($i = 1; $i <= 5; $i++) {
            $usuario = new Usuario();

            $usuario->setNombre('Usuario' . $i);
            $usuario->setEmail('usuario' . $i . '@gmail.com');
            $usuario->setPassword($password);

            $manager->persist($usuario);
        }

        $manager->flush();
    }
}
