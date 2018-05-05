<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\JsonSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\{
    HttpFoundation\JsonResponse, HttpFoundation\Request, HttpFoundation\Response, Validator\Constraints\Email, Validator\Constraints\GreaterThanOrEqual, Validator\Constraints\Length, Validator\Constraints\LessThanOrEqual, Validator\Constraints\NotBlank, Validator\Constraints\Required, Validator\Constraints\Type
};
use Symfony\Component\Form\{
    Extension\Core\Type\CheckboxType, Extension\Core\Type\EmailType, Extension\Core\Type\IntegerType, Extension\Core\Type\SubmitType, Extension\Core\Type\TextType
};

/**
 * Class HomeController
 * @package App\Controller
 */
final class HomeController extends Controller
{
    /**
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function indexAction(): JsonResponse
    {
        $number = [
            'name'           => 'Marek',
            'surname'        => 'Woś',
            'mail'           => 'marwo12@gmail.com',
            'accomodation'   => true,
            'numberOfPeople' => 2
        ];

        return new JsonResponse($number, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function headerAction(): JsonResponse
    {
        $data = [
            'title'    => 'Martyna <br> <span>&</span> Marek',
            'subtitle' => 'Mają zaszczyt zaprosić (...)'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function descriptionAction(): JsonResponse
    {
        $data = [
            'title'    => 'Martyna <br> <span>&</span> Marek',
            'subtitle' => 'Mają zaszczyt zaprosić (...)'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function leafletAction(): JsonResponse
    {
        $data = [
            'title'       => '',
            'subtitle'    => '',
            'zoom'        => 12,
            'center'      => [54.0765753, 18.6546609],
            'markers'     => [
                'Kościół'      => [54.0894, 18.7079],
                'Sala weselna' => [54.07448, 18.70087]
            ],
            'url'         => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            'attribution' => '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function churchAction(): JsonResponse
    {
        $data = [
            'title'    => '',
            'subtitle' => '',
            'image'    => ''
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function roomAction(): JsonResponse
    {
        $data = [
            'title'    => '',
            'subtitle' => '',
            'image'    => ''
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function room2Action(): JsonResponse
    {
        $data = [
            'title'    => '',
            'subtitle' => '',
            'image'    => ''
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function contactAction(): JsonResponse
    {
        $data = [
            'title'    => '',
            'subtitle' => '',
            'image'    => ''
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function slidesAction(): JsonResponse
    {
        $otherData = $this->container->get('App\Controller\HomeController');

        $data = [
            'leaflet'     => JsonSerializer::deserialize($otherData->leafletAction()->getContent()),
            'church'      => JsonSerializer::deserialize($otherData->churchAction()->getContent()),
            'room'        => JsonSerializer::deserialize($otherData->roomAction()->getContent()),
            'room2'       => JsonSerializer::deserialize($otherData->room2Action()->getContent()),
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @param Request $request
     *
     * @throws \Symfony\Component\Validator\Exception\MissingOptionsException
     * @throws \Symfony\Component\Validator\Exception\InvalidOptionsException
     * @throws \Symfony\Component\Validator\Exception\ConstraintDefinitionException
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function bookAction(Request $request)
    {
        $form = $this->createFormBuilder()
                     ->add('name', TextType::class, [
                         'constraints' => [
                             new Required(),
                             new NotBlank(),
                             new Length(['min' => 3, 'max' => 30])
                         ]
                     ])
                     ->add('surname', TextType::class, [
                         'constraints' => [
                             new Required(),
                             new NotBlank(),
                             new Length(['min' => 3, 'max' => 30])
                         ]
                     ])
                     ->add('mail', EmailType::class, [
                         'constraints' => [
                             new Required(),
                             new NotBlank(),
                             new Email([
                                 'message' => 'The email "{{ value }}" is not a valid email.',
                                 'checkHost' => true,
                                 'checkMX' => true,
                                 'strict' => true
                             ]),
                             new Length(['min' => 3])
                         ]
                     ])
                     ->add('accomodation', CheckboxType::class, [
                         'constraints' => [
                             new Required(),
                             new Type(['type' => 'bool']),
                             new NotBlank()
                         ]
                     ])
                     ->add('numberOfPeople', IntegerType::class,[
                         'constraints' => [
                             new Required(),
                             new Type(['type' => 'integer']),
                             new NotBlank(),
                             new GreaterThanOrEqual(['value' => 0]),
                             new LessThanOrEqual(['value' => 10])
                         ]
                     ])
                     ->add('submit', SubmitType::class)
                     ->getForm();

        $handledRequest = $form->handleRequest($request);


        if ($handledRequest->isSubmitted() && $form->isValid()) {
            $data = $handledRequest->getNormData();

            return new JsonResponse($data, 200);
        }

        return $this->render(
            'base.html.twig', [
            'form' => $form->createView()
        ]);
    }
}