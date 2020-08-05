<?php


namespace EasySwoole\HttpAnnotation\Tests\TestController;


use EasySwoole\HttpAnnotation\AnnotationController;
use EasySwoole\HttpAnnotation\AnnotationTag\Api;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiAuth;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiFail;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiFailParam;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroup as ApiGroupTag;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupAuth;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiGroupDescription;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiRequestExample;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccess;
use EasySwoole\HttpAnnotation\AnnotationTag\ApiSuccessParam;
use EasySwoole\HttpAnnotation\AnnotationTag\CircuitBreaker;
use EasySwoole\HttpAnnotation\AnnotationTag\Context;
use EasySwoole\HttpAnnotation\AnnotationTag\Di;
use EasySwoole\HttpAnnotation\AnnotationTag\InjectParamsContext;
use EasySwoole\HttpAnnotation\AnnotationTag\Method;
use EasySwoole\HttpAnnotation\AnnotationTag\Param;
use EasySwoole\HttpAnnotation\Exception\Annotation\ParamValidateError;

/**
 * Class ControllerA
 * @package EasySwoole\HttpAnnotation\Tests\TestController
 * @ApiGroupTag(groupName="GroupA")
 * @ApiGroupDescription("GroupA desc")
 * @ApiGroupAuth(name="groupParamA",required="")
 * @ApiGroupAuth(name="groupParamB",required="")
 */
class ApiGroup extends AnnotationController
{

    /**
     * @Di(key="di")
     */
    public $di;
    /**
     * @Context(key="context")
     */
    public $context;

    /**
     * @Api(path="/apiGroup/func",name="func")
     * @ApiAuth(name="apiAuth1")
     * @ApiAuth(name="apiAuth2")
     * @ApiDescription("func desc")
     * @ApiFail("func fail example1")
     * @ApiFail("func fail example2")
     * @ApiFailParam(name="failParam1")
     * @ApiFailParam(name="failParam2")
     * @ApiRequestExample("func request example1")
     * @ApiRequestExample("func request example2")
     * @ApiSuccess("func success example1")
     * @ApiSuccess("func success example2")
     * @ApiSuccessParam(name="successParam1")
     * @ApiSuccessParam(name="successParam2")
     * @CircuitBreaker(timeout=5.0)
     * @InjectParamsContext(key="requestData")
     * @Method(allow={POST,GET})
     * @Param(name="param1")
     * @Param(name="param2")
     */
    function func()
    {

    }

    function index()
    {
        $this->response()->write('index');
    }

    /**
     * @Method(allow={POST})
     */
    function allowPostMethod()
    {
        $this->response()->write('allowPostMethod');
    }

    function onException(\Throwable $throwable): void
    {
        if($throwable instanceof ParamValidateError){
            $this->response()->write("PE-{$throwable->getValidate()->getError()->getField()}");
        }else{
            throw $throwable;
        }
    }

    protected function gc()
    {
        //不调用父类重置成员属性，方便单元测试
    }
}