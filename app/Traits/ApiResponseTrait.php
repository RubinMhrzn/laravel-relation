<?php
namespace App\Traits;

trait ApiResponseTrait
{
    protected $message = '';
    protected $resource = 'Resource';
    protected $permissions = ['index' => 'none', 'show' => 'none', 'store' => 'none', 'update' => 'none', 'destroy' => 'none', 'activation' => 'none', 'reminder' => 'none'];

    public function setMessage($mesage)
    {
        $this->message = $mesage;
    }

    public function permission($perm)
    {
        if ($perm == 'enable') {
            return true;
        }
    }


    protected function continueResponse()
    {
        $response = [
            'status' => 'continue'
        ];
        return response()->json($response, 100);
    }

    protected function switchingProtocolsResponse()
    {
        $response = [];
        return response()->json($response, 101);
    }

    protected function acceptedResponse()
    {
        $response = [
            'status' => 'accepted'
        ];
        return response()->json($response, 202);
    }

    protected function createdResponse($data = NULL)
    {
        $response = [
            'method' => request()->method(),
            'status' => 'success',
            'data' => $data,
            'message' => $this->message ?: 'Success'
        ];
        return response()->json($response, 201);
    }

    protected function showResponse($data = NULL)
    {
        $response = [
            'method' => request()->method(),
            'status' => 'ok',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    protected function successResponse($data = [])
    {
        $response = [
            'method' => request()->method(),
            'status' => 'ok',
            'data' => $data,
            'message' => $this->message ?: 'Success'
        ];
        return response()->json($response, 200);
    }

    protected function listResponse($data = NULL)
    {
        $response = [
            'method' => request()->method(),
            'status' => 'ok',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    protected function updatedResponse($data = NULL)
    {
        $response = [
            'method' => request()->method(),
            'status' => 'updated',
            'data' => $data,
            'message' => $this->message ?: 'Success'
        ];
        return response()->json($response, 201);
    }

    protected function noContentResponse($message = '')
    {
        $this->message = $message ?? $this->message;
        $response = [
            'method' => request()->method(),
            'status' => 'error',
            'message' => $this->message ?: 'No Content'
        ];
        return response()->json($response, 201);
    }

    protected function resetContentResponse($message = '')
    {
        $this->message = $message ?? $this->message;
        $response = [
            'method' => request()->method(),
            'status' => 'error',
            'message' => $this->message ?: 'Reset Content'
        ];
        return response()->json($response, 205);
    }

    protected function partialContentResponse($message = '')
    {
        $this->message = $message ?? $this->message;
        $response = [
            'method' => request()->method(),
            'status' => 'error',
            'message' => $this->message ?: 'Partial Content'
        ];
        return response()->json($response, 206);
    }

    protected function deletedResponse($id)
    {
        $this->message = $message ?? $this->message;
        $response = [
            'status' => 'success',
            'method' => request()->method(),
            'data' => $id,
            'message' => $this->message ?: 'Success'
        ];
        return response()->json($response, 201);
    }

    protected function exceptionResponse($exception = NULL, $code = null)
    {
        if ($exception) {
            $data = [];
            $statusCode = $code ?? $exception->getCode();
            $response = [
                'status' => 'error',
                'code' => $statusCode == 0 ? 422 : $statusCode,
                'method' => request()->method(),
                'message' => $exception->getMessage(),
                'data' => $data
            ];
            return response()->json($response, 422);
        }

        // 400 Bad Request
        // 401 Unauthorized
        // 402 Payment Required
        // 403 Forbidden
        // 404 Not Found
        // 405 Method Not Allowed
        // 406 Not Acceptable
        // 407 Proxy Authentication Required
        // 408 Request Timeout
        // 409 Conflict
        // 410 Gone
        // 412 Precondition Failed
        // 413 Request Entity Too Large
        // 414 Request-URI Too Long
        // 415 Unsupported Media Type
        // 416 Requested Range Not Satisfiable
        // 417 Expectation Failed
        // 500 Internal Server Error
        // 501 Not Implemented
        // 502 Bad Gateway
        // 503 Service Unavailable
        // 504 Gateway Timeout
        // 505 HTTP Version Not Supported
    }

    protected function validationErrorResponse($data = NULL)
    {
        $response = [
            'code' => 422,
            'status' => 'error',
            "message" => "The given data was invalid.",
            "errors" => $data
        ];
        return response()->json($response, $response['code']);
    }

    protected function unAuthorizeResponse()
    {
        $response = [
            'code' => 401,
            'status' => 'error',
            'message' => $this->message ?: 'WARNING! You are not an authorized user, disconnect now. Any attempts to gain unauthorized access will be prosecuted to the fullest extent of the law.'
        ];
        return response()->json($response, $response['code']);
    }

    protected function customErrorResponse($message, $code)
    {
        $response = [
            'code' => $code,
            'status' => 'error',
            "message" => $message,
        ];
        return response()->json($response, $code);
    }
}
