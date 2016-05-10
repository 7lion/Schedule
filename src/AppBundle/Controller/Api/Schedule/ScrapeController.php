<?php

namespace AppBundle\Controller\Api\Schedule;

use FOS\RestBundle\Controller\FOSRestController;

class ScrapeController extends FOSRestController
{
    const DEFAULT_SEASON = '2016';

    public function getParseAction()
    {
        $schedule = $this->get('api.schedule.service')->get(self::DEFAULT_SEASON);
        $this->get('schedule.service')->findOrCreateByMany($schedule);

        return $this->view();
    }
}
