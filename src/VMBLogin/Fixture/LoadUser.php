<?php
namespace VMBLogin\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Login\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager) {

        $user = new User();
        $user->setUserUsername('admin')
             ->setUserPassword('admin');

        $manager->persist($user);
        $manager->flush();

    }

    public function getOrder() {
        return 4;
    }
}
?>