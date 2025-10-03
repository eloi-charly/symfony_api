<?php 

namespace App\Controller\Api;

use App\Dto\CocktailQueryDto;
use App\Dto\CocktailRequest;
use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/coctail', name: 'api_coctail_')]
final class CocktailController extends AbstractController
{

    public function __construct(
        private readonly CocktailRepository $repository,
        private readonly SerializerInterface $serializer,
        private readonly ObjectMapperInterface $mapper
        )
    {}

    #[Route('/', name: 'list' , methods: ['GET'])]
    public function index(#[MapQueryString] CocktailQueryDto $query):Response
    {
        $coctails = $this->repository->findAllWithQuery($query);
        $data = $this->serializer->serialize($coctails, 'json');
        return JsonResponse::fromJsonString($data);
    }

    #[Route('/', name: 'create' , methods: ['POST'])]
    public function create(#[MapRequestPayload] CocktailRequest $payload):Response
    {
        $cocktail = $this->mapper->map($payload, Cocktail::class);
        $this->repository->save($cocktail);
        return new Response(null, Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update' , methods: ['PATCH', 'PUT'])]
    public function update(
        #[MapEntity] Cocktail $cocktail,
        #[MapRequestPayload] CocktailRequest $payload
    ):Response
    {
        $updateCocktail = $this->mapper->map($payload, $cocktail);
        $this->repository->update($updateCocktail);
        $data = $this->serializer->serialize($updateCocktail, 'json');
         return JsonResponse::fromJsonString($data);
    }


    #[Route('/{id}', name: 'show' , methods: ['GET'])]
    public function show(#[MapEntity] Cocktail $cocktail):Response
    {
        $data = $this->serializer->serialize($cocktail, 'json');
        return JsonResponse::fromJsonString($data);
    }

    #[Route('/{id}', name: 'delete' , methods: ['DELETE'])]
    public function delete(#[MapEntity] Cocktail $cocktail):Response
    {
      $this->repository->remove($cocktail);
      return new Response(null, Response::HTTP_NO_CONTENT);
    }
}