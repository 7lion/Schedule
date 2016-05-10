<?php

namespace AppBundle\Service\Schedule;

use Doctrine\Common\Persistence\ObjectRepository;
use AppBundle\Entity\Schedule as ScheduleEntity;
use Doctrine\ORM\EntityManager;

class Schedule
{
    private $repository;
    private $em;

    public function __construct(ObjectRepository $repository, EntityManager $manager)
    {
        $this->em = $manager;
        $this->repository = $repository;
    }

    public function findOrCreateByMany(array $schedule)
    {
        foreach ($schedule as $game) {
            $gameExist = $this->repository->findOneBy(['gameId' => $game['GameID']]);
            if (!$gameExist) {
                $this->createGame($game);
            }
        }
    }

    private function createGame(array $game)
    {
        $schedule = new ScheduleEntity();
        $schedule->setGameId($game['GameID']);
        $schedule->setStadiumId($game['StadiumID']);
        $schedule->setAwayTeam($game['AwayTeam']);
        $schedule->setHomeTeam($game['HomeTeam']);
        $schedule->setDate(new \DateTime($game['DateTime']));

        $this->em->persist($schedule);
        $this->em->flush($schedule);
    }
}
