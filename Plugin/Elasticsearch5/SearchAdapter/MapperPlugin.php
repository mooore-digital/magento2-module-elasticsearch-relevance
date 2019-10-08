<?php

declare(strict_types=1);

namespace Mooore\ElasticsearchRelevance\Plugin\Elasticsearch5\SearchAdapter;

use Magento\Elasticsearch\Elasticsearch5\SearchAdapter\Mapper;
use Magento\Framework\Search\RequestInterface;
use Mooore\ElasticsearchRelevance\Model\Configuration;

class MapperPlugin
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param Mapper $subject
     * @param callable $proceed
     * @param RequestInterface $request
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameters)
     */
    public function aroundBuildQuery(
        Mapper $subject,
        callable $proceed,
        RequestInterface $request
    ) {
        $searchQuery = $proceed($request);

        if ($request->getName() === 'quick_search_container') {
            $searchQuery['body']['min_score'] = $this->configuration->getMinScore();
        }

        return $searchQuery;
    }
}
