<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $githubUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $repositoryName;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $commentText;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    public function getId()
    {
        return $this->id;
    }

    public function getGithubUser()
    {
        return $this->githubUser;
    }

    public function setGithubUser($githubUser)
    {
        $this->githubUser = $githubUser;

        return $this;
    }

    public function getRepositoryName()
    {
        return $this->repositoryName;
    }

    public function setRepositoryName( $repositoryName)
    {
        $this->repositoryName = $repositoryName;

        return $this;
    }

    public function getCommentText()
    {
        return $this->commentText;
    }

    public function setCommentText($commentText)
    {
        $this->commentText = $commentText;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor( $author)
    {
        $this->author = $author;

        return $this;
    }
}
