<?php

namespace JFC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * Index page after logging in and registering
     *
     * @Route("/", name="jfc_core_index")
     * @Template("JFCCoreBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
