<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Dance;
use App\Entity\Lesson;
use App\Entity\Member;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Customer;
use App\Entity\Professor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        /* User Administrator */
        $genres     = ['male', 'female'];
        $genre      = $faker->randomElement($genres);
        $imageFile  = 'https://randomuser.me/api/portraits/';
        $imageId    = $faker->numberBetween(1, 99) . '.jpg';
        $imageFile .= ($genre == 'male' ? 'men/' : 'women/') . $imageId;
        $user = new User();
        $user->setEmail('admin@localhost.eu')
            ->setPseudo('jmh')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'))
            ->setImage($imageFile)
            ->setImageCaption($faker->sentence);
        $manager->persist($user);

        /* User moderator */
        for ($u = 1; $u <= 10; $u++) {
            $users = new User();
            $users->setEmail($faker->email)
                ->setPseudo($faker->firstName())
                ->setRoles(['ROLE_User'])
                ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'))
                ->setImage($imageFile)
                ->setImageCaption($faker->sentence);

            $manager->persist($users);
        }

        /* Professor */
        for ($p = 1; $p <= 3; $p++) {
            $professor = new Professor();
            $professor->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber)
                ->setMobileNumber($faker->phoneNumber)
                ->setAddress($faker->streetAddress)
                ->setPostCode($faker->postcode)
                ->setCity($faker->city)
                ->setImage($imageFile)
                ->setImageCaption($faker->sentence);
        }
        $manager->persist($professor);

        /* Dance */
        for ($d = 1; $d <= mt_rand(1, 3); $d++) {
            $dance = new Dance();
            $dance->setTitle($faker->word)
                ->setSubTitle($faker->sentence)
                ->setContent($faker->paragraph(5))
                ->setProfessor($professor)
                ->setImage($faker->imageUrl())
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
                        ->setPostcode($faker->postcode)
                        ->setCity($faker->city)
                        ->setInfos($faker->paragraph(5))
                        ->setLesson($lesson)
                        ->setImage($imageFile)
                        ->setImageCaption($faker->sentence);
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
                    ->setImage($faker->imageUrl())
                    ->setImageCaption($faker->sentence);


                $manager->persist($article);
            }
        }
        /* Customer */
        for ($ce = 0; $ce <= 10; $ce++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber)
                ->setSubject($faker->randomElement(['informations', 'divers']))
                ->setContent($faker->paragraph)
                ->setAgreeRGPD(true);
            $manager->persist($customer);
        }

        $manager->flush();
    }
}
