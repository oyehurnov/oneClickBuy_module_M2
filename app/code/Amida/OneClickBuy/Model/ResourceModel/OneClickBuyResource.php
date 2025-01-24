<?php

namespace Amida\OneClickBuy\Model\ResourceModel;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OneClickBuyResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'amida_oneclickbuy_data_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('amida_oneclickbuy_data', OneClickBuyInterface::ENTITY_ID);
        $this->_useIsObjectNew = true;
    }
}
