<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = [];

        foreach ([
            'Science-Fiction',
            'Action',
            'Thriller',
            'Comédie',
            'Drame',
        ] as $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 30; $i++) {
            $movie = new Movie();

            $movie->setTitle(ucfirst($faker->words(3, true)));
            $movie->setSynopsis($faker->paragraphs(2, true));
            $movie->setDuration($faker->numberBetween(80, 180));
            $movie->setReleaseDate(
                \DateTimeImmutable::createFromMutable(
                    $faker->dateTimeBetween('-10 years', 'now')
                )
            );
            $movie->setPressRating($faker->randomFloat(1, 1, 5));
            $movie->setPoster(null);
            $movie->setCategory($faker->randomElement($categories));

            $manager->persist($movie);
        }

        $manager->flush();
    }
}