<?php

namespace App\DataFixtures;

use App\Entity\Geoloc;
use App\Entity\Post;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        $slugify = new Slugify();

        for ($i = 0; $i < 100; $i ++) {

            $geoLoc = (new Geoloc())
                ->setLatitude($faker->latitude)
                ->setLongitude($faker->longitude);

            $manager->persist($geoLoc);

            $postTitle = $faker->realText;

            $post = (new Post())
                ->setTitle($postTitle)
                ->setSlug($slugify->slugify($postTitle))
                ->setContent($faker->paragraphs(rand(2,8), true))
                ->setPosteDate(new \DateTimeImmutable($faker->date))
                ->setGeoloc($geoLoc)
            ;

            $manager->persist($post);
        }

        $manager->flush();
    }
}
