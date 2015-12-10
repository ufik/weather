<?php

namespace WeatherBundle\Repository;

/**
 * LogItemRepository
 */
class LogItemRepository extends \Doctrine\ORM\EntityRepository
{
	/**
	 * @param float     $latitude
	 * @param float     $longtitude
	 * @param timestamp $datetime
	 *
	 * @return Array
	 */
	public function findNearestLogItem($latitude, $longtitude, $datetime)
	{
		$queryBuilder = $this->createQueryBuilder('l')
			->select('l, (((ACOS(SIN(('.$latitude.'*PI()/180)) *
			        SIN((c.latitude*PI()/180))+COS(('.$latitude.'*PI()/180)) *
			        COS((c.latitude*PI()/180)) * COS((('.$longtitude.'-
			        c.longtitude)*PI()/180))))*180/PI())*60*1.1515*1.609344) 
			        AS distance')
			->join('l.city', 'c');	

		$queryBuilder->orderBy('distance, abs(TIMESTAMPDIFF(second, l.datetime, \'' . date('Y-m-d H:i:s', $datetime) . '\'))', 'ASC');
		$queryBuilder->setMaxResults(1);

		return $queryBuilder->getQuery()->getSingleResult();
	}

	public function itemExists($datetime, $name)
	{
		$queryBuilder = $this->createQueryBuilder('l')
							->select('l')
							->join('l.city', 'c')
							->where('l.datetime = :datetime')
							->andWhere('c.name = :name')
							->setParameter('datetime', $datetime)
							->setParameter('name', $name);

		return $queryBuilder->getQuery()->getResult() ? true : false;
	}
}
