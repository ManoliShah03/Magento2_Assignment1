<?php
namespace Sigma\FreeShippingBar\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Quote\Model\Quote;
use Magento\Shipping\Model\Config\Source\Allmethods;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Magento\Checkout\Model\Session as CheckoutSession;

class Freeshipping extends Template
{
    /**
     * @var Quote
     */
    protected $quote;

    /**
     * @var Allmethods
     */
    protected $allShippingMethods;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var PriceHelper
     */
    protected $priceHelper;

    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * @param Context $context
     * @param Quote $quote
     * @param Allmethods $allShippingMethods
     * @param ScopeConfigInterface $scopeConfig
     * @param PriceHelper $priceHelper
     * @param CheckoutSession $checkoutSession
     * @param array $data
     */
    public function __construct(
        Context              $context,
        Quote                $quote,
        Allmethods           $allShippingMethods,
        ScopeConfigInterface $scopeConfig,
        PriceHelper          $priceHelper,
        CheckoutSession      $checkoutSession,
        array                $data = []
    )
    {
        $this->quote = $quote;
        $this->allShippingMethods = $allShippingMethods;
        $this->scopeConfig = $scopeConfig;
        $this->priceHelper = $priceHelper;
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    /**
     * Get the remaining amount for free shipping
     *
     * @return string|null
     */
    public function isEnable()
    {
        return $this->scopeConfig->getValue('sigma_freeshippingbar/general/enable_disable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getSubtotal()
    {
        return $this->checkoutSession->getQuote()->getSubtotal();
    }

    public function getThreshold()
    {
        return (float)$this->scopeConfig->getValue(
            'sigma_freeshippingbar/general/free_shipping_cutoff',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getMessage()
    {
        if ($this->isEnable()) {
            $quoteTotal = $this->getSubtotal();
            $freeShippingThreshold = $this->getThreshold();

            if ($quoteTotal >= $freeShippingThreshold) {
                return __('Congratulations!! You are eligible for free shipping');
            } else {
                $remainingAmount = $freeShippingThreshold - $quoteTotal;
                return __('You need %1 more for free shipping.', $this->priceHelper->currency($remainingAmount, true, false));
            }
        }
    }
}

