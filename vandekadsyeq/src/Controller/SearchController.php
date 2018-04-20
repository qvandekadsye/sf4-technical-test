<?php

namespace App\Controller;

use App\Form\GitHubSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Unirest;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     * @Method({"GET","POST"})
     */
    public function index(Request $request)
    {
        $form = $this->createForm(GithubSearchType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $headers = array('Accept' => 'application/json');
            $param = $request->request->get('git_hub_search')['githubsearch'];
            $query = array('q' =>$param);

            $response = Unirest\Request::get('https://api.github.com/search/users',$headers,$query);

            return $this->render('search/index.html.twig', [
                'users' => $response->body->items,
                'query'=> $request->request->get('git_hub_search')['githubsearch'],
                'form' => $form->createView()]);

        }

        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/search/{username}/comment", name="comment")
     */
    public function CommentAction()
    {

    }
}
