<?php

namespace Sigma\FreeShippingBar\Model\Carrier;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\OfflineShipping\Model\Carrier\Flatrate\ItemPriceCalculator;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory as MethodFactoryAlias;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

class Flatrate extends \Magento\OfflineShipping\Model\Carrier\Flatrate
{

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    const XML_PATH_THRESHOLD_LIMIT = 'sigma_freeshippingbar/general/free_shipping_cutoff';
    private \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory;
    private LoggerInterface $logger;
    private ResultFactory $rateResultFactory;
    private MethodFactoryAlias $rateMethodFactory;
    private ItemPriceCalculator $itemPriceCalculator;
    private array $data;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param ErrorFactory $rateErrorFactory
     * @param LoggerInterface $logger
     * @param ResultFactory $rateResultFactory
     * @param MethodFactoryAlias $rateMethodFactory
     * @param ItemPriceCalculator $itemPriceCalculator
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface                                                $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory          $rateErrorFactory,
        LoggerInterface                                                     $logger,
        ResultFactory                                                       $rateResultFactory,
        MethodFactoryAlias                                                  $rateMethodFactory,
        ItemPriceCalculator $itemPriceCalculator,
        array                                                               $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $rateResultFactory, $rateMethodFactory, $itemPriceCalculator, $data);
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {

        // Call the parent collectRates method to calculate the original shipping rates
        $result = parent::collectRates($request);

        // Check if the order price exceeds the threshold
        $storeScope = ScopeInterface::SCOPE_STORE;
        $threshold = $this->scopeConfig->getValue(self::XML_PATH_THRESHOLD_LIMIT, $storeScope);

        $orderPrice = $request->getBaseSubtotalInclTax();
        if($this->isEnable()){
        if ($orderPrice >= $threshold) {
            // Set the shipping price to zero
            foreach ($result->getAllRates() as $rate) {
                $rate->setPrice(0);
            }
        }
        }

        return $result;
    }
    public function isEnable(){
        return $this->scopeConfig->getValue('sigma_freeshippingbar/general/enable_disable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
