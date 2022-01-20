<?php

declare (strict_types=1);

namespace app\middleware;

use thans\jwt\exception\JWTException;
use thans\jwt\exception\TokenBlacklistException;
use thans\jwt\exception\TokenBlacklistGracePeriodException;
use thans\jwt\exception\TokenExpiredException;
use thans\jwt\middleware\JWTAuth;
use think\exception\HttpException;

/**
 * JWT验证刷新token机制
 * Class JWTToken
 * @package app\api\middleware
 */
class JWT extends JWTAuth
{
    /**
     * 刷新token
     * @param $request
     * @param \Closure $next
     * @return mixed
     * @throws JWTException
     * @throws TokenBlacklistException
     * @throws TokenBlacklistGracePeriodException
     */
    public function handle($request, \Closure $next): object
    {
        try {
            $payload = $this->auth->auth();
        } catch (TokenExpiredException $e) { // 捕获token过期
            trace(1);
            // 尝试刷新token，会将旧token加入黑名单
            try {
                $this->auth->setRefresh();
                $token = $this->auth->refresh();
                $payload = $this->auth->auth(false);
            } catch (TokenBlacklistGracePeriodException $e) {
                trace(2);
                $payload = $this->auth->auth(false);
            } catch (JWTException $exception) {
                trace(3);
                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new HttpException(401, $exception->getMessage());
            }
        } catch (TokenBlacklistGracePeriodException $e) { // 捕获黑名单宽限期
            trace(4);
            $payload = $this->auth->auth(false);
        } catch (TokenBlacklistException $e) { // 捕获黑名单，退出登录或者已经自动刷新，当前token就会被拉黑
            trace(5);
            throw new HttpException(401, '未登录..');
        }

        // 可以获取payload里自定义的字段，比如uid
        $request->uid = $payload['uid']->getValue();

        $response = $next($request);

        // 如果有新的token，则在响应头返回（前端判断一下响应中是否有 token，如果有就直接使用此 token 替换掉本地的 token，以此达到无痛刷新token效果）
        if (isset($token)) {
            $this->setAuthentication($response, $token);
        }

        return $response;
    }
}