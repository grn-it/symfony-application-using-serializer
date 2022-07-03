<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly UserRepository $userRepository) {}

    public function load(ObjectManager $manager): void
    {
        $now = new \DateTime();
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'kate@gmail.com']));
        $message->setText('Hi, Kate, how are you settling in?');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'kate@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setText('Just fine thanks. I appreciate you taking the time to help me out with this software. May I ask you what we will be covering today?');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'kate@gmail.com']));
        $message->setText('Sure. Before I do that, could you tell me if you\'ve worked with this program before? That will help me figure out how to proceed');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'kate@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setText('I\'ve done a little work with it, but not much');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'kate@gmail.com']));
        $message->setText('Well, it\'s a good idea to have the manual ready, since it can get a bit hairy. You should start by logging in with your username and password');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setText('Hi, I\'m calling from Nika Corporation. We would like to hold a business lunch at the restaurant');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setText('Oh, certainly. I\'m James, the manager. I can help you with that. How many will there be in your party?');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setText('There will be about 18 people');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setText('Okay. For a party that size, we have a separate banquet room in the back');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setText('Is there an extra charge to reserve the room?');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);

        $now = (\DateTime::createFromInterface($now))->modify('+12 seconds');
        
        $message = new Message();
        $message->setFrom($this->userRepository->findOneBy(['email' => 'james@gmail.com']));
        $message->setTo($this->userRepository->findOneBy(['email' => 'walter@gmail.com']));
        $message->setText('No, as long as you can guarantee at least 15 guests, there is no extra charge');
        $message->setCreatedAt($now);
        $message->setUpdatedAt($now);
        $manager->persist($message);
        
        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
