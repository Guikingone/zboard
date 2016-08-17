<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class FormationService
{
    /**
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * @var FormFactory
     */
    protected $form;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var TokenStorage
     */
    private $user;

    /**
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     * @param TokenStorage  $user
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, Session $session, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->session = $session;
        $this->user = $user;
    }

    public function getFormation()
    {
        $etapesUser = array();
        $etapes = $this->doctrine->getRepository('MentoratBundle:FormationEtape')->findAll();
        $idUser = $this->user->getToken()->getUser()->getId();
        $userAd = $this->doctrine->getRepository('MentoratBundle:FormationEtapeUser')->findBy(array('idUser' => $idUser));

        foreach ($etapes as $etape) {
            $validate = false;
            $hasContent = $etape->getRequiresInput();
            $content = null;

            foreach ($userAd as $etp) {
                if ($etp->getIdEtape() == $etape->getId()) {
                    $validate = true;
                    $content = $etp->getContent();
                }
            }

            array_push($etapesUser, array('etape' => $etape->getEtape(),
                  'id'=>$etape->getId(),
                  'validate' => $validate,
                  'hasContent' => $hasContent,
                  'content' => $content,
                ));
        }

        return $etapesUser;
    }

    public function updateFormation(Request $request)
    {
        //Start by checking if line already exists
        $exists = (count($this->doctrine->getRepository('MentoratBundle:FormationEtapeUser')->findBy(array('idUser' => 4,'idEtape'=>5)))==1);
    }
}
