<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController extends Controller
{
	/**
	 * @Route("/user")
	 */
	public function getUserAction()
	{
		$userData = $this->getDoctrine()->getRepository(User::class)->findAll();

		$encoders = array(new JsonEncoder());
		$normalizers = array(new ObjectNormalizer());
		$serializer = new Serializer($normalizers, $encoders);

		$json = $serializer->serialize($userData, 'json');

		return new Response($json);
	}
}