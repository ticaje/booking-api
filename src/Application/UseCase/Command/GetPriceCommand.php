<?php
declare(strict_types=1);

/**
 * Application Command Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\UseCase\Command;

use Ticaje\Contract\Traits\BaseDto;

use Ticaje\BookingApi\Application\Signatures\UseCase\Command\GetPriceCommandSignature;

/**
 * Class GetPriceCommand
 * @package Ticaje\BookingApi\Application\UseCase\Command
 */
class GetPriceCommand implements GetPriceCommandSignature
{
    use BaseDto;

    private $product;

    private $storeId = 0;

    private $fromDate;

    private $toDate;

    private $aggregate;

    /**
     * @inheritDoc
     */
    public function setProduct(&$product): GetPriceCommandSignature
    {
        $this->product = $product;
        return $this;
    }
}
