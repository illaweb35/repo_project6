<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Dance;
use App\Entity\Lesson;
use App\Entity\Member;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Prospect;
use App\Entity\Professor;
use App\Service\FileUploader;
use App\Service\OlderCalculator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $fileUploader;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, FileUploader $fileUploader)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->fileUploader = $fileUploader;
    }




    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');


        /* User Administrator */

        $user = new User();
        $genres     = ['male', 'female'];
        $genre      = $faker->randomElement($genres);
        $imagefield  = 'https://randomuser.me/api/portraits/';
        $imageId    = $faker->numberBetween(1, 99) . '.jpg';
        $imagefield .= ($genre == 'male' ? 'men/' : 'women/') . $imageId;
        $user->setEmail('admin@localhost.eu')
            ->setPseudo('jmh')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'))

            ->setImageCaption($faker->sentence);
        $manager->persist($user);

        /* User moderator */
        for ($u = 1; $u <= mt_rand(3, 10); $u++) {
            $users = new User();
            $genres     = ['male', 'female'];
            $genre      = $faker->randomElement($genres);
            $imageFile  = 'https://randomuser.me/api/portraits/';
            $imageId    = $faker->numberBetween(1, 99) . '.jpg';
            $imageFile .= ($genre == 'male' ? 'men/' : 'women/') . $imageId;
            $users->setEmail($faker->email)
                ->setPseudo($faker->firstName())

                ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'))

                ->setImageCaption($faker->sentence);

            $manager->persist($users);
        }

        /* Professor */
        for ($p = 1; $p <= 3; $p++) {
            $professor = new Professor();
            $genres     = ['male', 'female'];
            $genre      = $faker->randomElement($genres);
            $imageFile  = 'https://randomuser.me/api/portraits/';
            $imageId    = $faker->numberBetween(1, 99) . '.jpg';
            $imageFile .= ($genre == 'male' ? 'men/' : 'women/') . $imageId;
            $professor->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber)
                ->setMobileNumber($faker->phoneNumber)
                ->setAddress($faker->streetAddress)
                ->setPostCode($faker->postcode)
                ->setCity($faker->city)

                ->setImageCaption($faker->sentence);
        }
        $manager->persist($professor);

        /* Dance */
        for ($d = 1; $d <= mt_rand(2, 5); $d++) {
            $dance = new Dance();
            $dance->setTitle($faker->word)
                ->setSubTitle($faker->sentence)
                ->setContent($faker->paragraph(5))
                ->setProfessor($professor)
                ->setImage($faker->imageUrl)
                ->setImageCaption($faker->sentence);

            $manager->persist($dance);

            /* Lesson */
            for ($l = 1; $l <= mt_rand(2, 5); $l++) {
                $lesson = new Lesson();
                $start = new \DateTime();
                $duration = new \DateInterval('PT' . mt_rand(1, 3) . 'H');
                $end = $start->add($duration);
                $diff = $lesson->getStartHour() - $lesson->getEndHour();
                $lesson->setTitle($faker->word)
                    ->setSubtitle($faker->sentence)
                    ->setDayLesson($faker->dayOfWeek)
                    ->setStartHour($faker->dateTime())
                    ->setEndHour($end)
                    ->setDuration($diff)
                    ->setAmount($faker->randomFloat(2, 5, 150))
                    ->setDance($dance)
                    ->setAddress($faker->streetAddress)
                    ->setPostCode($faker->postcode)
                    ->setCity($faker->city);

                $manager->persist($lesson);
                /* Member */
                for ($m = 0; $m <= mt_rand(10, 30); $m++) {
                    $member = new Member();

                    $genres     = ['male', 'female'];
                    $genre      = $faker->randomElement($genres);
                    $imageFile  = 'https://randomuser.me/api/portraits/';
                    $imageId    = $faker->numberBetween(1, 99) . '.jpg';
                    $imageFile .= ($genre == 'male' ? 'men/' : 'women/') . $imageId;
                    $member->setUserFirstName($faker->firstName)
                        ->setUserLastName($faker->lastName)
                        ->setBirthday($faker->dateTimeBetween('-60 years', '-5 years'))
                        ->setCivility($faker->title)
                        ->setFirstName($faker->firstName)
                        ->setLastName($faker->lastName)
                        ->setEmail($faker->email)
                        ->setPhoneNumber($faker->phoneNumber)
                        ->setMobileNumber($faker->phoneNumber)
                        ->setAddress($faker->streetAddress)
                        ->setPostCode($faker->postcode)
                        ->setCity($faker->city)
                        ->setInfos($faker->paragraph(5))
                        ->setLesson($lesson)

                        ->setImageCaption($faker->sentence);
                    $ageOlder = new OlderCalculator();
                    $age = $ageOlder->older($member->getBirthday());
                    $member->setOlder($age);
                    $manager->persist($member);
                }
            }
        }

        /* category */
        $categories = ['news', 'inscription', 'show', 'vidéos'];
        $color = ['#1B80BF', '#BF2C47', '#5F04B4', '#77BDD9'];
        foreach ($categories as $cate) {
            $category = new Category();
            $category->setName($cate)
                ->setColorName($faker->randomElement($color));
            $manager->persist($category);

            /* articles */
            for ($a = 0; $a <= 20; $a++) {

                $article = new Article();
                $article->setTitle($faker->sentence)
                    ->setSubTitle($faker->sentence)
                    ->setCategory($category)
                    ->setContent($faker->paragraph(5))

                    ->setImageCaption($faker->sentence);


                $manager->persist($article);
            }
        }
        /* prospect */
        for ($ce = 0; $ce <= 10; $ce++) {
            $prospect = new Prospect();
            $prospect->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber)
                ->setSubject($faker->randomElement(['informations', 'divers']))
                ->setContent($faker->paragraph)
                ->setAgreeRGPD(true);
            $manager->persist($prospect);
        }

        $manager->flush();
    }
}
