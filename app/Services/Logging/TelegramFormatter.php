<?php

namespace App\Services\Logging;

use Monolog\Formatter\LineFormatter;

/**
 * Class TelegramFormatter
 * @package App\Services\Logging
 */
class TelegramFormatter extends LineFormatter
{
    /**
     * TelegramFormatter constructor.
     * @param string|null $format
     * @param string|null $dateFormat
     * @param bool $allowInlineLineBreaks
     * @param bool $ignoreEmptyContextAndExtra
     */
    public function __construct(
        $format = null,
        $dateFormat = null,
        $allowInlineLineBreaks = false,
        $ignoreEmptyContextAndExtra = false
    )
    {

        $format = $format ?? '<b>' . config('app.name') . '.%level_name%</b>: <pre>%message%</pre>';
        $dateFormat = $dateFormat ?? 'd.m.Y H:i:s';

        parent::__construct($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
    }
}
