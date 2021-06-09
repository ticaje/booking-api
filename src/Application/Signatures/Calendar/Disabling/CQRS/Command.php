<?php
declare(strict_types=1);

/**
 * Domain Policy Class
 * @package Ticaje_BookingApi
 * @author Hector Luis Barrientos <ticaje@filetea.me>
 */

namespace Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS;

/**
 * Class Command
 * @package Ticaje\BookingApi\Application\Signatures\Calendar\Disabling\CQRS
 */
class Command implements CommandSignature
{
    /**
     * @inheritDoc
     */
    public function extractType(array $input): array
    {
        $result = [
            'single' => (function () use ($input) {
                $result['rule'] = json_encode(['date' => $input['date']]);
                $result['period'] = $input['period'];
                return $result;
            }),
            'period' => (function () use ($input) {
                $result['rule'] = json_encode(['from' => $input['disableFrom'], 'to' => $input['disableTo']]);
                $result['period'] = $input['period'];
                return $result;
            }),
            'recurrent_day' => (function () use ($input) {
                $result['rule'] = json_encode(['dayOfWeek' => $input['dayOfWeek']]);
                $result['period'] = $input['period'];
                return $result;
            })
        ];
        return $result[$input['period']]();
    }
}
