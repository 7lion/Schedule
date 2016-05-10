<?php

namespace AppBundle\Controller\Api\Schedule;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    public function getScheduleAction()
    {
        return new Response(
            $this->get('serializer')->serialize(
                $this->get('schedule.repository')->findAll(),
                'json'
            )
        );
    }
}
