<?php

namespace WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;

class DefaultController extends Controller
{
    /**
     * @QueryParam(name="lat", strict=true)
     * @QueryParam(name="long", strict=true)
     * @QueryParam(name="datetime", strict=true)
     */
    public function indexAction(ParamFetcher $paramFetcher)
    {
    	$latitude   = $paramFetcher->get('lat');
    	$longtitude = $paramFetcher->get('long');
    	$datetime   = $paramFetcher->get('datetime');

    	$city = $this->get('doctrine.orm.entity_manager')
    				->getRepository('WeatherBundle\\Entity\\LogItem')
    				->findNearestLogItem($latitude, $longtitude, $datetime);

    	$view = View::create()
            ->setData($city);

        return $this->container->get('fos_rest.view_handler')->handle($view);
    }
}
