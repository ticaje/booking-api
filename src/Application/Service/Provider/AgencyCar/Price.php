<?php
declare(strict_types=1);

namespace Ticaje\BookingApi\Application\Service\Provider\AgencyCar;

use Ticaje\BookingApi\Application\Service\Provider\BasePriceProvider;
use Ticaje\BookingApi\Application\Signatures\Provider\PriceProviderSignature;
use Ticaje\Hexagonal\Application\Signatures\UseCase\UseCaseCommandInterface;

/**
 * Class Price
 * @package Ticaje\BookingApi\Application\Service\Provider\AgencyCar
 * Low level details kingdom.
 */
class Price extends BasePriceProvider implements PriceProviderSignature
{
    /**
     * @inheritDoc
     */
    public function getPrice(UseCaseCommandInterface $command): float
    {
        /** @var string $indexed */
        $indexed = (string)$this->instance->getSeasonBasedPrices();
        $days = $this->calculateDays($command);
        $key = "{$indexed}";
        $price = $this->extractLogicFromSerializedPrices($command->getProduct()->getData($key), $days->days);
        $price *= (int)$days->days;

        return (float)$price;
    }

    /**
     * @param $unserialized
     * @param $days
     *
     * @return |null
     */
    private function extractLogicFromSerializedPrices($unserialized, $days)
    {
        $rules = $this->normalizePrice($unserialized);
        foreach ($rules as $range => $price) {
            $range = explode('..', $range);
            $storeDays = range($range[0], $range[1]);
            if (in_array($days, $storeDays)) {
                return $price;
            }
        }

        return null;
    }

    /**
     * @param $value
     *
     * @return array
     */
    private function normalizePrice($value): array
    {
        $normalizedArray = [];
        if (!$value) {// Guard clause
            return [];
        }
        $values = explode(';', $value);
        if (empty($values)) {// Guard clause
            return [];
        }
        foreach ($values as $val) {
            $indexValue = explode('=', $val);
            if (isset($indexValue[0]) && $indexValue[0]) {
                $normalizedArray[$indexValue[0]] = $indexValue[1];
            }
        }

        return $normalizedArray;
    }
}
