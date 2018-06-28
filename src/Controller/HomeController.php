<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\JsonSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\{
    HttpFoundation\JsonResponse, HttpFoundation\Request, HttpFoundation\Response
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
            'subtitle' => '<i>Ty i ja spośród tysięcy<br>mocno trzymamy się za ręce.<br>Niezwykły dzień, doniosła chwila<br>i szept nieśmiały: miły&hellip; miła&hellip;<br>Odtąd już razem zawsze i wszędzie,<br>tak miało być i niech tak będzie!</i> <br><br> <strong>29 września 2018r</strong>',
            'image'    => 'http://wrzesniowyslub.pl/images/header.jpg'
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function descriptionAction(): JsonResponse
    {
        $data = [
            'title'    => '',
            'subtitle' => ''
        ];

        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    public function leafletAction(): JsonResponse
    {
        $data = [
            'title'       => 'Dojazd',
            'subtitle'    => '<strong>Ceremonia ślubna</strong> odbędzie się w&nbsp;kameralnym Kościele Rzymskokatolickim pw.&nbsp;św.&nbsp;Michała, znajdującym się w&nbsp;Słowieńsku.<br><br><strong>Przyjęcie weselne</strong> odbędzie się nad pięknym jeziorem, w&nbsp;Ośrodku Wczasowo-Rekreacyjnym przy ul.&nbsp;Wczasowej&nbsp;1,&nbsp;78-300&nbsp;Świdwin.<br><a href="https://www.google.pl/maps/dir//Ko%C5%9Bci%C3%B3%C5%82+Rzymskokatolicki+pw.+%C5%9Bw.+Micha%C5%82a,+S%C5%82owie%C5%84sko,+1052Z,+78-314/Bukowiec+%7C+O%C5%9Brodek+Wczasowo-Rekreacyjny,+Wczasowa,+%C5%9Awidwin/@53.8490509,15.3861958,10.53z/data=!4m15!4m14!1m0!1m5!1m1!1s0x47005a3db5ffd1ad:0xac4803873b5fd93b!2m2!1d15.6409371!2d53.8647279!1m5!1m1!1s0x470055f0ef933295:0x5fe8dc2d078f4d33!2m2!1d15.7638668!2d53.7499322!3e0" target="_blank">Tu możesz zaplanować trasę</a>',
            'zoom'        => 10,
            'center'      => [53.8013, 15.2384],
            'markers'     => [
                '<strong>Kościół Rzymskokatolicki</strong><br>pw.&nbsp;św.&nbsp;Michała,<br>Słowieńsko, 78-314'      => [53.86477, 15.64087],
                '<strong>Sala weselna</strong><br>Ośrodek&nbsp;Wczasowo&#8209;Rekreacyjny,<br>Wczasowa 1, 78-300 Świdwin' => [53.75000, 15.76401]
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
            'subtitle' => 'Przyjęcie weselne będziemy mogli wspólnie świętować w&nbsp;Ośrodku Wczasowo&#8209;Rekreacyjnym w&nbsp;leśnym zaciszu jeziora Bukowiec.<br>Zabawa będzie trwać — miejmy nadzieję — do białego rana! Zaczynamy o <strong>17:30</strong>',
            'image'    => 'http://wrzesniowyslub.pl/images/bukowiec.png'
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
            'title'    => 'Potwierdzenie przybycia<br>',
            'subtitle' => "<strong>RSVP</strong>, czyli skrótowiec pochodzący od francuskiego zwrotu <i>répondez s’il vous plaît</i> (dosłownie: proszę odpowiedzieć).<br>",
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