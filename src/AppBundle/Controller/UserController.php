<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("admin/user")
 */
class UserController extends Controller
{
    /**
     * Lists all users.
     *
     * @Route("/list", name="user_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('AppBundle:Video')->findAll();
        
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }
    
    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($user->getEmail());
            $user->setEnabled(1);
            $user->setPlainPassword($user->getPassword());            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_list');
        }
        
        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
            'action' => 'create'
        ));        
    }    
    
    /**
     * Edit user.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $user->setUsername($user->getEmail());
            $user->setEnabled(1);
            $user->setPlainPassword($user->getPassword());
            $userManager = $this->get('fos_user.user_manager');
            $user = $userManager->updateUser($user);
            return $this->redirectToRoute('user_list');
        }       

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $editForm->createView(),
            'action' => 'edit',
            'id' => $user->getId()
        ));
    }
}

