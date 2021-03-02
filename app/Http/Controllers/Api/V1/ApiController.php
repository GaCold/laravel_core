<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller {

    const CODE_INVALID_TOKEN = 411;

    protected $locale;
    protected $currency;

    public function __construct() {
        $this->locale = request()->header('locale', 'vi');
        $this->currency = request()->header('currency', 'USD');
    }

    /**
     * @param $data
     * @param $messages
     * @param int $status_code
     * @param int $http_code
     * @param array $header
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function sendResponse($data, $messages, $status_code = Response::HTTP_OK, $http_code = Response::HTTP_OK, $header = []) {
        return response([
            'data' => $data,
            'status_code' => $status_code,
            'messages' => $messages
        ], $http_code, $header);
    }
}
