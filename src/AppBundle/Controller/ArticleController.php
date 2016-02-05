<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Controller\AbstractFrontEndController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 * @package AppBundle\Controller
 *
 * @Route("article")
 */

class ArticleController extends AbstractFrontEndController
{
    /**
     * @Route("/", name="article_list")
     * @return Response
     */
    public function indexAction()
    {
        $ArticleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

        $params = $this->getAsideData();
        $params['allArticles'] = $ArticleRepository->findAll();

        return $this->render('article/index.html.twig', $params);
    }

    /**
     * @Route("/{id}", name="article_details")
     * @return Response
     */
    public function detailsAction($id)
    {
        $ArticleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

        $params = $this->getAsideData();
        $params['article'] = $ArticleRepository->find($id);

        return $this->render('article/details.html.twig', $params);
    }

    /**
     * @Route("/by-tag/{tag}", name="article_by_tag")
     * @param $tag
     * @return Response
     */
    public function showByTagAction($tag){
        $ArticleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

        $params = $this->getAsideData();
        $params['allArticles'] = $ArticleRepository->getArticleByTag($tag);
        $params['queryTitle'] = "par tag : $tag";

        return $this->render('article/index.html.twig', $params);
    }

    /**
     * @Route("/by-year/{year}", name="article_by_year",
     * requirements={"year": "\d{4}"}
     * )
     * @param $year
     * @return Response
     */
    public function showByYearAction($year){
        $ArticleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');

        $params = $this->getAsideData();
        $params['allArticles'] = $ArticleRepository->getArticleByYear($year);
        $params['queryTitle'] = "par année : $year";

        return $this->render('article/index.html.twig', $params);
    }

    /**
     * @Route("/by-author/{id}", name="article_by_author",
     * requirements={"id": "\d+"}
     * )
     * @param $id
     * @return Response
     */
    public function showByAuyhorAction($id){
        $ArticleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $authorRepository = $this->getDoctrine()->getRepository('AppBundle:Author');

        $author = $authorRepository->find($id);

        $params = $this->getAsideData();
        $params['allArticles'] = $ArticleRepository->getArticleByAuthor($id);
        $params['queryTitle'] = "par auteur : ".$author->getFullName();

        return $this->render('article/index.html.twig', $params);
    }

    /**
     * @Route("/new", name="article_new")
     * @Route("/edit/{id}", name="article_edit")
     * @param int $id
     * @return Response
     */
    public function addEditAction($id = null)
    {
        return $this->render('article/form.html.twig');
    }
}
