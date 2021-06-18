<?php
namespace SteffenTools\Utils;

use SteffenTools\String\StringUtils;

/**
 * Class Result
 * @package SteffenTools\Utils
 * 输出接口json格式
 */
class Result
{

    /**
     * @var
     * 提示信息
     */
    public $message;

    /**
     * @var
     * 扩展额外数据
     */
    public $extra;

    /**
     * @var
     * 响应数据
     */
    public $data;


    /**
     * @var
     * 响应码
     */
    public $code;


    /**
     * @var
     * 是否成功
     */
    public $success;



    /**
     * @var
     * 分页对象
     */
    public $pager;



    // 禁止克隆
    private function __clone() {}

    // 禁止实例化
    private function __construct(){}


    /**
     * @return string
     * 当echo当前对象，就会触发这个方法
     */
    public function __toString() : string
    {
        // 输出json头
        header("content-type:application/json");
        $data = [
            'code' => $this->code,
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
            'extra' => $this->extra
        ];

        if (!is_null($this->pager)) {
            $data['pager'] = $this->pager;
        }
        return StringUtils::jsonEncode($data);
    }


    /**
     * @return Result
     * 统一输出成功的格式
     */
    public static function ok() {
        $result = new self();
        $result->isSuccess(true)
            ->code(ResultCode::SUCCESS['code'])
            ->message(ResultCode::SUCCESS['message']);
        return $result;
    }


    /**
     * @return Result
     * 统一输出失败的格式
     */
    public static function fail() {
        $result = new self();
        $result->isSuccess(false)
            ->code(ResultCode::ERROR['code'])
            ->message(ResultCode::ERROR['message']);
        return $result;
    }


    /**
     * @param $page 当前页
     * @param $pageSize
     * @param $total
     * @param $data
     * @param array $extra
     * @return Result
     * 输出带分页的列表数据
     */
    public static function pager($page,$pageSize,$total,$data,$extra = [])
    {
        $result = new self();
        $result->isSuccess(true)
            ->code(ResultCode::SUCCESS['code'])
            ->message(ResultCode::SUCCESS['message'])
            ->data($data)
            ->extra($extra)
            ->setPager(new Pager($page,$pageSize,$total));
        return $result;
    }


    /**
     * @param Pager $pager
     * @return $this
     * 设置分页
     */
    public function setPager(Pager $pager): self
    {
        $this->pager = $pager;

        return $this;
    }


    /**
     * @param $isSuccess
     * @return $this
     * 设置是否成功
     */
    public function isSuccess($isSuccess)
    {
        $this->success = $isSuccess;
        return $this;
    }


    /**
     * @param $data
     * @return $this
     * 设置输出的数据
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }


    /**
     * @param $extra
     * @return $this
     * 设置额外数据
     */
    public function extra($extra)
    {
        $this->extra = $extra;
        return $this;
    }


    /**
     * @param $code
     * @return $this
     * 设置响应编码
     */
    public function code($code)
    {
        $this->code = $code;
        return $this;
    }


    /**
     * @param $message
     * @return $this
     * 设置响应信息
     */
    public function message($message)
    {
        $this->message = $message;
        return $this;
    }
}