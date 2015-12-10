<?php

namespace WeatherBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogItem
 *
 * @ORM\Table(name="log_item", uniqueConstraints={@ORM\UniqueConstraint(name="city_time_unique", columns={"datetime", "city_id"})})
 * @ORM\Entity(repositoryClass="WeatherBundle\Repository\LogItemRepository")
 */
class LogItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     */
    private $city;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="weather", type="string", length=255)
     */
    private $weather;

    /**
     * @var int
     *
     * @ORM\Column(name="temperature", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $temperature;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return LogItem
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set weather
     *
     * @param string $weather
     *
     * @return LogItem
     */
    public function setWeather($weather)
    {
        $this->weather = $weather;

        return $this;
    }

    /**
     * Get weather
     *
     * @return string
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * Set temperature
     *
     * @param integer $temperature
     *
     * @return LogItem
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set city
     *
     * @param integer $city
     *
     * @return LogItem
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return int
     */
    public function getCity()
    {
        return $this->city;
    }
}

