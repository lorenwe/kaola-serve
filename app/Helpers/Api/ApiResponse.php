<?php
namespace App\Helpers\Api;

use Illuminate\Http\Response as FoundationResponse;

trait ApiResponse
{
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * 自定义发送数据
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response()->json($data, FoundationResponse::HTTP_OK, $header);
    }

    /**
     * 生成发送数据
     * @param string $message
     * @param array $data
     * @param $code
     * @return mixed
     */
    private function makeDataAndRespond(array $data, string $message, $code = 200)
    {
        $this->setStatusCode($code ?? 200);

        $arrData = [
            'code' => $this->statusCode,
            'message' => $message
        ];
        $ret = array_merge($arrData, ["data" => $data]);
        return $this->respond($ret);
    }

    /**
     * 仅发送消息
     * @param string $message
     * @param $code
     * @return mixed
     */
    public function message(string $message, $code = 200)
    {
        $this->setStatusCode($code ?? 200);

        $arrData = [
            'code' => $this->statusCode,
            'message' => $message
        ];
        return $this->respond($arrData);
    }

    /**
     * 返回成功
     * http_status始终为200
     * code可以修改
     * 不带data参数
     * @param string|NULL $message
     * @param $code
     * @return mixed
     */
    public function ok(string $message = NULL, $code = 200)
    {
        $this->setStatusCode(200);

        $arrData = [
            'code' => $code ?? 200,
            'message' => $message ?? __("http-statuses.200")
        ];
        return $this->respond($arrData);
    }

    /**
     * 发送数据
     * @param $data
     * @param string|NULL $message
     * @return mixed
     */
    public function success($data = null, string $message = NULL)
    {
        $code = FoundationResponse::HTTP_OK;
        if (!is_array($data)) {
            return $this->respond(['code' => $code,
                    'message' => $message ?? __("http-statuses." . $code),
                    'data' => $data]
            );
        }
        return $this->makeDataAndRespond($data, $message ?? __("http-statuses." . $code));
    }

    /**
     * 发送失败消息
     * @param $message
     * @param $code
     * @return mixed
     */
    public function failed(string $message = NULL, $code = FoundationResponse::HTTP_BAD_REQUEST)
    {
        return $this->message($message ?? __("http-statuses." . $code), $code);
    }

    /**
     * 已创建
     * @param string|NULL $message
     * @return mixed
     */
    public function created(string $message = NULL)
    {
        return $this->failed($message, FoundationResponse::HTTP_CREATED);
    }

    public function locked(string $message = NULL)
    {
        return $this->failed($message, FoundationResponse::HTTP_LOCKED);
    }

    /**
     * 内部错误
     * @param string|NULL $message
     * @return mixed
     */
    public function internalError(string $message = NULL)
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 未找到
     * @param string|null $message
     * @return mixed
     */
    public function notFound(string $message = null)
    {
        return $this->failed($message, Foundationresponse::HTTP_NOT_FOUND);
    }

    /**
     * 禁止访问
     * @param string|NULL $message
     * @return mixed
     */
    public function forbidden(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_FORBIDDEN);
    }

    /**
     * 无内容
     * @param string|NULL $message
     * @return mixed
     */
    public function noContent(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_NO_CONTENT);
    }

    /**
     * 未认证
     * @param string|NULL $message
     * @return mixed
     */
    public function unauthorized(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_UNAUTHORIZED);
    }

    /**
     * 网关错误
     * @param string|NULL $message
     * @return mixed
     */
    public function badGateway(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_BAD_GATEWAY);
    }

    /**
     * 未知错误
     * @param string|NULL $message
     * @return mixed
     */
    public function unknownError(string $message = NULL)
    {
        return $this->failed($message, 520);
    }

    /**
     * 版本不支持
     * @param string|NULL $message
     * @return mixed
     */
    public function versionNotSupported(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_VERSION_NOT_SUPPORTED);
    }

    /**
     * 连接超时
     * @param string|NULL $message
     * @return mixed
     */
    public function connectionTimedOut(string $message = NULL)
    {
        return $this->failed($message, 522);
    }

    /**
     * 已存在
     * @param string|NULL $message
     * @return mixed
     */
    public function found(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_FOUND);
    }

    /**
     * 已冲突
     * @param string|NULL $message
     * @return mixed
     */
    public function conflict(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_CONFLICT);
    }

    /**
     * 已不可用
     * @param string|NULL $message
     * @return mixed
     */
    public function gone(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_GONE);
    }

    /**
     * 已接受
     * @param string|NULL $message
     * @return mixed
     */
    public function accepted(string $message = NULL)
    {
        return $this->failed($message, Foundationresponse::HTTP_ACCEPTED);
    }
}
