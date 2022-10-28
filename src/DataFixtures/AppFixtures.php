<?php

namespace App\DataFixtures;

use App\Entity\Document;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Autor;
use App\Entity\Book;
use Faker\Generator;
use app\Entity\Dvd;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    private $books;

    private $autors;

    private $dvds;

    public function load(ObjectManager $manager): void
    {
//        $faker = Factory::create();
//        foreach(range(1,10) as $autors) {
//            $autor = new Autor();
//            $autor->setBio($faker->text(150)) ;
//            $autor->setName($faker->name());
//            $birthDate= $faker->dateTimeBetween("-100 years", "-20 years");
//            $birthDate = new \DateTimeImmutable($birthDate->format("Y-m-d H:i:s"));
//            $autor->setBirth($birthDate);
//
//            $manager->persist($autor);
        $this->faker = Factory::create();
        $this->autors = $this->createAutors($manager, 15);
        $this->books = $this->createBooks($manager, 15);
        $this->cds = $this->createDvds($manager, 15);

        $manager->flush();
    }

/**
 * Création d'un nombre arbitraire de catégories
 *
 * @param ObjectManager $manager
 * @param int $count
 * @return array
 */
private function createAutors(ObjectManager $manager, int $count): array
{
    $autors = [];
    foreach (range(1, $count) as $index) {
        $autor = new Autor();
        $autor
            ->setName($this->faker->name(12))
            ->setBio($this->faker->text(150))
            ->setBirth( \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween("-100 years", "-20 years")));

        $manager->persist($autor);
        $autors[] = $autor;
    }

    return $autors;
}


/**
 * Création d'un nombre arbitraire de books
 *
 * @param ObjectManager $manager
 * @param int $count
 * @return array
 */
private function createBooks(ObjectManager $manager, int $count): array
{
    $books = [];
    foreach (range(1, $count) as $index) {
        $book = new Book();
        $book
            ->setTitle($this->faker->word())
            ->setVolume($this->faker->numberBetween(1,9))
            ->setCote($this->faker->word())
            ->setName($this->faker->word())
            ->setType($this->faker->boolean())
            ->setAvalaible($this->faker->boolean())
            ->setBorrowable($this->faker->boolean())
            ->setDescription($this->faker->text(200))
            ->setCreatedAt( \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween("-15 years", "-0 years")))
            ->setNbrPage($this->faker->numberBetween(30, 500));
        foreach (range(0,random_int(0,2)) as $index) {
            $book
                ->addAutor($this->autors[random_int(0,count($this->autors)-1)]);
            //add pas set car plusieurs auteurs possibles pour un m^me doc
        }

        $manager->persist($book);
        $books[] = $book;
    }

    return $books;
}
    /**
     * Création d'un nombre arbitraire de dvd
     *
     * @param ObjectManager $manager
     * @param int $count
     * @return array
     */
    private function createDvds(ObjectManager $manager, int $count): array
    {
        $dvds = [];
        foreach (range(1, $count) as $index) {
            $dvd = new Dvd();
            $dvd
                ->setDuration(\DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween("15 minutes", "150 minutes")))
                ->setTracks($this->faker->word())
                ->setCote($this->faker->word())
                ->setName($this->faker->word())
                ->setType($this->faker->boolean())
                ->setAvalaible($this->faker->boolean())
                ->setBorrowable($this->faker->boolean())
                ->setDescription($this->faker->text(200))
                ->setCreatedAt( \DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween("-15 years", "-0 years")));

            $manager->persist($dvd);
            $dvds[] = $dvd;
        }

        return $dvds;
    }

//public function addDocumentsAutor(Document $documentsAutor): self
//{
//    if (!$this->documentsAutor->contains($documentsAutor)) {
//        $this->documentsAutor->add($documentsAutor);
//    }


}
