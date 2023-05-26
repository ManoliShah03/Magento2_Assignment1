<?php

namespace Sigma\ShippingAddress\Plugin\Checkout\Model;

use Magento\Quote\Api\Data\AddressInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteRepository;

class ShippingInformationManagement
{
    /**
     * @param QuoteRepository $quoteRepository
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        private QuoteRepository $quoteRepository,
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    /**
     * @param Magento\Quote\Api\Data\AddressInterface $subject
     * @param $cartId
     * @param Magento\Quote\Api\Data\AddressInterface $addressInformation
     * @throws NoSuchEntityException
     * @throws \Zend_Log_Exception
     */
    public function beforeSaveAddressInformation(
        Magento\Quote\Api\Data\AddressInterface $subject,
        $cartId,
        AddressInterface $addressInformation,
    ) {

        if(!$addressInformation->getExtensionAttributes())
        {
            return;
        }

        $quote = $this->cartRepository->getActive($cartId);

        $custom_middle_name_value = $addressInformation->getExtensionAttributes()->getMiddleName();
        $quote->setMiddleName($custom_middle_name_value);
        $this->cartRepository->save($quote);
        return [$cartId, $addressInformation];
//        $quote->setMiddleName($extAttributes->getMiddleName());
    }
}
