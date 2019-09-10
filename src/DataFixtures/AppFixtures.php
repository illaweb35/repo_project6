<?php

namespace App\DataFixtures;

use DateInterval;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Dance;
use App\Entity\Lesson;
use App\Entity\Member;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Prospect;
use App\Entity\Professor;
use App\Service\OlderCalculator;
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
        $user = new User();
        $user->setEmail('admin@localhost.eu')
            ->setPseudo('jmh')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'));

        $manager->persist($user);

        /* User moderator */
        for ($u = 0; $u <= mt_rand(3, 5); $u++) {
            $users = new User();

            $users->setEmail($faker->email)
                ->setPseudo($faker->firstName())
                ->setPassword($this->passwordEncoder->encodePassword($user, 'Password'));

            $manager->persist($users);
        }

        /* Professors */
        for ($i = 1; $i <= 3; $i++) {
            $professor = new Professor();
            $professor->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setEmail($faker->email)
                ->setPhoneNumber($faker->phoneNumber)
                ->setMobileNumber($faker->phoneNumber)
                ->setAddress($faker->streetAddress)
                ->setPostCode($faker->postcode)
                ->setCity($faker->city);
            $manager->persist($professor);



            /* Dance */
            for ($d = 1; $d <= 3; $d++) {
                $dance = new Dance();
                $dance->setTitle($faker->word)
                    ->setSubTitle($faker->sentence)
                    ->setContent($faker->paragraph(5))
                    ->setProfessor($professor);

                $manager->persist($dance);

                /* Lesson */
                for ($l = 1; $l <= mt_rand(2, 5); $l++) {
                    $lesson = new Lesson();
                    $lesson->setTitle($faker->word)
                        ->setSubtitle($faker->sentence)
                        ->setDayLesson($faker->dayOfWeek)

                        ->setAmount($faker->randomFloat(2, 5, 150))
                        ->setDance($dance)
                        ->setAddress($faker->streetAddress)
                        ->setPostCode($faker->postcode)
                        ->setCity($faker->city)
                        ->setLat($faker->latitude(47, 49))
                        ->setLon($faker->longitude(-2, 2))
                        ->setStartHour($faker->dateTime('22 hours', '+12 hours'));
                    $duration = $lesson->getStartHour()->add(new \DateInterval('PT2H'));
                    $lesson->setEndHour($duration);


                    $manager->persist($lesson);

                    /* Member */
                    for ($m = 0; $m <= mt_rand(5, 20); $m++) {
                        $member = new Member();
                        $member->setUserFirstName($faker->firstName)
                            ->setUserLastName($faker->lastName)
                            ->setBirthday($faker->dateTimeBetween('-55 years', '-5 years'))
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
                            ->setLesson($lesson);
                        $ageOlder = new OlderCalculator();
                        $age = $ageOlder->older($member->getBirthday());
                        $member->setOlder($age);
                        $manager->persist($member);
                    }
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
            for ($a = 0; $a <= mt_rand(2, 5); $a++) {

                $article = new Article();
                $article->setTitle($faker->sentence)
                    ->setSubTitle($faker->sentence)
                    ->setCategory($category)
                    ->setContent($faker->paragraph(5));

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
