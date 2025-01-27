<?php

namespace Amida\OneClickBuy\Block\Catalog\Product\View;

use \Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class OneClickBuy extends Template
{
    /**
     * @var Registry
     */
    private Registry $registry;

    /**
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->registry = $registry;
        parent::__construct($context);
    }

    /**
     * @return mixed|null
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * @return string
     */
    public function getProductSku(): string
    {
        return $this->getCurrentProduct()->getSku();
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return true;
    }
}
