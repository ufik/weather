<?php

namespace WeatherBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use WeatherBundle\Entity\LogItem;

class WeatherDownloadDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('weather:download-data')
            ->setDescription('Downloads actual weather data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cities = $this->getContainer()->get('weather.city')->getAll();
        $client = $this->getContainer()->get('endroid.openweathermap.client');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $output->writeln('Downloading data...');
        foreach ($cities as $city) {
            $weather = $client->getWeather($city->getName());

            $cityEntity = $em->getRepository('WeatherBundle\\Entity\\City')
                            ->findOneBy(array(
                                        'name' => $city->getName()
                                        ));

            $datetime = new \DateTime();
            $datetime->setTimestamp($weather->dt);

            if (!$em->getRepository('WeatherBundle\\Entity\\LogItem')->itemExists($datetime, $city->getName())) {
                $logItem = new LogItem();
                $logItem->setCity($cityEntity);
                $logItem->setDatetime($datetime);
                $logItem->setWeather($weather->weather[0]->main);

                if (property_exists($weather->main, 'temp')) {
                    $logItem->setTemperature($weather->main->temp);
                }

                $em->persist($logItem);
                $output->writeln('Saving weather data for ' . $city->getName());                
            } else {
                $output->writeln('Skipping weather data for ' . $city->getName());
            }
        }

        $em->flush();
        
        $output->writeln('Downloading finished...');
    }
}
