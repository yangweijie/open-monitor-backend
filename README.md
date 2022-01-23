# open-monitor

开源的项目性能监控和异常捕获工具


# 接口

## 错误码

| code |                                meaning                                 |
|------|------------------------------------------------------------------------|
|  200 | Everything is ok.                                                      |
|  401 | No valid API Key was given.                                            |
|  404 | The request resource could not be found.                               |
|  422 | The payload has missing required parameters or invalid data was given. |
|  429 | Too many attempts.                                                     |
|  500 | Request failed due to an internal error in Inspector.                  |

## user

user/register
user/login  [jwt]
user/detail
user/update
user/delete

## Projects

projects/ get

projects/id get

projects create

projects put

projects delete

## transactions

projects/:id/transactions

时间段内的transaction 集合

projects/:id/transactions/time-distribution

时段分布 ms: 次数




projects/:id/hosts

projects/:id/performance

按server 分组的 transaction 

projects/:id/transactions/occurrences 的

发生统计



projects/:id/errors

projects/:id/errors/trend


## segement

projects/:id/segement post

## errors


## 备注

/Applications/phpstudy/Extensions/php/php7.4.27/bin/php-config