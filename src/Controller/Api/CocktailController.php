<?php 

namespace App\Controller\Api;

use App\Dto\CocktailQueryDto;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/coctail', name: 'api_coctail_')]
final class CocktailController extends AbstractController
{

    public function __construct(
        private readonly CocktailRepository $repository,
        private readonly SerializerInterface $serializer
        )
    {}

    #[Route('/', name: 'list' , methods: ['GET'])]
    public function index(#[MapQueryString] CocktailQueryDto $query):Response
    {
        $coctails = $this->repository->findAllWithQuery($query);
        $data = $this->serializer->serialize($coctails, 'json');
        return JsonResponse::fromJsonString($data);
    }
}