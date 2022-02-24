/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : localhost:3306
 Source Schema         : monitor

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 24/02/2022 08:12:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for errors
-- ----------------------------
DROP TABLE IF EXISTS `errors`;
CREATE TABLE `errors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `handled` tinyint(1) DEFAULT '0',
  `group_hash` varchar(32) DEFAULT NULL,
  `muted` tinyint(1) DEFAULT '0',
  `last_seen_at` datetime DEFAULT NULL,
  `class` varchar(255) NOT NULL,
  `file` varchar(1024) DEFAULT NULL,
  `line` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `stack` json DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='异常';

-- ----------------------------
-- Records of errors
-- ----------------------------
BEGIN;
INSERT INTO `errors` VALUES (1, 1, '2022-01-21 13:43:56', '2022-01-21 13:44:00', '123', 1, '2J', 0, NULL, 'Exception', '/Users/imacbook/git/oneblog2/app/index/controller/Index.php', 33, '0', '[{\"args\": [\"int(1)\"], \"code\": [{\"code\": \"\\tpublic function index($page = 1)\", \"line\": 30}, {\"code\": \"\\t{\", \"line\": 31}, {\"code\": \"\\t\\ttrace(11);\", \"line\": 32}, {\"code\": \"\\t\\tthrow new \\\\Exception(123);\", \"line\": 33}, {\"code\": \"\\t\\t// queue(\'app\\\\index\\\\job\\\\TestJob\');\", \"line\": 34}, {\"code\": \"\\t\\tapp()->inspector->addSegment(function () {\", \"line\": 35}, {\"code\": \"\", \"line\": 36}, {\"code\": \"\\t\\t    sleep(1);\", \"line\": 37}, {\"code\": \"\\t\\t    $var = \'asd\';\", \"line\": 38}, {\"code\": \"\", \"line\": 39}], \"file\": \"/Users/imacbook/git/oneblog2/app/index/controller/Index.php\", \"line\": 33, \"type\": \"->\", \"class\": \"app\\\\index\\\\controller\\\\Index\", \"function\": \"index\"}, {\"args\": [\"app\\\\index\\\\controller\\\\Index\", \"array(1)\"], \"code\": [{\"code\": \"    {\", \"line\": 340}, {\"code\": \"        $args = $this->bindParams($reflect, $vars);\", \"line\": 341}, {\"code\": \"\", \"line\": 342}, {\"code\": \"        return $reflect->invokeArgs($instance, $args);\", \"line\": 343}, {\"code\": \"    }\", \"line\": 344}, {\"code\": \"\", \"line\": 345}, {\"code\": \"    /**\", \"line\": 346}, {\"code\": \"     * 调用反射执行callable 支持参数绑定\", \"line\": 347}, {\"code\": \"     * @access public\", \"line\": 348}, {\"code\": \"     * @param mixed $callable\", \"line\": 349}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Container.php\", \"line\": 343, \"type\": \"->\", \"class\": \"ReflectionMethod\", \"function\": \"invokeArgs\"}, {\"args\": [\"app\\\\index\\\\controller\\\\Index\", \"ReflectionMethod\", \"array(0)\"], \"code\": [{\"code\": \"                    throw new HttpException(404, \'method not exists:\' . get_class($instance) . \'->\' . $action . \'()\');\", \"line\": 106}, {\"code\": \"                }\", \"line\": 107}, {\"code\": \"\", \"line\": 108}, {\"code\": \"                $data = $this->app->invokeReflectMethod($instance, $reflect, $vars);\", \"line\": 109}, {\"code\": \"\", \"line\": 110}, {\"code\": \"                return $this->autoResponse($data);\", \"line\": 111}, {\"code\": \"            });\", \"line\": 112}, {\"code\": \"    }\", \"line\": 113}, {\"code\": \"\", \"line\": 114}, {\"code\": \"    /**\", \"line\": 115}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/route/dispatch/Controller.php\", \"line\": 109, \"type\": \"->\", \"class\": \"think\\\\Container\", \"function\": \"invokeReflectMethod\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            $this->carry(),\", \"line\": 56}, {\"code\": \"            function ($passable) use ($destination) {\", \"line\": 57}, {\"code\": \"                try {\", \"line\": 58}, {\"code\": \"                    return $destination($passable);\", \"line\": 59}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 60}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 61}, {\"code\": \"                }\", \"line\": 62}, {\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\route\\\\dispatch\\\\Controller\", \"function\": \"think\\\\route\\\\dispatch\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        return $pipeline($this->passable);\", \"line\": 66}, {\"code\": \"    }\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"    /**\", \"line\": 69}, {\"code\": \"     * 设置异常处理器\", \"line\": 70}, {\"code\": \"     * @param callable $handler\", \"line\": 71}, {\"code\": \"     * @return $this\", \"line\": 72}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 66, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"Closure\"], \"code\": [{\"code\": \"                $data = $this->app->invokeReflectMethod($instance, $reflect, $vars);\", \"line\": 109}, {\"code\": \"\", \"line\": 110}, {\"code\": \"                return $this->autoResponse($data);\", \"line\": 111}, {\"code\": \"            });\", \"line\": 112}, {\"code\": \"    }\", \"line\": 113}, {\"code\": \"\", \"line\": 114}, {\"code\": \"    /**\", \"line\": 115}, {\"code\": \"     * 使用反射机制注册控制器中间件\", \"line\": 116}, {\"code\": \"     * @access public\", \"line\": 117}, {\"code\": \"     * @param object $controller 控制器实例\", \"line\": 118}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/route/dispatch/Controller.php\", \"line\": 112, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"then\"}, {\"args\": [], \"code\": [{\"code\": \"            return Response::create(\'\', \'html\', 204)->header([\'Allow\' => implode(\', \', $allow)]);\", \"line\": 86}, {\"code\": \"        }\", \"line\": 87}, {\"code\": \"\", \"line\": 88}, {\"code\": \"        $data = $this->exec();\", \"line\": 89}, {\"code\": \"        return $this->autoResponse($data);\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}, {\"code\": \"\", \"line\": 92}, {\"code\": \"    protected function autoResponse($data): Response\", \"line\": 93}, {\"code\": \"    {\", \"line\": 94}, {\"code\": \"        if ($data instanceof Response) {\", \"line\": 95}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/route/Dispatch.php\", \"line\": 89, \"type\": \"->\", \"class\": \"think\\\\route\\\\dispatch\\\\Controller\", \"function\": \"exec\"}, {\"args\": [], \"code\": [{\"code\": \"        return $this->app->middleware->pipeline(\'route\')\", \"line\": 769}, {\"code\": \"            ->send($request)\", \"line\": 770}, {\"code\": \"            ->then(function () use ($dispatch) {\", \"line\": 771}, {\"code\": \"                return $dispatch->run();\", \"line\": 772}, {\"code\": \"            });\", \"line\": 773}, {\"code\": \"    }\", \"line\": 774}, {\"code\": \"\", \"line\": 775}, {\"code\": \"    /**\", \"line\": 776}, {\"code\": \"     * 检测URL路由\", \"line\": 777}, {\"code\": \"     * @access public\", \"line\": 778}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Route.php\", \"line\": 772, \"type\": \"->\", \"class\": \"think\\\\route\\\\Dispatch\", \"function\": \"run\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            $this->carry(),\", \"line\": 56}, {\"code\": \"            function ($passable) use ($destination) {\", \"line\": 57}, {\"code\": \"                try {\", \"line\": 58}, {\"code\": \"                    return $destination($passable);\", \"line\": 59}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 60}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 61}, {\"code\": \"                }\", \"line\": 62}, {\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\Route\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"                if ($request->isOptions()) {\", \"line\": 108}, {\"code\": \"                    return response()->code(204)->header($header);\", \"line\": 109}, {\"code\": \"                } elseif (AdminService::instance()->check()) {\", \"line\": 110}, {\"code\": \"                    return $next($request)->header($header);\", \"line\": 111}, {\"code\": \"                } elseif (AdminService::instance()->isLogin()) {\", \"line\": 112}, {\"code\": \"                    return json([\'code\' => 0, \'info\' => lang(\'think_library_not_auth\')])->header($header);\", \"line\": 113}, {\"code\": \"                } else {\", \"line\": 114}, {\"code\": \"                    return json([\'code\' => 0, \'info\' => lang(\'think_library_not_login\'), \'url\' => sysuri(\'admin/login/index\')])->header($header);\", \"line\": 115}, {\"code\": \"                }\", \"line\": 116}, {\"code\": \"            }, \'route\');\", \"line\": 117}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/zoujingli/think-library/src/Library.php\", \"line\": 111, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [], \"file\": \"[internal]\", \"line\": \"0\", \"type\": \"->\", \"class\": \"think\\\\admin\\\\Library\", \"function\": \"think\\\\admin\\\\{closure}\"}, {\"args\": [\"Closure\", \"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"                    if (is_array($call) && is_string($call[0])) {\", \"line\": 139}, {\"code\": \"                        $call = [$this->app->make($call[0]), $call[1]];\", \"line\": 140}, {\"code\": \"                    }\", \"line\": 141}, {\"code\": \"                    $response = call_user_func($call, $request, $next, ...$params);\", \"line\": 142}, {\"code\": \"\", \"line\": 143}, {\"code\": \"                    if (!$response instanceof Response) {\", \"line\": 144}, {\"code\": \"                        throw new LogicException(\'The middleware must return Response instance\');\", \"line\": 145}, {\"code\": \"                    }\", \"line\": 146}, {\"code\": \"                    return $response;\", \"line\": 147}, {\"code\": \"                };\", \"line\": 148}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Middleware.php\", \"line\": 142, \"type\": \"function\", \"class\": null, \"function\": \"call_user_func\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"        return function ($stack, $pipe) {\", \"line\": 82}, {\"code\": \"            return function ($passable) use ($stack, $pipe) {\", \"line\": 83}, {\"code\": \"                try {\", \"line\": 84}, {\"code\": \"                    return $pipe($passable, $stack);\", \"line\": 85}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 86}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 87}, {\"code\": \"                }\", \"line\": 88}, {\"code\": \"            };\", \"line\": 89}, {\"code\": \"        };\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 85, \"type\": \"->\", \"class\": \"think\\\\Middleware\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        return $pipeline($this->passable);\", \"line\": 66}, {\"code\": \"    }\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"    /**\", \"line\": 69}, {\"code\": \"     * 设置异常处理器\", \"line\": 70}, {\"code\": \"     * @param callable $handler\", \"line\": 71}, {\"code\": \"     * @return $this\", \"line\": 72}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 66, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"Closure\"], \"code\": [{\"code\": \"            ->send($request)\", \"line\": 770}, {\"code\": \"            ->then(function () use ($dispatch) {\", \"line\": 771}, {\"code\": \"                return $dispatch->run();\", \"line\": 772}, {\"code\": \"            });\", \"line\": 773}, {\"code\": \"    }\", \"line\": 774}, {\"code\": \"\", \"line\": 775}, {\"code\": \"    /**\", \"line\": 776}, {\"code\": \"     * 检测URL路由\", \"line\": 777}, {\"code\": \"     * @access public\", \"line\": 778}, {\"code\": \"     * @return Dispatch|false\", \"line\": 779}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Route.php\", \"line\": 773, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"then\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"            $this->loadRoutes();\", \"line\": 213}, {\"code\": \"        } : null;\", \"line\": 214}, {\"code\": \"\", \"line\": 215}, {\"code\": \"        return $this->app->route->dispatch($request, $withRoute);\", \"line\": 216}, {\"code\": \"    }\", \"line\": 217}, {\"code\": \"\", \"line\": 218}, {\"code\": \"    /**\", \"line\": 219}, {\"code\": \"     * 加载全局中间件\", \"line\": 220}, {\"code\": \"     */\", \"line\": 221}, {\"code\": \"    protected function loadMiddleware(): void\", \"line\": 222}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Http.php\", \"line\": 216, \"type\": \"->\", \"class\": \"think\\\\Route\", \"function\": \"dispatch\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"        return $this->app->middleware->pipeline()\", \"line\": 203}, {\"code\": \"            ->send($request)\", \"line\": 204}, {\"code\": \"            ->then(function ($request) {\", \"line\": 205}, {\"code\": \"                return $this->dispatchToRoute($request);\", \"line\": 206}, {\"code\": \"            });\", \"line\": 207}, {\"code\": \"    }\", \"line\": 208}, {\"code\": \"\", \"line\": 209}, {\"code\": \"    protected function dispatchToRoute($request)\", \"line\": 210}, {\"code\": \"    {\", \"line\": 211}, {\"code\": \"        $withRoute = $this->app->config->get(\'app.with_route\', true) ? function () {\", \"line\": 212}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Http.php\", \"line\": 206, \"type\": \"->\", \"class\": \"think\\\\Http\", \"function\": \"dispatchToRoute\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            $this->carry(),\", \"line\": 56}, {\"code\": \"            function ($passable) use ($destination) {\", \"line\": 57}, {\"code\": \"                try {\", \"line\": 58}, {\"code\": \"                    return $destination($passable);\", \"line\": 59}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 60}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 61}, {\"code\": \"                }\", \"line\": 62}, {\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\Http\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"    {\", \"line\": 68}, {\"code\": \"        if (!$this->parseMultiApp()) return $next($request);\", \"line\": 69}, {\"code\": \"        return $this->app->middleware->pipeline(\'app\')->send($request)->then(function ($request) use ($next) {\", \"line\": 70}, {\"code\": \"            return $next($request);\", \"line\": 71}, {\"code\": \"        });\", \"line\": 72}, {\"code\": \"    }\", \"line\": 73}, {\"code\": \"\", \"line\": 74}, {\"code\": \"    /**\", \"line\": 75}, {\"code\": \"     * 解析多应用\", \"line\": 76}, {\"code\": \"     * @return bool\", \"line\": 77}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/zoujingli/think-library/src/multiple/Multiple.php\", \"line\": 71, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            $this->carry(),\", \"line\": 56}, {\"code\": \"            function ($passable) use ($destination) {\", \"line\": 57}, {\"code\": \"                try {\", \"line\": 58}, {\"code\": \"                    return $destination($passable);\", \"line\": 59}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 60}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 61}, {\"code\": \"                }\", \"line\": 62}, {\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\admin\\\\multiple\\\\Multiple\", \"function\": \"think\\\\admin\\\\multiple\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        return $pipeline($this->passable);\", \"line\": 66}, {\"code\": \"    }\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"    /**\", \"line\": 69}, {\"code\": \"     * 设置异常处理器\", \"line\": 70}, {\"code\": \"     * @param callable $handler\", \"line\": 71}, {\"code\": \"     * @return $this\", \"line\": 72}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 66, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"Closure\"], \"code\": [{\"code\": \"        if (!$this->parseMultiApp()) return $next($request);\", \"line\": 69}, {\"code\": \"        return $this->app->middleware->pipeline(\'app\')->send($request)->then(function ($request) use ($next) {\", \"line\": 70}, {\"code\": \"            return $next($request);\", \"line\": 71}, {\"code\": \"        });\", \"line\": 72}, {\"code\": \"    }\", \"line\": 73}, {\"code\": \"\", \"line\": 74}, {\"code\": \"    /**\", \"line\": 75}, {\"code\": \"     * 解析多应用\", \"line\": 76}, {\"code\": \"     * @return bool\", \"line\": 77}, {\"code\": \"     */\", \"line\": 78}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/zoujingli/think-library/src/multiple/Multiple.php\", \"line\": 72, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"then\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [], \"file\": \"[internal]\", \"line\": \"0\", \"type\": \"->\", \"class\": \"think\\\\admin\\\\multiple\\\\Multiple\", \"function\": \"handle\"}, {\"args\": [\"array(2)\", \"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"                    if (is_array($call) && is_string($call[0])) {\", \"line\": 139}, {\"code\": \"                        $call = [$this->app->make($call[0]), $call[1]];\", \"line\": 140}, {\"code\": \"                    }\", \"line\": 141}, {\"code\": \"                    $response = call_user_func($call, $request, $next, ...$params);\", \"line\": 142}, {\"code\": \"\", \"line\": 143}, {\"code\": \"                    if (!$response instanceof Response) {\", \"line\": 144}, {\"code\": \"                        throw new LogicException(\'The middleware must return Response instance\');\", \"line\": 145}, {\"code\": \"                    }\", \"line\": 146}, {\"code\": \"                    return $response;\", \"line\": 147}, {\"code\": \"                };\", \"line\": 148}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Middleware.php\", \"line\": 142, \"type\": \"function\", \"class\": null, \"function\": \"call_user_func\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"        return function ($stack, $pipe) {\", \"line\": 82}, {\"code\": \"            return function ($passable) use ($stack, $pipe) {\", \"line\": 83}, {\"code\": \"                try {\", \"line\": 84}, {\"code\": \"                    return $pipe($passable, $stack);\", \"line\": 85}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 86}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 87}, {\"code\": \"                }\", \"line\": 88}, {\"code\": \"            };\", \"line\": 89}, {\"code\": \"        };\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 85, \"type\": \"->\", \"class\": \"think\\\\Middleware\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"        return $this->app->middleware->pipeline(\'app\')\", \"line\": 68}, {\"code\": \"            ->send($request)\", \"line\": 69}, {\"code\": \"            ->then(function ($request) use ($next) {\", \"line\": 70}, {\"code\": \"                return $next($request);\", \"line\": 71}, {\"code\": \"            });\", \"line\": 72}, {\"code\": \"    }\", \"line\": 73}, {\"code\": \"\", \"line\": 74}, {\"code\": \"    /**\", \"line\": 75}, {\"code\": \"     * 获取路由目录\", \"line\": 76}, {\"code\": \"     * @access protected\", \"line\": 77}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/think-multi-app/src/MultiApp.php\", \"line\": 71, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            $this->carry(),\", \"line\": 56}, {\"code\": \"            function ($passable) use ($destination) {\", \"line\": 57}, {\"code\": \"                try {\", \"line\": 58}, {\"code\": \"                    return $destination($passable);\", \"line\": 59}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 60}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 61}, {\"code\": \"                }\", \"line\": 62}, {\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\app\\\\MultiApp\", \"function\": \"think\\\\app\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        return $pipeline($this->passable);\", \"line\": 66}, {\"code\": \"    }\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"    /**\", \"line\": 69}, {\"code\": \"     * 设置异常处理器\", \"line\": 70}, {\"code\": \"     * @param callable $handler\", \"line\": 71}, {\"code\": \"     * @return $this\", \"line\": 72}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 66, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"Closure\"], \"code\": [{\"code\": \"            ->send($request)\", \"line\": 69}, {\"code\": \"            ->then(function ($request) use ($next) {\", \"line\": 70}, {\"code\": \"                return $next($request);\", \"line\": 71}, {\"code\": \"            });\", \"line\": 72}, {\"code\": \"    }\", \"line\": 73}, {\"code\": \"\", \"line\": 74}, {\"code\": \"    /**\", \"line\": 75}, {\"code\": \"     * 获取路由目录\", \"line\": 76}, {\"code\": \"     * @access protected\", \"line\": 77}, {\"code\": \"     * @return string\", \"line\": 78}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/think-multi-app/src/MultiApp.php\", \"line\": 72, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"then\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [], \"file\": \"[internal]\", \"line\": \"0\", \"type\": \"->\", \"class\": \"think\\\\app\\\\MultiApp\", \"function\": \"handle\"}, {\"args\": [\"array(2)\", \"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"                    if (is_array($call) && is_string($call[0])) {\", \"line\": 139}, {\"code\": \"                        $call = [$this->app->make($call[0]), $call[1]];\", \"line\": 140}, {\"code\": \"                    }\", \"line\": 141}, {\"code\": \"                    $response = call_user_func($call, $request, $next, ...$params);\", \"line\": 142}, {\"code\": \"\", \"line\": 143}, {\"code\": \"                    if (!$response instanceof Response) {\", \"line\": 144}, {\"code\": \"                        throw new LogicException(\'The middleware must return Response instance\');\", \"line\": 145}, {\"code\": \"                    }\", \"line\": 146}, {\"code\": \"                    return $response;\", \"line\": 147}, {\"code\": \"                };\", \"line\": 148}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Middleware.php\", \"line\": 142, \"type\": \"function\", \"class\": null, \"function\": \"call_user_func\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"        return function ($stack, $pipe) {\", \"line\": 82}, {\"code\": \"            return function ($passable) use ($stack, $pipe) {\", \"line\": 83}, {\"code\": \"                try {\", \"line\": 84}, {\"code\": \"                    return $pipe($passable, $stack);\", \"line\": 85}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 86}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 87}, {\"code\": \"                }\", \"line\": 88}, {\"code\": \"            };\", \"line\": 89}, {\"code\": \"        };\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 85, \"type\": \"->\", \"class\": \"think\\\\Middleware\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"\", \"line\": 56}, {\"code\": \"        $this->lang->saveToCookie($this->app->cookie);\", \"line\": 57}, {\"code\": \"\", \"line\": 58}, {\"code\": \"        return $next($request);\", \"line\": 59}, {\"code\": \"    }\", \"line\": 60}, {\"code\": \"}\", \"line\": 61}, {\"code\": \"\", \"line\": 62}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/middleware/LoadLangPack.php\", \"line\": 59, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [], \"file\": \"[internal]\", \"line\": \"0\", \"type\": \"->\", \"class\": \"think\\\\middleware\\\\LoadLangPack\", \"function\": \"handle\"}, {\"args\": [\"array(2)\", \"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"                    if (is_array($call) && is_string($call[0])) {\", \"line\": 139}, {\"code\": \"                        $call = [$this->app->make($call[0]), $call[1]];\", \"line\": 140}, {\"code\": \"                    }\", \"line\": 141}, {\"code\": \"                    $response = call_user_func($call, $request, $next, ...$params);\", \"line\": 142}, {\"code\": \"\", \"line\": 143}, {\"code\": \"                    if (!$response instanceof Response) {\", \"line\": 144}, {\"code\": \"                        throw new LogicException(\'The middleware must return Response instance\');\", \"line\": 145}, {\"code\": \"                    }\", \"line\": 146}, {\"code\": \"                    return $response;\", \"line\": 147}, {\"code\": \"                };\", \"line\": 148}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Middleware.php\", \"line\": 142, \"type\": \"function\", \"class\": null, \"function\": \"call_user_func\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"        return function ($stack, $pipe) {\", \"line\": 82}, {\"code\": \"            return function ($passable) use ($stack, $pipe) {\", \"line\": 83}, {\"code\": \"                try {\", \"line\": 84}, {\"code\": \"                    return $pipe($passable, $stack);\", \"line\": 85}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 86}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 87}, {\"code\": \"                }\", \"line\": 88}, {\"code\": \"            };\", \"line\": 89}, {\"code\": \"        };\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 85, \"type\": \"->\", \"class\": \"think\\\\Middleware\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"        $request->withSession($this->session);\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        /** @var Response $response */\", \"line\": 66}, {\"code\": \"        $response = $next($request);\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"        $response->setSession($this->session);\", \"line\": 69}, {\"code\": \"\", \"line\": 70}, {\"code\": \"        $this->app->cookie->set($cookieName, $this->session->getId());\", \"line\": 71}, {\"code\": \"\", \"line\": 72}, {\"code\": \"        return $response;\", \"line\": 73}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/middleware/SessionInit.php\", \"line\": 67, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [], \"file\": \"[internal]\", \"line\": \"0\", \"type\": \"->\", \"class\": \"think\\\\middleware\\\\SessionInit\", \"function\": \"handle\"}, {\"args\": [\"array(2)\", \"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"                    if (is_array($call) && is_string($call[0])) {\", \"line\": 139}, {\"code\": \"                        $call = [$this->app->make($call[0]), $call[1]];\", \"line\": 140}, {\"code\": \"                    }\", \"line\": 141}, {\"code\": \"                    $response = call_user_func($call, $request, $next, ...$params);\", \"line\": 142}, {\"code\": \"\", \"line\": 143}, {\"code\": \"                    if (!$response instanceof Response) {\", \"line\": 144}, {\"code\": \"                        throw new LogicException(\'The middleware must return Response instance\');\", \"line\": 145}, {\"code\": \"                    }\", \"line\": 146}, {\"code\": \"                    return $response;\", \"line\": 147}, {\"code\": \"                };\", \"line\": 148}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Middleware.php\", \"line\": 142, \"type\": \"function\", \"class\": null, \"function\": \"call_user_func\"}, {\"args\": [\"app\\\\Request\", \"Closure\"], \"code\": [{\"code\": \"        return function ($stack, $pipe) {\", \"line\": 82}, {\"code\": \"            return function ($passable) use ($stack, $pipe) {\", \"line\": 83}, {\"code\": \"                try {\", \"line\": 84}, {\"code\": \"                    return $pipe($passable, $stack);\", \"line\": 85}, {\"code\": \"                } catch (Throwable | Exception $e) {\", \"line\": 86}, {\"code\": \"                    return $this->handleException($passable, $e);\", \"line\": 87}, {\"code\": \"                }\", \"line\": 88}, {\"code\": \"            };\", \"line\": 89}, {\"code\": \"        };\", \"line\": 90}, {\"code\": \"    }\", \"line\": 91}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 85, \"type\": \"->\", \"class\": \"think\\\\Middleware\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"            }\", \"line\": 63}, {\"code\": \"        );\", \"line\": 64}, {\"code\": \"\", \"line\": 65}, {\"code\": \"        return $pipeline($this->passable);\", \"line\": 66}, {\"code\": \"    }\", \"line\": 67}, {\"code\": \"\", \"line\": 68}, {\"code\": \"    /**\", \"line\": 69}, {\"code\": \"     * 设置异常处理器\", \"line\": 70}, {\"code\": \"     * @param callable $handler\", \"line\": 71}, {\"code\": \"     * @return $this\", \"line\": 72}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Pipeline.php\", \"line\": 66, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"think\\\\{closure}\"}, {\"args\": [\"Closure\"], \"code\": [{\"code\": \"            ->send($request)\", \"line\": 204}, {\"code\": \"            ->then(function ($request) {\", \"line\": 205}, {\"code\": \"                return $this->dispatchToRoute($request);\", \"line\": 206}, {\"code\": \"            });\", \"line\": 207}, {\"code\": \"    }\", \"line\": 208}, {\"code\": \"\", \"line\": 209}, {\"code\": \"    protected function dispatchToRoute($request)\", \"line\": 210}, {\"code\": \"    {\", \"line\": 211}, {\"code\": \"        $withRoute = $this->app->config->get(\'app.with_route\', true) ? function () {\", \"line\": 212}, {\"code\": \"            $this->loadRoutes();\", \"line\": 213}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Http.php\", \"line\": 207, \"type\": \"->\", \"class\": \"think\\\\Pipeline\", \"function\": \"then\"}, {\"args\": [\"app\\\\Request\"], \"code\": [{\"code\": \"        $this->app->instance(\'request\', $request);\", \"line\": 167}, {\"code\": \"\", \"line\": 168}, {\"code\": \"        try {\", \"line\": 169}, {\"code\": \"            $response = $this->runWithRequest($request);\", \"line\": 170}, {\"code\": \"        } catch (Throwable $e) {\", \"line\": 171}, {\"code\": \"            $this->reportException($e);\", \"line\": 172}, {\"code\": \"\", \"line\": 173}, {\"code\": \"            $response = $this->renderException($request, $e);\", \"line\": 174}, {\"code\": \"        }\", \"line\": 175}, {\"code\": \"\", \"line\": 176}], \"file\": \"/Users/imacbook/git/oneblog2/vendor/topthink/framework/src/think/Http.php\", \"line\": 170, \"type\": \"->\", \"class\": \"think\\\\Http\", \"function\": \"runWithRequest\"}, {\"args\": [], \"code\": [{\"code\": \"\\t$http = (new App())->http;\", \"line\": 34}, {\"code\": \"}\", \"line\": 35}, {\"code\": \"\", \"line\": 36}, {\"code\": \"$response = $http->run();\", \"line\": 37}, {\"code\": \"\", \"line\": 38}, {\"code\": \"$response->send();\", \"line\": 39}, {\"code\": \"\", \"line\": 40}, {\"code\": \"$http->end($response);\", \"line\": 41}, {\"code\": \"\", \"line\": 42}], \"file\": \"/Users/imacbook/git/oneblog2/public/index.php\", \"line\": 37, \"type\": \"->\", \"class\": \"think\\\\Http\", \"function\": \"run\"}]', '5bea2de647e3caeccef3c3d7d04b9750');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (20200225024630, 'CreateSystemConfig', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200225024831, 'CreateSystemAuth', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200225025017, 'CreateSystemAuthNode', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200409151337, 'CreateSystemUser', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200410131333, 'CreateSystemMenu', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200425094301, 'CreateSystemUserAuth', '2022-01-31 17:24:49', '2022-01-31 17:24:49', 0);
INSERT INTO `migrations` VALUES (20200710083138, 'CreateSystemNotice', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20210124040330, 'CreateSystemAuthMenu', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20210605065602, 'CreateSystemQueue', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20210911075425, 'CreateSystemFileCate', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20210911082749, 'CreateSystemFile', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20211027070518, 'CreateSystemAuthData', '2022-01-31 17:24:50', '2022-01-31 17:24:50', 0);
INSERT INTO `migrations` VALUES (20211122095726, 'CreateSystemJobsTable', '2022-01-31 17:24:50', '2022-01-31 17:24:51', 0);
INSERT INTO `migrations` VALUES (20211216135833, 'CreateSystemFieldAuth', '2022-01-31 17:24:51', '2022-01-31 17:24:51', 0);
COMMIT;

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `platform` varchar(255) DEFAULT NULL COMMENT '使用的平台',
  `is_active` tinyint(3) unsigned DEFAULT '1' COMMENT '是否启用',
  `weekly_report` tinyint(1) DEFAULT '0' COMMENT '是否需要周报',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `last_usage_day` datetime DEFAULT NULL,
  `key` varchar(64) NOT NULL COMMENT '项目的key',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `key` (`key`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of project
-- ----------------------------
BEGIN;
INSERT INTO `project` VALUES (1, 'oneblog', '', 1, 0, 1, '2022-01-20 13:34:49', '2022-02-01 18:56:23', NULL, '2J');
COMMIT;

-- ----------------------------
-- Table structure for segement
-- ----------------------------
DROP TABLE IF EXISTS `segement`;
CREATE TABLE `segement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) NOT NULL,
  `group_hash` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL DEFAULT '' COMMENT '类型',
  `project_id` int(10) unsigned NOT NULL,
  `host` json DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `duration` float(10,2) NOT NULL,
  `label` varchar(2048) DEFAULT NULL,
  `start` float(10,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `group_hash` (`group_hash`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='片段';

-- ----------------------------
-- Records of segement
-- ----------------------------
BEGIN;
INSERT INTO `segement` VALUES (1, '2J', '2J', 'app', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:55', 642.31, '应用开始 blog.cn/ [运行时间：0.199062s][吞吐率：5.02req/s] [内存消耗：1,042.05kb] [文件加载：108]', 2.43);
INSERT INTO `segement` VALUES (2, 'Kv', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.79, 'SHOW FULL COLUMNS FROM `onethink_admin_config` ', 92.51);
INSERT INTO `segement` VALUES (3, 'Vw', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.75, 'SELECT `value`,`type`,`name` FROM `onethink_admin_config` ', 118.19);
INSERT INTO `segement` VALUES (4, 'oy', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 25.15, 'SHOW FULL COLUMNS FROM `onethink_admin_module` ', 145.24);
INSERT INTO `segement` VALUES (5, 'D8', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.02, 'SELECT `config`,`name` FROM `onethink_admin_module` WHERE  `config` <> \'\' ', 171.26);
INSERT INTO `segement` VALUES (6, 'LW', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.59, 'SHOW FULL COLUMNS FROM `onethink_admin_hook` ', 197.76);
INSERT INTO `segement` VALUES (7, 'lx', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 23.15, 'SELECT `status`,`name` FROM `onethink_admin_hook` WHERE  `status` = 1 ', 223.30);
INSERT INTO `segement` VALUES (8, 'A9', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 25.27, 'SHOW FULL COLUMNS FROM `onethink_admin_plugin` ', 248.38);
INSERT INTO `segement` VALUES (9, 'de', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 23.69, 'SELECT `status`,`name` FROM `onethink_admin_plugin` WHERE  `status` = 1 ', 274.73);
INSERT INTO `segement` VALUES (10, '9K', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 28.39, 'SHOW FULL COLUMNS FROM `onethink_admin_hook_plugin` ', 300.00);
INSERT INTO `segement` VALUES (11, 'vq', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 26.55, 'SELECT * FROM `onethink_admin_hook_plugin` WHERE  `status` = 1 ORDER BY `hook`,`sort` ', 329.37);
INSERT INTO `segement` VALUES (12, 'qm', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 26.13, 'SHOW FULL COLUMNS FROM `onethink_cms_page` ', 375.83);
INSERT INTO `segement` VALUES (13, 'Nz', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.41, 'SELECT * FROM `onethink_cms_page` WHERE  `status` = 1 ORDER BY `update_time` DESC ', 402.80);
INSERT INTO `segement` VALUES (14, '3B', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.89, 'SHOW FULL COLUMNS FROM `onethink_cms_document` ', 429.56);
INSERT INTO `segement` VALUES (15, 'Gj', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 26.11, 'SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` WHERE  `cms_document`.`status` = \'1\' ORDER BY `update_time` DESC LIMIT 3 ', 455.42);
INSERT INTO `segement` VALUES (16, 'y5', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 25.71, 'SHOW FULL COLUMNS FROM `onethink_cms_column` ', 483.82);
INSERT INTO `segement` VALUES (17, 'x6', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 23.77, 'SELECT * FROM `onethink_cms_column` WHERE  ( status = 1 ) ORDER BY `sort` ASC ', 510.43);
INSERT INTO `segement` VALUES (18, 'nv', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 24.78, 'SELECT `cid`,count(*) as num FROM `onethink_cms_document` WHERE  ( status=1 ) GROUP BY `cid` ', 535.82);
INSERT INTO `segement` VALUES (19, 'XE', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 23.91, 'SELECT COUNT(*) AS think_count FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` ', 566.01);
INSERT INTO `segement` VALUES (20, 'zd', '2J', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 28.18, 'SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` ORDER BY `create_time` DESC,`id` DESC LIMIT 0,15 ', 592.58);
INSERT INTO `segement` VALUES (21, 'Qb', '2J', 'exception', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:56', 5.97, '123', 634.75);
INSERT INTO `segement` VALUES (22, 'ej', 'Kv', 'app', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 1744.98, '应用开始 blog.cn/ [运行时间：0.030931s][吞吐率：32.33req/s] [内存消耗：1,042.05kb] [文件加载：108]', 1.24);
INSERT INTO `segement` VALUES (23, '5j', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 26.56, 'SHOW FULL COLUMNS FROM `onethink_admin_config` ', 92.08);
INSERT INTO `segement` VALUES (24, 'O9', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.45, 'SELECT `value`,`type`,`name` FROM `onethink_admin_config` ', 119.77);
INSERT INTO `segement` VALUES (25, '0v', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 26.76, 'SHOW FULL COLUMNS FROM `onethink_admin_module` ', 147.18);
INSERT INTO `segement` VALUES (26, 'Ym', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 34.35, 'SELECT `config`,`name` FROM `onethink_admin_module` WHERE  `config` <> \'\' ', 174.95);
INSERT INTO `segement` VALUES (27, '6B', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.34, 'SHOW FULL COLUMNS FROM `onethink_admin_hook` ', 211.64);
INSERT INTO `segement` VALUES (28, 'gV', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.75, 'SELECT `status`,`name` FROM `onethink_admin_hook` WHERE  `status` = 1 ', 237.97);
INSERT INTO `segement` VALUES (29, 'JO', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 26.28, 'SHOW FULL COLUMNS FROM `onethink_admin_plugin` ', 265.97);
INSERT INTO `segement` VALUES (30, 'E4', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.60, 'SELECT `status`,`name` FROM `onethink_admin_plugin` WHERE  `status` = 1 ', 293.20);
INSERT INTO `segement` VALUES (31, '17', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.56, 'SHOW FULL COLUMNS FROM `onethink_admin_hook_plugin` ', 320.03);
INSERT INTO `segement` VALUES (32, '4W', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.37, 'SELECT * FROM `onethink_admin_hook_plugin` WHERE  `status` = 1 ORDER BY `hook`,`sort` ', 346.48);
INSERT INTO `segement` VALUES (33, 'j1', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.80, 'SHOW FULL COLUMNS FROM `onethink_cms_page` ', 393.36);
INSERT INTO `segement` VALUES (34, 'Z3', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.30, 'SELECT * FROM `onethink_cms_page` WHERE  `status` = 1 ORDER BY `update_time` DESC ', 420.19);
INSERT INTO `segement` VALUES (35, 'r0', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.48, 'SHOW FULL COLUMNS FROM `onethink_cms_document` ', 447.30);
INSERT INTO `segement` VALUES (36, 'wV', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 39.54, 'SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` WHERE  `cms_document`.`status` = \'1\' ORDER BY `update_time` DESC LIMIT 3 ', 472.82);
INSERT INTO `segement` VALUES (37, 'Wg', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.40, 'SHOW FULL COLUMNS FROM `onethink_cms_column` ', 515.24);
INSERT INTO `segement` VALUES (38, '7d', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.28, 'SELECT * FROM `onethink_cms_column` WHERE  ( status = 1 ) ORDER BY `sort` ASC ', 541.88);
INSERT INTO `segement` VALUES (39, '8G', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 25.57, 'SELECT `cid`,count(*) as num FROM `onethink_cms_document` WHERE  ( status=1 ) GROUP BY `cid` ', 567.90);
INSERT INTO `segement` VALUES (40, 'b1', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', 24.50, 'SELECT COUNT(*) AS think_count FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` ', 595.81);
INSERT INTO `segement` VALUES (41, 'MP', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:46', 27.78, 'SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` ORDER BY `create_time` DESC,`id` DESC LIMIT 0,15 ', 621.40);
INSERT INTO `segement` VALUES (42, 'B2', 'Kv', 'type', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:46', 1004.52, 'label', 660.47);
INSERT INTO `segement` VALUES (43, 'mV', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:47', 24.07, 'SELECT COUNT(*) AS think_count FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` WHERE  `cms_document`.`trash` = \'0\' ', 1665.81);
INSERT INTO `segement` VALUES (44, 'PwO', 'Kv', 'mysql', 1, '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:47', 30.95, 'SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` WHERE  `cms_document`.`trash` = \'0\' ORDER BY `update_time` DESC LIMIT 0,15 ', 1690.80);
COMMIT;

-- ----------------------------
-- Table structure for system_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人id',
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限角色名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '权限角色状态',
  `sort` bigint(20) NOT NULL DEFAULT '0' COMMENT '排序',
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注说明',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-权限';

-- ----------------------------
-- Records of system_auth
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_auth_data
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_data`;
CREATE TABLE `system_auth_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '权限类型：1组织(system_auth)，2个人(system_user)',
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限用户：组织/个人 id',
  `data_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据范围类型：1组织(system_auth)，2个人(system_user)',
  `data_id` int(11) NOT NULL DEFAULT '1' COMMENT '数据范围：组织/个人 id',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-数据-权限';

-- ----------------------------
-- Records of system_auth_data
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_auth_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_menu`;
CREATE TABLE `system_auth_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单id',
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-菜单-授权';

-- ----------------------------
-- Records of system_auth_menu
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '节点id',
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色',
  `class` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类名',
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '方法',
  `method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求方法',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-权限-授权';

-- ----------------------------
-- Records of system_auth_node
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '配置字段',
  `value` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '配置值',
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标记',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
BEGIN;
INSERT INTO `system_config` VALUES (1, 'system_web_name', 'Ex-admin', '');
INSERT INTO `system_config` VALUES (2, 'system_web_logo', 'https://www.ex-admin.com/cms/logo.png', '');
INSERT INTO `system_config` VALUES (3, 'system_web_miitbeian', '粤ICP备16006642号-2', '');
INSERT INTO `system_config` VALUES (4, 'system_web_copyright', '©版权所有 2014-2020', '');
INSERT INTO `system_config` VALUES (5, 'databackup_on', '1', '');
INSERT INTO `system_config` VALUES (6, 'database_number', '10', '');
INSERT INTO `system_config` VALUES (7, 'database_day', '1', '');
COMMIT;

-- ----------------------------
-- Table structure for system_field_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_field_auth`;
CREATE TABLE `system_field_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类名方法',
  `field` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段',
  `key` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标示',
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-字段-授权';

-- ----------------------------
-- Records of system_field_auth
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_file
-- ----------------------------
DROP TABLE IF EXISTS `system_file`;
CREATE TABLE `system_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名称',
  `real_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '原始文件名',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '访问url',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径',
  `file_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件类型',
  `ext` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文件后缀',
  `file_size` bigint(20) NOT NULL COMMENT '文件大小',
  `admin_id` int(11) DEFAULT NULL COMMENT '后台上传人员',
  `uptype` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local' COMMENT '上传类型',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1已删除，0正常',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `file_type` (`file_type`,`ext`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='上传文件';

-- ----------------------------
-- Records of system_file
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_file_cate
-- ----------------------------
DROP TABLE IF EXISTS `system_file_cate`;
CREATE TABLE `system_file_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标记',
  `per_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '权限类型：0所有人，1仅自己',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `admin_id` int(11) NOT NULL COMMENT '后台上传人员',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='上传文件分类';

-- ----------------------------
-- Records of system_file_cate
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_jobs
-- ----------------------------
DROP TABLE IF EXISTS `system_jobs`;
CREATE TABLE `system_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserve_time` int(10) unsigned DEFAULT NULL,
  `available_time` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `queue` (`queue`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `url` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接',
  `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标记',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `open` tinyint(4) NOT NULL DEFAULT '1' COMMENT '菜单展开(0:禁用,1:启用)',
  `admin_visible` tinyint(4) NOT NULL DEFAULT '1' COMMENT '超级管理员状态(0:隐藏,1:显示)',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-菜单表';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
BEGIN;
INSERT INTO `system_menu` VALUES (2, 0, 'system_manage', '', '#', '', 1, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (3, 4, 'system_menu_manage', 'el-icon-menu', 'admin/menu', '', 2, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (4, 2, 'system_config', 'el-icon-s-tools', '', '', 7, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (5, 12, 'system_user_manage', 'el-icon-user', 'admin/admin', '', 4, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (7, 12, 'access_auth_manage', 'el-icon-lock', 'admin/auth', '', 6, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (11, 4, 'system_param_config', 'el-icon-setting', 'admin/system/config', '', 3, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (12, 2, 'auth_manage', 'el-icon-user-solid', '', '', 5, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1014, 4, 'backup', 'fa fa-stack-exchange', 'admin/backup', '', 0, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1015, 4, 'attachment', 'el-icon-files', 'filesystem', '', 0, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1084, 0, 'index', '', 'admin/index/dashboard', '', 0, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1158, 2, 'development', 'fa fa-wrench', '', '', 133, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1159, 1158, 'debug_log', 'fa fa-file-o', 'log/debug', '', 133, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1160, 1158, 'system_queue', 'fa fa-tasks', 'queue', '', 134, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1161, 1158, 'time_task', 'el-icon-time', 'crontab', '', 133, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1170, 1158, 'plug_manage', 'fa fa-plug', 'plug', '', 135, 1, 1, 1, '2022-01-31 17:24:52', NULL);
INSERT INTO `system_menu` VALUES (1171, 0, '监控', '', '', '', 2, 1, 1, 1, '2022-02-01 11:17:52', '2022-02-01 18:42:41');
INSERT INTO `system_menu` VALUES (1172, 1171, '项目', '', 'admin/project/index', '', 1, 1, 1, 1, '2022-02-01 11:19:01', '2022-02-01 11:19:01');
INSERT INTO `system_menu` VALUES (1173, 1172, '监控', '', 'admin/monitor', '', 1, 0, 1, 1, '2022-02-01 11:21:44', '2022-02-01 11:21:44');
INSERT INTO `system_menu` VALUES (1174, 1172, '异常', '', 'admin/errors', '', 2, 0, 1, 1, '2022-02-01 11:22:04', '2022-02-01 11:22:04');
COMMIT;

-- ----------------------------
-- Table structure for system_notice
-- ----------------------------
DROP TABLE IF EXISTS `system_notice`;
CREATE TABLE `system_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '系统用户id',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标和标题标签颜色',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '头像或图标',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1图标,2头像',
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `target_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '跳转链接',
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:已读,0未读',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统通知';

-- ----------------------------
-- Records of system_notice
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_queue
-- ----------------------------
DROP TABLE IF EXISTS `system_queue`;
CREATE TABLE `system_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '队列名称',
  `queue_data` text COLLATE utf8mb4_unicode_ci COMMENT '队列数据',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态:1等待处理，2正在执行，3已完成，4已失败',
  `is_queue` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0并发，1排队',
  `task_time` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '耗时毫秒',
  `plan_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计划时间',
  `exec_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '执行时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='队列任务';

-- ----------------------------
-- Records of system_queue
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户账号',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户密码',
  `mail` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系邮箱',
  `phone` char(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系手机',
  `login_at` datetime DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录IP',
  `login_num` bigint(20) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注说明',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  `delete_time` int(11) NOT NULL DEFAULT '0' COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统-用户表';

-- ----------------------------
-- Records of system_user
-- ----------------------------
BEGIN;
INSERT INTO `system_user` VALUES (1, 'admin', 'admin', 'https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png', '$2y$10$qSjrkIRsEpiv6pZKG.CXkOpXii3ozpHkJy7cgFn5JNT2ClMxXGq1K', '', '', '2022-02-23 14:12:31', '127.0.0.1', 15, '', 0, 1, '2022-01-31 17:24:52', '2022-02-23 14:12:31', 0);
COMMIT;

-- ----------------------------
-- Table structure for system_user_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_user_auth`;
CREATE TABLE `system_user_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '系统用户id',
  `auth_id` int(11) NOT NULL COMMENT '权限角色id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统用户授权角色表';

-- ----------------------------
-- Records of system_user_auth
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_hash` varchar(32) NOT NULL COMMENT 'path 加密后的',
  `project_id` int(10) unsigned NOT NULL,
  `memory` float(10,2) DEFAULT NULL COMMENT '内存',
  `p50` float(11,1) DEFAULT NULL COMMENT '耗时平均',
  `last_record` json DEFAULT NULL COMMENT '最后一次记录',
  `name` varchar(255) DEFAULT NULL,
  `type` enum('request','process') DEFAULT 'request',
  `host` json DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `context` json DEFAULT NULL,
  `http` json DEFAULT NULL,
  `hash` varchar(128) DEFAULT NULL,
  `result` varchar(16) DEFAULT '200',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `group_hash` (`group_hash`) USING BTREE,
  KEY `hash` (`hash`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会话表';

-- ----------------------------
-- Records of transaction
-- ----------------------------
BEGIN;
INSERT INTO `transaction` VALUES (1, '2J', 1, 7.29, 688.9, '{\"id\": \"21\", \"hash\": \"Qb\", \"host\": {\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}, \"type\": \"exception\", \"label\": \"123\", \"start\": 634.75, \"duration\": 5.97, \"group_hash\": \"2J\", \"project_id\": 1, \"create_time\": \"2022-01-21 13:43:56\", \"update_time\": \"2022-01-21 13:43:59\"}', 'WEB', 'request', '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:43:55', '2022-01-21 13:43:57', '{\"总结\": \"应用开始 blog.cn/ [运行时间：0.843890s][吞吐率：1.18req/s] [内存消耗：6,046.31kb] [文件加载：229]\", \"请求信息\": {\"GET Data\": [], \"POST Data\": [], \"Server/Request Data\": {\"PATH\": \"/usr/bin:/bin:/usr/sbin:/sbin\", \"PHPRC\": \"/Applications/phpstudy/Extensions/php/php7.4.27\", \"PHP_SELF\": \"/index.php\", \"FCGI_ROLE\": \"RESPONDER\", \"HTTP_HOST\": \"blog.cn\", \"HTTP_ACCEPT\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"HTTP_COOKIE\": \"think_lang=zh-cn; PHPSESSID=04d78a60c9cfe761565175c6e01691e1\", \"REMOTE_ADDR\": \"127.0.0.1\", \"REMOTE_PORT\": \"61865\", \"REQUEST_URI\": \"/\", \"SCRIPT_NAME\": \"/index.php\", \"SERVER_ADDR\": \"127.0.0.1\", \"SERVER_NAME\": \"blog.cn\", \"SERVER_PORT\": \"80\", \"QUERY_STRING\": \"\", \"REQUEST_TIME\": 1642743835, \"SERVER_ADMIN\": \"[no address given]\", \"DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"CONTEXT_PREFIX\": \"\", \"REQUEST_METHOD\": \"GET\", \"REQUEST_SCHEME\": \"http\", \"HTTP_CONNECTION\": \"close\", \"HTTP_USER_AGENT\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.69\", \"SCRIPT_FILENAME\": \"/Users/imacbook/git/oneblog2/public/index.php\", \"SERVER_PROTOCOL\": \"HTTP/1.1\", \"SERVER_SOFTWARE\": \"Apache/2.4.41 (Unix) mod_fcgid/2.3.9\", \"SERVER_SIGNATURE\": \"\", \"GATEWAY_INTERFACE\": \"CGI/1.1\", \"HTTP_CACHE_CONTROL\": \"max-age=0\", \"REQUEST_TIME_FLOAT\": 1642743835.686197, \"HTTP_ACCEPT_ENCODING\": \"gzip, deflate\", \"HTTP_ACCEPT_LANGUAGE\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"CONTEXT_DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"PHP_FCGI_MAX_REQUESTS\": \"1000\", \"__CF_USER_TEXT_ENCODING\": \"0x1F5:0x19:0x34\", \"HTTP_UPGRADE_INSECURE_REQUESTS\": \"1\"}}}', '{\"url\": {\"full\": \"http://blog.cn/\", \"path\": \"/index.php\", \"port\": \"80\", \"search\": \"?\", \"protocol\": \"http\"}, \"request\": {\"method\": \"GET\", \"socket\": {\"remote_address\": \"127.0.0.1\"}, \"cookies\": {\"PHPSESSID\": \"04d78a60c9cfe761565175c6e01691e1\", \"think_lang\": \"zh-cn\"}, \"headers\": {\"Host\": \"blog.cn\", \"Accept\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"Cookie\": \"think_lang=zh-cn; PHPSESSID=04d78a60c9cfe761565175c6e01691e1\", \"Connection\": \"close\", \"User-Agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.69\", \"Cache-Control\": \"max-age=0\", \"Accept-Encoding\": \"gzip, deflate\", \"Accept-Language\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"Upgrade-Insecure-Requests\": \"1\"}, \"version\": \"/1.1\"}}', 'f4daa9dd7aa7455ec4d38db71401a54f06ef9f63e4a5d979d7655c6307aa18b2', '200');
INSERT INTO `transaction` VALUES (2, 'Kv', 1, 7.12, 1793.5, '{\"id\": \"44\", \"hash\": \"PwO\", \"host\": {\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}, \"type\": \"mysql\", \"label\": \"SELECT `cms_document`.*,cms_column.name AS column_name,`admin_user`.`username` FROM `onethink_cms_document` `cms_document` LEFT JOIN `onethink_cms_column` `cms_column` ON `cms_column`.`id`=`cms_document`.`cid` LEFT JOIN `onethink_admin_user` `admin_user` ON `admin_user`.`id`=`cms_document`.`uid` WHERE  `cms_document`.`trash` = \'0\' ORDER BY `update_time` DESC LIMIT 0,15 \", \"start\": 1690.8, \"duration\": 30.946, \"group_hash\": \"Kv\", \"project_id\": 1, \"create_time\": \"2022-01-21 13:45:47\", \"update_time\": \"2022-01-21 13:45:50\"}', 'WEB', 'request', '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-01-21 13:45:45', '2022-01-21 13:45:47', '{\"总结\": \"应用开始 blog.cn/ [运行时间：1.777313s][吞吐率：0.56req/s] [内存消耗：5,849.82kb] [文件加载：230]\", \"请求信息\": {\"GET Data\": [], \"POST Data\": [], \"Server/Request Data\": {\"PATH\": \"/usr/bin:/bin:/usr/sbin:/sbin\", \"PHPRC\": \"/Applications/phpstudy/Extensions/php/php7.4.27\", \"PHP_SELF\": \"/index.php\", \"FCGI_ROLE\": \"RESPONDER\", \"HTTP_HOST\": \"blog.cn\", \"HTTP_ACCEPT\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"HTTP_COOKIE\": \"think_lang=zh-cn; PHPSESSID=04d78a60c9cfe761565175c6e01691e1\", \"REMOTE_ADDR\": \"127.0.0.1\", \"REMOTE_PORT\": \"62596\", \"REQUEST_URI\": \"/\", \"SCRIPT_NAME\": \"/index.php\", \"SERVER_ADDR\": \"127.0.0.1\", \"SERVER_NAME\": \"blog.cn\", \"SERVER_PORT\": \"80\", \"QUERY_STRING\": \"\", \"REQUEST_TIME\": 1642743945, \"SERVER_ADMIN\": \"[no address given]\", \"DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"CONTEXT_PREFIX\": \"\", \"REQUEST_METHOD\": \"GET\", \"REQUEST_SCHEME\": \"http\", \"HTTP_CONNECTION\": \"close\", \"HTTP_USER_AGENT\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.69\", \"SCRIPT_FILENAME\": \"/Users/imacbook/git/oneblog2/public/index.php\", \"SERVER_PROTOCOL\": \"HTTP/1.1\", \"SERVER_SOFTWARE\": \"Apache/2.4.41 (Unix) mod_fcgid/2.3.9\", \"SERVER_SIGNATURE\": \"\", \"GATEWAY_INTERFACE\": \"CGI/1.1\", \"HTTP_CACHE_CONTROL\": \"max-age=0\", \"REQUEST_TIME_FLOAT\": 1642743945.330043, \"HTTP_ACCEPT_ENCODING\": \"gzip, deflate\", \"HTTP_ACCEPT_LANGUAGE\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"CONTEXT_DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"PHP_FCGI_MAX_REQUESTS\": \"1000\", \"__CF_USER_TEXT_ENCODING\": \"0x1F5:0x19:0x34\", \"HTTP_UPGRADE_INSECURE_REQUESTS\": \"1\"}}}', '{\"url\": {\"full\": \"http://blog.cn/\", \"path\": \"/index.php\", \"port\": \"80\", \"search\": \"?\", \"protocol\": \"http\"}, \"request\": {\"method\": \"GET\", \"socket\": {\"remote_address\": \"127.0.0.1\"}, \"cookies\": {\"PHPSESSID\": \"04d78a60c9cfe761565175c6e01691e1\", \"think_lang\": \"zh-cn\"}, \"headers\": {\"Host\": \"blog.cn\", \"Accept\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"Cookie\": \"think_lang=zh-cn; PHPSESSID=04d78a60c9cfe761565175c6e01691e1\", \"Connection\": \"close\", \"User-Agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.69\", \"Cache-Control\": \"max-age=0\", \"Accept-Encoding\": \"gzip, deflate\", \"Accept-Language\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"Upgrade-Insecure-Requests\": \"1\"}, \"version\": \"/1.1\"}}', '648f79248ef96c40680d91ee9d4b5e3f9f8355fb5a5360326a122d65ca511020', '200');
INSERT INTO `transaction` VALUES (3, 'Vw', 1, 6.98, 1176.3, NULL, 'WEB', 'request', '{\"ip\": \"127.0.0.1\", \"os\": \"Darwin\", \"hostname\": \"iMacBookdeMac-mini.local\"}', '2022-02-04 16:10:13', '2022-02-04 16:10:15', '{\"总结\": \"应用开始 blog.cn/ [运行时间：1.424587s][吞吐率：0.70req/s] [内存消耗：5,782.73kb] [文件加载：225]\", \"请求信息\": {\"GET Data\": [], \"POST Data\": [], \"Server/Request Data\": {\"PATH\": \"/usr/bin:/bin:/usr/sbin:/sbin\", \"PHPRC\": \"/Applications/phpstudy/Extensions/php/php7.4.27\", \"PHP_SELF\": \"/index.php\", \"FCGI_ROLE\": \"RESPONDER\", \"HTTP_HOST\": \"blog.cn\", \"HTTP_ACCEPT\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"HTTP_COOKIE\": \"think_lang=zh-cn; PHPSESSID=7ecef5f76c901ce222d5d8b94991f812\", \"REMOTE_ADDR\": \"127.0.0.1\", \"REMOTE_PORT\": \"62293\", \"REQUEST_URI\": \"/\", \"SCRIPT_NAME\": \"/index.php\", \"SERVER_ADDR\": \"127.0.0.1\", \"SERVER_NAME\": \"blog.cn\", \"SERVER_PORT\": \"80\", \"QUERY_STRING\": \"\", \"REQUEST_TIME\": 1643962212, \"SERVER_ADMIN\": \"[no address given]\", \"DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"CONTEXT_PREFIX\": \"\", \"REQUEST_METHOD\": \"GET\", \"REQUEST_SCHEME\": \"http\", \"HTTP_CONNECTION\": \"close\", \"HTTP_USER_AGENT\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.76\", \"SCRIPT_FILENAME\": \"/Users/imacbook/git/oneblog2/public/index.php\", \"SERVER_PROTOCOL\": \"HTTP/1.1\", \"SERVER_SOFTWARE\": \"Apache/2.4.41 (Unix) mod_fcgid/2.3.9\", \"SERVER_SIGNATURE\": \"\", \"GATEWAY_INTERFACE\": \"CGI/1.1\", \"HTTP_CACHE_CONTROL\": \"max-age=0\", \"REQUEST_TIME_FLOAT\": 1643962212.976678, \"HTTP_ACCEPT_ENCODING\": \"gzip, deflate\", \"HTTP_ACCEPT_LANGUAGE\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"CONTEXT_DOCUMENT_ROOT\": \"/Users/imacbook/git/oneblog2/public\", \"HTTP_PROXY_CONNECTION\": \"keep-alive\", \"PHP_FCGI_MAX_REQUESTS\": \"1000\", \"__CF_USER_TEXT_ENCODING\": \"0x1F5:0x19:0x34\", \"HTTP_UPGRADE_INSECURE_REQUESTS\": \"1\"}}}', '{\"url\": {\"full\": \"http://blog.cn/\", \"path\": \"/index.php\", \"port\": \"80\", \"search\": \"?\", \"protocol\": \"http\"}, \"request\": {\"method\": \"GET\", \"socket\": {\"remote_address\": \"127.0.0.1\"}, \"cookies\": {\"PHPSESSID\": \"7ecef5f76c901ce222d5d8b94991f812\", \"think_lang\": \"zh-cn\"}, \"headers\": {\"Host\": \"blog.cn\", \"Accept\": \"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\", \"Cookie\": \"think_lang=zh-cn; PHPSESSID=7ecef5f76c901ce222d5d8b94991f812\", \"Connection\": \"close\", \"User-Agent\": \"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36 Edg/97.0.1072.76\", \"Cache-Control\": \"max-age=0\", \"Accept-Encoding\": \"gzip, deflate\", \"Accept-Language\": \"zh-CN,zh;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6\", \"Proxy-Connection\": \"keep-alive\", \"Upgrade-Insecure-Requests\": \"1\"}, \"version\": \"/1.1\"}}', 'e30a9796026c301bbc4bb11997498980380c66da2862a26a05b1b41162621125', '200');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `tel` varchar(32) DEFAULT NULL COMMENT '手机',
  `job` varchar(255) DEFAULT NULL COMMENT '职业',
  `config` json DEFAULT NULL COMMENT '配置',
  `keys` json DEFAULT NULL COMMENT '开发者key',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `last_usage_day` datetime DEFAULT NULL COMMENT '最后使用时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='User 用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'yangweijie', '$2y$10$V.4gb1skLccApL9ZlYQqReDfwpU1BARkbPj8KPGK3cI87UmgfEgzi', '', '', NULL, NULL, NULL, '2022-01-18 17:13:07', '2022-01-18 17:13:07', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
