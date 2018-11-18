<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/")
 */
class DefaultController extends Controller {

    /**
     * @Route("", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList()
        ]);
    }
    
    /**
     * @Route("about-us", name="about_us")
     */
    public function aboutUsAction(Request $request) {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList()
        ]);
    }    
    
    /**
     * @Route("contact-us", name="contact_us")
     */
    public function contactUsAction(Request $request) {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList()
        ]);
    }    
    
    /**
     * Displays single video in separate page.
     *
     * @Route("view/{slug}", name="view_single_video")
     * @Method({"GET"})
     */
    public function viewVideoAction(Request $request) {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList()
        ]);
    }    

    /**
     * Get list of all categories from database.
     * @return array
     */
    private function getVideoCategories() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Category')->findAll();
        /*
        return array_map(function($cat) {
            return array('id' => $cat->getId(), 'name' => $cat->getName());
        }, $categories);
         */
    }
    
    /**;
     * Get list of all videos from database.
     * @return array
     */
    private function getVideosList() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('AppBundle:Video')->findAll();
    }

}
