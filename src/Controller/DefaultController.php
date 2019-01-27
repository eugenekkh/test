<?php

namespace App\Controller;

use App\CommandBus\AddIpToCheckCommand;
use App\Form\IpCheckAddType;
use App\Repository\IpCheckRepositoryInterface;
use App\Repository\IpCheckResultRepositoryInterface;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    const RESULT_COUNT = 10;

    private $commandBus;
    private $ipCheckRepository;
    private $ipCheckResultRepository;

    public function __construct(
        CommandBus $commandBus,
        IpCheckRepositoryInterface $ipCheckRepository,
        IpCheckResultRepositoryInterface $ipCheckResultRepository
    ) {
        $this->commandBus = $commandBus;
        $this->ipCheckRepository = $ipCheckRepository;
        $this->ipCheckResultRepository = $ipCheckResultRepository;
    }

    /**
     * @Route("/", name="default", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        $command = new AddIpToCheckCommand();
        $form = $this->createForm(IpCheckAddType::class, $command);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);

            $this->addFlash('success', 'Ip address added');

            return $this->redirect($request->getUri());
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
            'ipChecks' => $this->ipCheckRepository->getIpChecks(),
            'ipCheckResults' => $this->ipCheckResultRepository->getLatestResults(static::RESULT_COUNT),
        ]);
    }
}
