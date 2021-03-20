<?php

namespace Bizarg\Pagination;

use Illuminate\Http\Request;

/**
 * Class Pagination
 * @package Bizarg\Pagination
 */
class Pagination
{
    /**
     * @var int
     */
    public const DEFAULT_NUMBER = 1;
    /**
     * @var int
     */
    public const DEFAULT_SIZE = 10;

    /**
     * @var int
     */
    private $number = 1;

    /**
     * @var int
     */
    private $size = 10;

    /**
     * Pagination constructor.
     *
     * @param int $number
     * @param int $size
     */
    public function __construct(int $number = self::DEFAULT_NUMBER, int $size = self::DEFAULT_SIZE)
    {
        $this->number = $number ?: $this->number;
        $this->size = $size ?: $this->size;
    }

    /**
     * @return int
     */
    public function page()
    {
        return $this->number;
    }

    /**
     * @return int
     */
    public function offset()
    {
        return $this->size * ($this->number - 1);
    }

    /**
     * @return int
     */
    public function limit()
    {
        return $this->size;
    }

    /**
     * @param Request $request
     * @return self
     */
    public static function fromRequest(Request $request): self
    {
        return new static(self::getPageNumberFromRequest($request), self::getPerPageFromRequest($request));
    }

    /**
     * @param Request $request
     * @return int|mixed
     */
    public static function getPageNumberFromRequest(Request $request)
    {
        return $request->input('page.number') ?: self::DEFAULT_NUMBER;
    }

    /**
     * @param Request $request
     * @return int|mixed
     */
    public static function getPerPageFromRequest(Request $request)
    {
        return $request->input('page.size') ?: self::DEFAULT_SIZE;
    }
}
