<?php
/**
 * Created by PhpStorm.
 * User: quentinvdk
 * Date: 20/04/18
 * Time: 15:18
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class GitHubSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('githubsearch')
            ->add('Login', SubmitType::class)
        ;
    }

}