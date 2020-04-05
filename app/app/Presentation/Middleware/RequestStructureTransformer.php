<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class RequestParametersTransformer
 * @package App\Presentation\Middleware
 */
class RequestStructureTransformer
{
    private const SORT_PARAM = 'sort';
    private const FILTER_PARAM = 'filter';
    private const INCLUDE_PARAM = 'include';
    private const ASC_SORTING_ORDER = 'ASC';
    private const DESC_SORTING_ORDER = 'DESC';

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestParameters = $request->all();

        $requestParameters[self::INCLUDE_PARAM] = $this->getInclude($requestParameters);
        $requestParameters[self::SORT_PARAM] = $this->getSort($requestParameters);
        $requestParameters[self::FILTER_PARAM] = $this->getFilter($requestParameters);

        $request->merge($requestParameters);

        return $next($request);
    }

    /**
     * @param array $requestParameters
     * @return array
     */
    private function getInclude(array $requestParameters): array
    {
        return isset($requestParameters[self::INCLUDE_PARAM])
            ? explode(',', $requestParameters[self::INCLUDE_PARAM])
            : [];
    }

    /**
     * @param array $requestParameters
     * @return array
     */
    private function getSort(array $requestParameters): array
    {
        return isset($requestParameters[self::SORT_PARAM])
            ? $this->transformSort($requestParameters[self::SORT_PARAM])
            : [];
    }

    /**
     * @param string $sort
     * @return array
     */
    private function transformSort(string $sort): array
    {
        $sortings = explode(',', $sort);
        $result = [];
        foreach ($sortings as $sorting) {
            $result[] = $this->processSorting($sorting);
        }

        return $result;
    }

    /**
     * @param string $sorting
     * @return array
     */
    private function processSorting(string $sorting): array
    {
        $order = preg_match('/^-/', $sorting) ? self::DESC_SORTING_ORDER : self::ASC_SORTING_ORDER;
        if ($order == self::DESC_SORTING_ORDER) {
            $sorting = substr($sorting, 1);
        }

        return ['field' => $sorting, 'order' => $order];
    }

    /**
     * @param array $requestParameters
     * @return array
     */
    private function getFilter(array $requestParameters): array
    {
        return isset($requestParameters[self::FILTER_PARAM])
            ? $requestParameters[self::FILTER_PARAM]
            : [];
    }
}
