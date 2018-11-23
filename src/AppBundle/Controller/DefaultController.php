<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Video;

/**
 * @Route("/")
 */
class DefaultController extends Controller {

    /**
     * @Route("", name="homepage")
     */
    public function indexAction(Request $request) {
     
        /*
        $repository = $this->getDoctrine()
            ->getRepository(Video::class);

        $query = $repository->createQueryBuilder('v')
            ->orderBy('v.createdAt', 'DESC')
            ->setMaxResults(12)
            ->getQuery();
        $list = $query->getResult();
        
         * 
         */
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            //'videos' => $this->getVideosList()
            'videos' => $this->getVideosList()
        ]);
    }

    /**
     * @Route("ajax/getVideos", name="ajax_get_videos")
     */    
    public function ajaxGetVideoAction(Request $request) {
        return $this->render('default/ajax.video.html.twig', [
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList()
        ]);        
    }

    /**
     * @Route("about-us", name="about_us")
     */
    public function aboutUsAction(Request $request) {
        return $this->render('default/aboutus.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR
        ]);
    }    
    
    /**
     * @Route("contact-us", name="contact_us")
     */
    public function contactUsAction(Request $request) {
        return $this->render('default/contactus.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR
        ]);
    }    
    
    /**
     * Displays single video in separate page.
     *
     * @Route("view/{slug}", name="view_single_video")
     * @Method({"GET"})
     */
    public function viewVideoAction(Request $request, $slug) {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository(Video::class)->findOneBy(array('slug' => $slug));
        return $this->render('default/video_single_view.html.twig', ['video' => $video]);
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
    private function getVideosList($limit = 12, $category = 'Sports') {
        /*
        $dql = "SELECT v.id, v.slug, v.description, FROM video v JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";
        $query = $entityManager->createQuery($dql);
        $query->setMaxResults(30);
        $bugs = $query->getResult();        
        */

        $repository = $this->getDoctrine()
            ->getRepository(Video::class);

        $qb = $repository->createQueryBuilder('v')
            ->orderBy('v.createdAt', 'DESC')
            ->setMaxResults($limit);
        
        // Set query in 
        if (!empty($category)) {
            //$qb->add('where', 'v.Category.name=?1');
            //$qb->setParameter('1', $category);
        }
        
        $query = $qb->getQuery();        
        return $query->getResult();
    }

}
