<?php

namespace Amida\OneClickBuy\Model\ResourceModel\OneClickBuyModel;

use Amida\OneClickBuy\Model\OneClickBuyModel;
use Amida\OneClickBuy\Model\ResourceModel\OneClickBuyResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class OneClickBuyCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'amida_oneclickbuy_data_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(OneClickBuyModel::class, OneClickBuyResource::class);
    }
}
