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
            'subtitle' => '<i>Ty i ja spośród tysięcy<br>mocno trzymamy się za ręce.<br>Niezwykły dzień, doniosła chwila<br>i szept nieśmiały: miły&hellip; miła&hellip;<br>Odtąd już razem zawsze i wszędzie,<br>tak miało być i niech tak będzie!</i> <br><br> <strong>28 września 2018r</strong>',
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
            'subtitle'    => '<strong>Ceremonia ślubna</strong> odbędzie się w&nbsp;kameralnym Kościele Rzymskokatolickim pw.&nbsp;św.&nbsp;Michała, znajdującym się w&nbsp;Słowieńsku.<br><br><strong>Przyjęcie weselne</strong> odbędzie się nad pięknym jeziorem, w&nbsp;Ośrodku Wczasowo-Rekreacyjnym przy ul.&nbsp;Wczasowej&nbsp;1,&nbsp;78-300&nbsp;Świdwin.<br><a href="https://www.google.pl/maps/dir//Ko%C5%9Bci%C3%B3%C5%82+Rzymskokatolicki+pw.+%C5%9Bw.+Micha%C5%82a,+S%C5%82owie%C5%84sko,+1052Z,+78-314/Bukowiec+%7C+O%C5%9Brodek+Wczasowo-Rekreacyjny,+Wczasowa,+%C5%9Awidwin/@53.8490509,15.3861958,10.53z/data=!4m15!4m14!1m0!1m5!1m1!1s0x47005a3db5ffd1ad:0xac4803873b5fd93b!2m2!1d15.6409371!2d53.8647279!1m5!1m1!1s0x470055f0ef933295:0x5fe8dc2d078f4d33!2m2!1d15.7638668!2d53.7499322!3e0" target="_blank">Możesz tu zaplanować trasę</a>',
            'zoom'        => 10,
            'center'      => [53.8013, 15.2384],
            'markers'     => [
                '<strong>Kościół Rzymskokatolicki</strong><br>pw.&nbsp;św.&nbsp;Michała,<br>Słowieńsko, 78-314'      => [53.86477, 15.64087],
                '<strong>Sala weselna</strong><br>Ośrodek&nbsp;Wczasowo-Rekreacyjny,<br>Wczasowa 1, 78-300 Świdwin' => [53.75000, 15.76401]
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
            'subtitle' => 'W kościele spotykamy się wszyscy, aby wspólnie przeżyć uroczystość zawarcia małżeństwa Martyny&nbsp;i&nbsp;Marka.<br><br>Ceremonia ślubna zaczyna się o&nbsp;godzinie <strong>15:30</strong>.',
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