<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\{
    Extension\Core\Type\CheckboxType, Extension\Core\Type\EmailType, Extension\Core\Type\IntegerType, Extension\Core\Type\SubmitType, Extension\Core\Type\TextType
};
use Symfony\Component\{
    HttpFoundation\JsonResponse, HttpFoundation\Request, HttpFoundation\Response, Validator\Constraints\Email, Validator\Constraints\GreaterThanOrEqual, Validator\Constraints\Length, Validator\Constraints\LessThanOrEqual, Validator\Constraints\NotBlank, Validator\Constraints\Required, Validator\Constraints\Type
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