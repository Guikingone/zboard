<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/get/teachers", name="get_teachers_api")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getMentorsAction()
    {
        $mentors = [
            'firstname' => 'Guillaume', 'lastname' => 'Loulier',
        ];

        $data = [
            'mentors' => $mentors,
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/get/students", name="get_students_api")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getMentoresAction()
    {
        $mentores = [
            'firstname' => 'Toto', 'lastname' => 'From mexico',
        ];

        $data = [
            'mentores' => $mentores,
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/get/paths", name="get_paths_api")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getPathAction()
    {
        $path = [
            'libelle' => 'Android developper', 'certificate' => null,
        ];

        $data = [
            'path' => $path,
        ];

        return new JsonResponse($data);
    }
}
