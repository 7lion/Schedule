<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Schedule
 *
 * @ORM\Table(name="schedule")
 * @ORM\Entity
 */
class Schedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="gameId", type="integer")
     *
     * @Assert\NotBlank()
     */
    private $gameId;

    /**
     * @var integer
     *
     * @ORM\Column(name="stadiumId", type="integer")
     *
     * @Assert\NotBlank()
     */
    private $stadiumId;

    /**
     * @var string
     *
     * @ORM\Column(name="awayTeam", type="string", length=10)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 10)
     */
    private $awayTeam;

    /**
     * @var string
     *
     * @ORM\Column(name="homeTeam", type="string", length=10)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 10)
     */
    private $homeTeam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     * @Assert\NotBlank()
     */
    private $date;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set stadiumId
     *
     * @param integer $stadiumId
     * @return Schedule
     */
    public function setStadiumId($stadiumId)
    {
        $this->stadiumId = $stadiumId;

        return $this;
    }

    /**
     * Get stadiumId
     *
     * @return integer
     */
    public function getStadiumId()
    {
        return $this->stadiumId;
    }

    /**
     * Set gameId
     *
     * @param integer $gameId
     * @return Schedule
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return integer
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set awayTeam
     *
     * @param string $awayTeam
     * @return Schedule
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    /**
     * Get awayTeam
     *
     * @return string
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * Set homeTeam
     *
     * @param string $homeTeam
     * @return Schedule
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return string
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Schedule
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
