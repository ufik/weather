<?php

namespace WeatherBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use WeatherBundle\Entity\City;

class LoadCityData implements FixtureInterface, ContainerAwareInterface
{
	/**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
    	$cities = $this->container->get('weather.city')->getAll();
    	foreach ($cities as $city) {
	        $manager->persist($city);
    	}
        
        $manager->flush();
    }
}