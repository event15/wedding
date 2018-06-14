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

    /**
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function homeViewAction()
    {
        return $this->render('base.html.twig');
    }

    public function headerAction(): JsonResponse
    {
        $data = [
            'title'    => 'Martyna <br> <span>&</span> Marek',
            'subtitle' => 'Mają zaszczyt zaprosić w charakterze świadków <br> <br> Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku.',
            'image'    => 'http://wrzesniowyslub.pl/images/header.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function descriptionAction(): JsonResponse
    {
        $data = [
            'title'    => 'Czym jest Lorem Ipsum?',
            'subtitle' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function leafletAction(): JsonResponse
    {
        $data = [
            'title'       => 'Dojazd',
            'subtitle'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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
            'title'    => 'Kościół',
            'subtitle' => 'Lorem ipsum dolor sit amet,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'image'    => 'http://wrzesniowyslub.pl/images/church.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function roomAction(): JsonResponse
    {
        $data = [
            'title'    => 'Wesele',
            'subtitle' => 'Lorem ipsum dolor sit amet,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'image'    => 'http://wrzesniowyslub.pl/images/room.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function room2Action(): JsonResponse
    {
        $data = [
            'title'    => 'Poprawiny',
            'subtitle' => 'Lorem ipsum dolor sit amet,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'image'    => 'http://wrzesniowyslub.pl/images/room2.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function contactAction(): JsonResponse
    {
        $data = [
            'title'    => 'Nocleg',
            'subtitle' => 'Lorem ipsum dolor sit amet,  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. consectetur adipisicing elit.',
            'image'    => 'http://wrzesniowyslub.pl/images/contact.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function slidesAction(): JsonResponse
    {
        $otherData = $this->container->get('App\Controller\HomeController');

        $data = [
             JsonSerializer::deserialize($otherData->leafletAction()->getContent()),
             JsonSerializer::deserialize($otherData->churchAction()->getContent()),
             JsonSerializer::deserialize($otherData->roomAction()->getContent()),
             JsonSerializer::deserialize($otherData->room2Action()->getContent())
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
        $currentData = $request->getContent();

        $result = '';

        if ($currentData) {
            $result = 'OK';
        }

        return new JsonResponse($currentData, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}