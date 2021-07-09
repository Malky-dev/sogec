<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Citation;
use App\Entity\Commentaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    // ...
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("FR-fr");
        
        for ($i=0; $i < 5; $i++) { 
            $user = new User();
            $user->setEmail($faker->email())
            ->setPseudo($faker->name());
            $password = $this->encoder->encodePassword($user, '1234');
            $user->setPassword($password);
            $manager->persist($user);
            
            for ($j=0; $j < 20; $j++) { 
                $citation = new Citation();
                $citation->setLibelle($faker->text())
                ->setCreatedBy($user)
                ->setCreatedAt($faker->datetime());
                $manager->persist($citation);
                
                for ($k=0; $k < 20; $k++) { 
                    $commentaire = new Commentaire();
                    $commentaire->setLibelle($faker->text())
                    ->setCreatedBy($user)
                    ->setQuotedAt($citation)
                    ->setCreatedAt($faker->datetime());
                    $manager->persist($commentaire);
                }
    
            }
        }

        $manager->flush();
    }
}
