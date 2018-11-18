<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
* @Route("/admin")
*/
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_dashboard")
     */
    public function indexAction()
    {
        return $this->render('Backend/default/index.html.twig');
    }
}
