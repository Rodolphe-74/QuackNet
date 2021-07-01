<?php

namespace App\Controller;

use App\Entity\Duck;
use App\Form\RegistrationFormType;
use App\Security\DuckAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserAuthenticatorInterface $authenticator, DuckAuthenticator $duckAuthenticator): Response
    {
        $user = new Duck();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
//            $userName=$user->getLastname();
//            $mail=new \Mail();
//            $mail->send($user->getEmail(),$userName,"Bienvenue","Bonjour Monsieur $userName, votre inscription s'est bien déroulée ! ");

            $authenticator->authenticateUser($user,$duckAuthenticator,$request);

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
