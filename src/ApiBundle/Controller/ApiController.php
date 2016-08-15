<?php

namespace ApiBundle\Controller;

use BackendBundle\Entity\Parcours;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiController extends Controller
{
    /**
     * @Route("/get/teachers", name="get_mentors_api")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getMentorsAction()
    {
        $mentors = $this->get('core.user')->getMentors();

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
        $mentores = $this->get('core.user')->getMentores();

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
        $paths = $this->get('core.statistiques')->getParcours();

        $data = [
            'path' => $paths,
        ];

        return new JsonResponse($data);
    }
}
