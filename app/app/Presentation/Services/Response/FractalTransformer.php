<?php

namespace App\Presentation\Services\Response;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Presentation\Services\Response\Contracts\TransformerInterface;
use App\Presentation\Services\Response\Serializers\CustomDataArraySerializer;
use App\Presentation\Services\Response\Serializers\CustomPaginatedArraySerializer;

/**
 * Class FractalTransformer
 * @package App\Presentation\Services\Response
 */
class FractalTransformer
{
    /**
     * @var Manager
     */
    private Manager $manager;

    /**
     * FractalResponse constructor.
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
        $this->manager->setSerializer(new CustomDataArraySerializer(url('/') . '/api'));
    }

    /**
     * @param $item
     * @param $transformer
     * @return Item
     */
    public function createItem($item, TransformerInterface $transformer)
    {
        return new Item($item, $transformer, $transformer->getResourceKey());
    }

    /**
     * @param $collection
     * @param TransformerInterface $transformer
     * @return Collection|mixed
     */
    public function createCollection($collection, TransformerInterface $transformer)
    {
        $resources = new Collection($collection, $transformer, $transformer->getResourceKey());

        if ($collection instanceof LengthAwarePaginator) {
            $resources->setPaginator(new IlluminatePaginatorAdapter($collection));
        }

        return $resources;
    }

    /**
     * @param $data
     * @param array|null $includes
     * @return array
     */
    public function createData($data, array $includes = null): array
    {
        if ($includes) {
            $this->manager->parseIncludes($includes);
        }

        if ($data instanceof Collection && ($data->getPaginator())) {
            $baseUrl = url('/') . '/api';
            $this->manager->setSerializer(new CustomPaginatedArraySerializer($baseUrl));
        }

        return $this->manager->createData($data)->toArray();
    }
}
