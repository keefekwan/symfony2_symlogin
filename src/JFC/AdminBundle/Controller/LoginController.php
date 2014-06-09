<?php
// src/JFC/ModelBundle/Controller/LoginController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginController
 */
class LoginController extends Controller
{
    /**
     * Login action
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Array
     *
     * @Route("/login", name="jfc_admin_login")
     * @Template("JFCAdminBundle:Login:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // Get the login error if there is one
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);

        return array(
            // Last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="jfc_admin_login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * @Route("/logout", name="jfc_admin_logout")
     */
    public function logoutAction()
    {
    }
}