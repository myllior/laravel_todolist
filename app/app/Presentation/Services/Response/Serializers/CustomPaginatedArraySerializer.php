<?php

namespace App\Presentation\Services\Response\Serializers;

/**
 * Class CustomPaginatedArraySerializer
 * @package App\Presentation\Services\Response\Serializers
 */
class CustomPaginatedArraySerializer extends CustomDataArraySerializer
{
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

        return ['data' => $resources];
    }
}
