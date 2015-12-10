<?php

namespace WeatherBundle\Service;

use WeatherBundle\Entity\City AS CityEntity;

class City
{
	public function getAll()
	{
		return array(
			new CityEntity('Praha', 50.09, 14.42),
			new CityEntity('Plzen', 49.75, 13.38),
			new CityEntity('Ceske Budejovice', 48.97, 14.47),
			new CityEntity('Karlovy Vary', 50.23, 12.87),
			new CityEntity('Usti nad Labem', 50.66, 14.03),
			new CityEntity('Liberec', 50.77, 15.06),
			new CityEntity('Hradec Kralove', 50.21, 15.83),
			new CityEntity('Pardubice', 50.04, 15.78),
			new CityEntity('Jihlava', 49.4, 15.59),
			new CityEntity('Brno', 49.2, 16.61),
			new CityEntity('Olomouc', 49.6, 17.25),
			new CityEntity('Zlin', 49.23, 17.67),
			new CityEntity('Ostrava', 49.83, 18.28)
		);
	}
}