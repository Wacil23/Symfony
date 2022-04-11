<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     */
    public function index(ProgramRepository $program) : Response
    {
        $programs = $program->findAll();
        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }
    /**
     * @Route("/show/{id<^[0-9]+$>}", methods={"GET"}, name="show")
     */
    public function show(int $id, ProgramRepository $program): Response
    {
        $programs = $program->findOneBy(['id' => $id]);
        if (!$programs){
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }
        
        return $this->render('program/show.html.twig', [
            'program' => $programs
        ]);
    }
}

