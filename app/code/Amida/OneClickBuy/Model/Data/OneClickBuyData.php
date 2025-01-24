<?php

namespace Amida\OneClickBuy\Model\Data;

use Amida\OneClickBuy\Api\Data\OneClickBuyInterface;
use Magento\Framework\DataObject;

class OneClickBuyData extends DataObject implements OneClickBuyInterface
{
    /**
     * Getter for EntityId.
     *
     * @return int|null
     */
    public function getEntityId(): ?int
    {
        return $this->getData(self::ENTITY_ID) === null ? null
            : (int)$this->getData(self::ENTITY_ID);
    }

    /**
     * Setter for EntityId.
     *
     * @param int|null $entityId
     *
     * @return void
     */
    public function setEntityId(?int $entityId): void
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Getter for ProductSku.
     *
     * @return string|null
     */
    public function getProductSku(): ?string
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * Setter for ProductSku.
     *
     * @param string|null $productSku
     *
     * @return void
     */
    public function setProductSku(?string $productSku): void
    {
        $this->setData(self::PRODUCT_SKU, $productSku);
    }

    /**
     * Getter for PhoneNumber.
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    /**
     * Setter for PhoneNumber.
     *
     * @param string|null $phoneNumber
     *
     * @return void
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * Getter for Date.
     *
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->getData(self::DATE);
    }

    /**
     * Setter for Date.
     *
     * @param string|null $date
     *
     * @return void
     */
    public function setDate(?string $date): void
    {
        $this->setData(self::DATE, $date);
    }

    /**
     * Getter for Timestamp.
     *
     * @return string|null
     */
    public function getTimestamp(): ?string
    {
        return $this->getData(self::TIMESTAMP);
    }

    /**
     * Setter for Timestamp.
     *
     * @param string|null $timestamp
     *
     * @return void
     */
    public function setTimestamp(?string $timestamp): void
    {
        $this->setData(self::TIMESTAMP, $timestamp);
    }
}
