<?php

namespace MentoratBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use MentoratBundle\Entity\FormationEtapeUser;
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
     * @var TokenStorage
     */
    private $user;

    /**
     * @param EntityManager $doctrine
     * @param FormFactory   $form
     * @param Session       $session
     * @param TokenStorage  $user
     */
    public function __construct(EntityManager $doctrine, FormFactory $form, TokenStorage $user)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
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
                if ($etp->getIdEtape()->getId() == $etape->getId()) {
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
        $etapeID = $request->request->get('id');
        $userID = $this->user->getToken()->getUser();
        //Start by checking if line already exists
        $exists = (count($this->doctrine->getRepository('MentoratBundle:FormationEtapeUser')->findBy(array('idUser' => $userID,'idEtape'=>$etapeID)))==1);

        // If there's already a line, it means the mentor has unchecked the button, so delete the formationetapeuser associated row
        if($exists)
        {
          $etapeUser = $this->doctrine->getRepository('MentoratBundle:FormationEtapeUser')->findOneBy(array('idUser' => $userID,'idEtape'=>$etapeID));
          $this->doctrine->remove($etapeUser);
        }
        // Otherwise the mentor has finished a step, so add it
        else
        {
          // If the etape does not exist, quit
          if((count($this->doctrine->getRepository('MentoratBundle:FormationEtape')->findBy(array('id'=>$etapeID)))==0)) return;
          $etape = new FormationEtapeUser();
          $etape->setIdUser($userID);
          $etape->setIdEtape($this->doctrine->getRepository('MentoratBundle:FormationEtape')
                                     ->findOneBy(array('id' => $etapeID)));
          if(null!=$request->request->get('content'))
              $etape->setContent($content);

          $this->doctrine->persist($etape);
        }
        $this->doctrine->flush();
    }
}
