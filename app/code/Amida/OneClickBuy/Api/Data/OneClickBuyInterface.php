<?php

namespace Amida\OneClickBuy\Api\Data;

interface OneClickBuyInterface
{
    /**
     * String constants for property names
     */
    public const ENTITY_ID = "entity_id";
    public const PRODUCT_SKU = "product_sku";
    public const PHONE_NUMBER = "phone_number";
    public const DATE = "date";
    public const TIMESTAMP = "timestamp";

    /**
     * Getter for EntityId.
     *
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * Setter for EntityId.
     *
     * @param int|null $entityId
     *
     * @return void
     */
    public function setEntityId(?int $entityId): void;

    /**
     * Getter for ProductSku.
     *
     * @return string|null
     */
    public function getProductSku(): ?string;

    /**
     * Setter for ProductSku.
     *
     * @param string|null $productSku
     *
     * @return void
     */
    public function setProductSku(?string $productSku): void;

    /**
     * Getter for PhoneNumber.
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string;

    /**
     * Setter for PhoneNumber.
     *
     * @param string|null $phoneNumber
     *
     * @return void
     */
    public function setPhoneNumber(?string $phoneNumber): void;

    /**
     * Getter for Date.
     *
     * @return string|null
     */
    public function getDate(): ?string;

    /**
     * Setter for Date.
     *
     * @param string|null $date
     *
     * @return void
     */
    public function setDate(?string $date): void;

    /**
     * Getter for Timestamp.
     *
     * @return string|null
     */
    public function getTimestamp(): ?string;

    /**
     * Setter for Timestamp.
     *
     * @param string|null $timestamp
     *
     * @return void
     */
    public function setTimestamp(?string $timestamp): void;
}
