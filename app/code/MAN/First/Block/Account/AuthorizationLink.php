<?php
namespace MAN\First\Block\Account;

use Magento\Customer\Block\Account\AuthorizationLink as CoreAuthorizationLink;

class AuthorizationLink extends CoreAuthorizationLink
{
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->isLoggedIn() ? __('Logout') : __('Login');
    }
}
