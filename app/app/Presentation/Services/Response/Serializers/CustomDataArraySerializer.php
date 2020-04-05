<?php

namespace App\Presentation\Services\Response\Serializers;

use InvalidArgumentException;
use League\Fractal\Serializer\ArraySerializer;

/**
 * Class CustomDataArraySerializer
 * @package App\Presentation\Services\Response\Serializers
 */
class CustomDataArraySerializer extends ArraySerializer
{
    /**
     * @var string
     */
    private string $baseUrl;

    /**
     * DataArraySerializer constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {
        $resources = [];
        foreach ($data as $resource) {
            $resources[] = $this->item($resourceKey, $resource);
        }

        return $resources;
    }

    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        $id = $this->getIdFromData($data);

        $resource = [
            'type' => $resourceKey,
            'id' => "$id",
            'attributes' => $data,
        ];

        unset($resource['attributes']['id']);

        if (isset($resource['attributes']['links'])) {
            $custom_links = $data['links'];
            unset($resource['attributes']['links']);
        }

        if (isset($resource['attributes']['meta'])) {
            $resource['meta'] = $data['meta'];
            unset($resource['attributes']['meta']);
        }

        $resource['links'] = [
            'self' => "{$this->baseUrl}/$resourceKey/$id",
        ];
        if (isset($custom_links)) {
            $resource['links'] = array_merge($custom_links, $resource['links']);
        }

        return $resource;
    }

    /**
     * @param array $data
     *
     * @return integer
     */
    protected function getIdFromData(array $data)
    {
        if (!array_key_exists('id', $data)) {
            throw new InvalidArgumentException(
                'JSON API resource objects MUST have a valid id'
            );
        }

        return $data['id'];
    }

    /**
     * Serialize null resource.
     *
     * @return array
     */
    public function null()
    {
        return [];
    }
}
