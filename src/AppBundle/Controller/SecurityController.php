<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * 
     * 
//     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
/*
        $user1 = new \AppBundle\Entity\Utilisateur();
        $user1
            ->setNom('Bourdin')
            ->setPrenom('Annie')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user1, 'aniber'))
            ->setUsername('anniebourdin')
            ->setSalt('')
            ->setRoles(['ROLE_USER']);
        $this->container->get('doctrine.orm.entity_manager')->persist($user1);
        $user2 = new \AppBundle\Entity\Utilisateur();
        $user2
            ->setNom('Thomas')
            ->setPrenom('Bernard')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user2, 'complice'))
            ->setUsername('bernarthomas')
            ->setSalt('')
            ->setRoles(['ROLE_USER']);
        $this->container->get('doctrine.orm.entity_manager')->persist($user2);
        $this->container->get('doctrine.orm.entity_manager')->flush();
*/
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            return $this->redirectToRoute('sonata_admin_dashboard');
        }
        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('security/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError()
        ));
    }
}
