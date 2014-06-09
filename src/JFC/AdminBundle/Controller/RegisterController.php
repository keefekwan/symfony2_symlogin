<?php
// src/JFC/AdminBundle/Controller/RegisterController.php

namespace JFC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;
use JFC\ModelBundle\Entity\User;
use JFC\ModelBundle\Form\RegisterFormType;

/**
 * Class RegisterController
 */
class RegisterController extends Controller
{
    /**
     * Register user
     *
     * @Route("/register", name="jfc_admin_register")
     * @Template("JFCAdminBundle:Register:register.html.twig")
     */
    public function registerAction(Request $request)
    {
        // Uses RegisterFormType to create the form
        $form = $this->createForm(new RegisterFormType());

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                // Call user object and passes each value into the form
                $user = $form->getData();

                $user->setPassword(
                    $this->encodePassword($user, $user->getPlainPassword())
                );

                // Persists and flushes the newly created user
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                // Flash message for successfully creating user
                $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'Registration successful');

                $this->authenticateUser($user);

                // Redirect after registration
                $url = $this->generateUrl('jfc_core_index');

                return $this->redirect($url);
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Encodes password
     *
     * @param $user
     * @param $plainPassword
     * @return mixed
     */
    private function encodePassword($user, $plainPassword)
    {
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

    /**
     * Authenticates user
     *
     * @param UserInterface $user
     */
    private function authenticateUser(UserInterface $user)
    {
        $providerKey = 'secured_area'; // Your firewall name

        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $this->container->get('security.context')->setToken($token);
    }
}