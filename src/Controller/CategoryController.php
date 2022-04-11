<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/category" , name="category_")
 */
class CategoryController extends AbstractController
{

    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();
        return $this->render(
            'category/index.html.twig',
            ['category' => $category]
        );
    }
    /**
     * @Route("/{categoryName}", methods={"GET"}, name="show")
     */

    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name '.$categoryName.' found in category\'s table.'
            );
        };

        $prog = $programRepository->findBy(['category' => $category],['id' => 'DESC']);
        return $this->render(
            'category/show.html.twig',
            ['program' => $prog, 'category' => $category]
        );
    }

}
