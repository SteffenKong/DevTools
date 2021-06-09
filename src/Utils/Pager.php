<?php
namespace SteffenTools\Utils;

/**
 * Class Pager
 * @package SteffenTools\Utils
 * Pager分页对象
 */
class Pager
{

    /**
     * @var
     * 当前页
     */
    public $currentPage;

    /**
     * @var
     * 总数据条数
     */
    public $total;

    /**
     * @var
     * 每页显示的数量
     */
    public $pageSize;

    /**
     * @var
     * 总页数
     */
    public $totalPage;

    /**
     * Pager constructor.
     * @param $currentPage
     * @param $pageSize
     * @param $total
     */
    public function __construct($currentPage,$pageSize,$total)
    {
        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize;
        $this->total = $total;
        $this->totalPage = $pageSize != 0 ? ceil(bcdiv($this->total,$this->pageSize)) : 0;
    }
}