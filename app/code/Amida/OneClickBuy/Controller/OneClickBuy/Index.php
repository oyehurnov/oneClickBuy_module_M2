<?php

namespace Amida\OneClickBuy\Controller\OneClickBuy;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Amida\OneClickBuy\Model\OneClickBuyModelFactory;

class Index extends Action
{
    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * @var TimezoneInterface
     */
    private TimezoneInterface $datetime;

    /**
     * @var OneClickBuyModelFactory
     */
    private OneClickBuyModelFactory $oneClickBuyModelFactory;

    /**
     * @param Context $context
     * @param OneClickBuyModelFactory $oneClickBuyModelFactory
     * @param JsonFactory $resultJsonFactory
     * @param TimezoneInterface $datetime
     */
    public function __construct(
        Context $context,
        OneClickBuyModelFactory $oneClickBuyModelFactory,
        JsonFactory $resultJsonFactory,
        TimezoneInterface $datetime
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->datetime = $datetime;
        $this->oneClickBuyModelFactory = $oneClickBuyModelFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            $result['result_message'] = __("We can't submit your request, Please try again.");
            try {
                $data = (array)$this->getRequest()->getPost();
                $data['date'] = $this->datetime->date()->format('Y-m-d');
                $data['timestamp'] = $this->datetime->date()->format('H:i:s');

                if ($data) {
                    $model = $this->oneClickBuyModelFactory->create();
                    $model->setData($data)->save();

                    $result = [
                        'product_sku' => $this->getRequest()->getParam('product_sku'),
                        'phone_number' => $this->getRequest()->getParam('phone_number'),
                        'date_time' => $this->datetime->date()->format('Y-m-d H:i:s'),
                        'result_message' => __("Data Saved Successfully."),
                    ];
                }
            } catch (\Exception $e) {
                //Log exception
            }

            return $resultJson->setData($result);
        } else {

            return $resultJson->setData(null);
        }
    }
}
