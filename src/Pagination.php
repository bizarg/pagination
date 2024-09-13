<?php

namespace Bizarg\Pagination;

use Illuminate\Http\Request;

class Pagination
{
    public const DEFAULT_NUMBER = 1;
    public const DEFAULT_SIZE = 10;

    private $number;
    private $size;

    public function __construct(int $number = self::DEFAULT_NUMBER, int $size = self::DEFAULT_SIZE)
    {
        $this->number = $number;
        $this->size = $size;
    }

    public function page(): int
    {
        return $this->number;
    }

    public function offset(): int
    {
        return $this->size * ($this->number - 1);
    }

    public function limit(): int
    {
        return $this->size;
    }

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
