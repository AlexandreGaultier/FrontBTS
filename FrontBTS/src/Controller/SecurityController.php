<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $client = new Client();
        $form = $this->createForm(RegistrationType::class, $client);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($client, $client->getPassword());

            $client->setPassword($hash);

            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
    * @Route("/connexion", name="security_login")
    */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

    /**
    * @Route("/deconnexion", name="security_logout")
    */
    public function logout() {}
}
