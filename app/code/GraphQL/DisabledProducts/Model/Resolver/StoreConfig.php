<?php


namespace GraphQL\DisabledProducts\Model\Resolver;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use GraphQL\Deferred;

class StoreConfig implements ResolverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, $info, array $value = null, array $args = null): Value
    {
        $executor = function () use ($field, $context, $info, $value, $args) {
            $websiteDefaultTitle = $this->scopeConfig->getValue(
                'general/store_info/website_default_title',
                ScopeInterface::SCOPE_STORE
            );

            $websiteDefaultIndex = $this->scopeConfig->getValue(
                'general/store_info/website_default_index',
                ScopeInterface::SCOPE_STORE
            );

            return [
                'website_default_title' => $websiteDefaultTitle,
                'website_default_index' => $websiteDefaultIndex,
            ];
        };

        return new Value(new Deferred($executor));
    }
}
