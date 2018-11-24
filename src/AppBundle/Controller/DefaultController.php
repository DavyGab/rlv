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
     *
     * @var type int
     */
    private $videosPerPage = 12;


    /**
     * @Route("", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList($this->videosPerPage, null)
        ]);
    }

    /**
     * @Route("ajax/getVideos", name="ajax_get_videos")
     */    
    public function ajaxGetVideoAction(Request $request) {        
        $categoryId = $request->request->get('category');
        $loadedVideos = $request->request->get('loadedVideos');
        $loadedVideos = explode(',', $loadedVideos);
        return $this->render('default/ajax.video.html.twig', [
            'categories' => $this->getVideoCategories(),
            'videos' => $this->getVideosList($this->videosPerPage, $categoryId, $loadedVideos)
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
    }
    
    /**;
     * Get list of all videos from database.
     * @return array
     */
    private function getVideosList($limit = 12, $category = null, $loadedVideos= array()) {
        $em = $this->getDoctrine()->getManager();

        if (!empty($category)) {
            $qb = $em->createQueryBuilder();
            $qb->select('v')
               ->from('AppBundle:Video', 'v')
               ->join('v.categories', 'AppBundle:Category')
               ->where('AppBundle:Category.id=?1');
            $qb->setParameter('1', $category);
        } else {
            $repository = $this->getDoctrine()
                ->getRepository(Video::class);
            $qb = $repository->createQueryBuilder('v');
        }
        
       if (!empty($loadedVideos)) {
          $qb->where('v.id NOT IN(?2)');
          $qb->setParameter('2', $loadedVideos);           
       }
        
        $qb->orderBy('v.createdAt', 'DESC');
        $qb->setMaxResults($limit);
        $query = $qb->getQuery();            
        return $query->getResult();
    }

}
