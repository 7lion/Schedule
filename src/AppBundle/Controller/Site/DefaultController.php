<?php

namespace AppBundle\Controller\Site;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $schedule = $this->forward('AppBundle:Api\Schedule\Schedule:getSchedule')->getContent();
        $schedule = json_decode($schedule, true);

        return $this->render(':Site:index.html.twig', ['schedule' => $schedule]);
    }

    public function notFoundAction()
    {
        return new Response('Not Found', 404);
    }
}
