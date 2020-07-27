<?php

namespace App\Http\Responses\Api;

use Illuminate\Http\JsonResponse as CoreJsonResponse;
use Illuminate\Http\Response;

/**
 * Class JsonResponse
 * @package Sendpulse\ApiBase\Http\Responses
 */
class JsonResponse extends CoreJsonResponse
{
    /**
     * @var array = [
     *      'success' => '(bool)',
     *      'data' => '(mixed)',
     *      'message' => '!(string)',
     *      'error_code' => '!(int)'
     * ]
     */
    protected $responseData = ['success' => true];

    /**
     * JsonResponse constructor.
     * @param null $data
     * @param int $status
     * @param array $headers
     * @param int $options
     */
    public function __construct($data = null, $status = Response::HTTP_OK, $headers = [], $options = 0)
    {
        parent::__construct($data, $status, $headers, $options);
        $this->responseData['data'] = $data;
        parent::setData($this->responseData);
        $this->update();
    }

    /**
     * @param int $errorCode
     * @return JsonResponse
     */
    public function setErrorCode(int $errorCode): self
    {
        $this->responseData['error_code'] = $errorCode;
        $this->responseData['success'] = false;
        parent::setData($this->responseData);
        $this->update();

        return $this;
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function setMessage(string $message): self
    {
        $this->responseData['message'] = $message;
        parent::setData($this->responseData);
        $this->update();

        return $this;
    }

    /**
     * @param string $message
     * @param string $key
     * @return $this
     */
    public function addErrorMessage(string $message, string $key = '*'): self
    {
        if (empty($this->responseData['errors'])) {
            $this->responseData['errors'] = [];
        }

        if (empty($this->responseData['errors'][$key])) {
            $this->responseData['errors'][$key] = [];
        }

        $this->responseData['errors'][$key][] = $message;

        if (!$this->isClientError() && !$this->isServerError()) {
            $this->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        parent::setData($this->responseData);
        $this->update();

        return $this;
    }

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    public function setData($data = null): self
    {
        $this->responseData['data'] = $data;
        parent::setData($this->responseData);
        $this->update();

        return $this;
    }

    public function setStatusCode(int $code, $text = null): object
    {
        if (empty($this->responseData['error_code']) && ($this->isServerError() || $this->isClientError())) {
            $this->responseData['success'] = false;
            $this->responseData['error_code'] = $this->getStatusCode();
            parent::setData($this->responseData);
        }

        $this->update();

        return $this;
    }
}
