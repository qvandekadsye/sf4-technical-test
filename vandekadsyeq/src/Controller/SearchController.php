<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\GitHubSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
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
     * @Method({"GET","POST"})
     */
    public function CommentAction(Request $request, UserInterface $user)
    {
        $repositoriesExist = false;
        $githubUsername=$request->get('username');
        $entityManager = $this->getDoctrine()->getManager();
        $comments = $entityManager->getRepository('App\\Entity\\Comment')->findBy(array('githubUser'=>$githubUsername));
        $comment = new Comment();
        $comment->setGithubUser($githubUsername);
        $comment->setAuthor($user);
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $headers = array('Accept' => 'application/json');
            $param = $comment->getRepositoryName();
            $query = array('q' =>$param);

            $response = Unirest\Request::get('https://api.github.com/search/repositories',$headers,$query);
            $repositories = $response->body->items;
            foreach ($repositories as $repository)
            {
                var_dump($repository->owner->login); die;
                if ($repository->owner->login == $githubUsername)
                {
                    $repositoriesExist = true;
                    var_dump($repositoriesExist);die;

                }

            }

            if($repositoriesExist)
            {
                $entityManager->persist($comment);
                $entityManager->flush();
            }




        }

        return $this->render('search/comment.html.twig', [
            'githubUserName' => $githubUsername,
            'commentaires' => $comments,
            'form' => $form->createView()]);

    }
}
