<?php

namespace SecuriteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/validate/user/{id}", name="security_validate_user")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validateUserAction($id)
    {
        $this->get('core.security')->validateMentor($id);

        return $this->redirectToRoute('gestion_mentors');
    }

    /**
     * @Route("/validate/student/{id}", name="security_validate_student")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function validateStudentAction($id)
    {
        $this->get('core.security')->validateStudent($id);

        return $this->redirectToRoute('gestion_mentores');
    }
}
