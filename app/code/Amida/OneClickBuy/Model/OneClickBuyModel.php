<?php

namespace Amida\OneClickBuy\Model;

use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyResource;
use Magento\Framework\Model\AbstractModel;

class OneClickBuyModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'amida_oneclickbuy_data_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(OneClickBuyResource::class);
    }
}
