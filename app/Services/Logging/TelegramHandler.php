<?php

namespace App\Services\Logging;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

/**
 * Telegram Handler For Monolog
 * Class TelegramHandler
 * @package Sendpulse\ApiBase\Components\Logging
 */
class TelegramHandler extends AbstractProcessingHandler
{
    /**
     *
     */
    protected const API_HOST = 'https://api.telegram.org/bot';

    /**
     *
     */
    protected const LOG_LEVEL_EMOJI = [
        Logger::DEBUG => '👻',
        Logger::INFO => '',
        Logger::NOTICE => '👾',
        Logger::WARNING => '❕',
        Logger::ERROR => '☠️',
        Logger::CRITICAL => '☠️',
        Logger::ALERT => '👀',
        Logger::EMERGENCY => '🤕',
    ];

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $channel;

    /**
     * @param string $token Telegram Bot Access Token Provided by BotFather
     * @param string $channel Telegram Channel userName or ID
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($token, $channel, $level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->token = $token;
        $this->channel = $channel;
    }

    /**
     * @param array $record
     */
    public function write(array $record): void
    {
        $message = $this->getEmoji($record['level']) . PHP_EOL . $record['formatted'];
        $this->send($message);
    }

    /**
     * Send log to telegram channel
     *
     * @param string $message Text Message
     * @return bool
     */
    public function send(string $message): bool
    {
        $message = \mb_substr($message, 0, 1000);
        $url = self::API_HOST . $this->token . '/SendMessage';
        $ch = \curl_init($url);

        $query = ['text' => $message, 'chat_id' => $this->channel, 'parse_mode' => 'HTML'];
        \curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        \curl_setopt($ch, CURLOPT_POSTFIELDS, \http_build_query($query));
        $result = \curl_exec($ch);
        $code = \curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($result === false || \curl_errno($ch)) {
            Log::channel('single')->error(
                'Curl error: ' . \curl_error($ch) . ' (code: ' . \curl_errno($ch) . ')'
            );

            return false;
        }

        \curl_close($ch);
        $result = \json_decode($result, true) ?: [];
        $resultOk = $result['ok'] ?? false;

        if ($code >= Response::HTTP_MULTIPLE_CHOICES || $resultOk === false) {
            Log::channel('single')->error('Telegram api bad request', $result);

            return false;
        }

        return true;
    }

    /**
     * @param int $level
     * @return string
     */
    protected function getEmoji(int $level): string
    {
        return self::LOG_LEVEL_EMOJI[$level];
    }
}
