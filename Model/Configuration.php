<?php

declare(strict_types=1);

namespace Mooore\ElasticsearchRelevance\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Configuration
{
    const CONFIG_PATH_ELASTICSEARCH_MIN_SCORE = 'catalog/search/elasticsearch_min_score';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getMinScore(): float
    {
        return (float) $this->scopeConfig->getValue(self::CONFIG_PATH_ELASTICSEARCH_MIN_SCORE);
    }
}
