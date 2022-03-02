<?php

namespace App\Core\Models;

use InvalidArgumentException;

class Plateau
{
    private int $xMax;

    private int $yMax;

    private int $xMin = 0;

    private int $yMin = 0;

    /**
     * @return int
     */
    public function getXMax(): int
    {
        return $this->xMax;
    }

    /**
     * @param int $xMax
     */
    public function setXMax(int $xMax): void
    {
        $this->xMax = $xMax;
    }

    /**
     * @return int
     */
    public function getYMax(): int
    {
        return $this->yMax;
    }

    /**
     * @param int $yMax
     */
    public function setYMax(int $yMax): void
    {
        $this->yMax = $yMax;
    }

    /**
     * @return int
     */
    public function getXMin(): int
    {
        return $this->xMin;
    }

    /**
     * @param int $xMin
     */
    public function setXMin(int $xMin): void
    {
        $this->xMin = $xMin;
    }

    /**
     * @return int
     */
    public function getYMin(): int
    {
        return $this->yMin;
    }

    /**
     * @param int $yMin
     */
    public function setYMin(int $yMin): void
    {
        $this->yMin = $yMin;
    }


    public function isValidCoordinate(int $x, int $y): bool
    {
        if ($x > $this->xMax || $x < $this->xMin ||
            $y > $this->yMax || $y < $this->yMin) {
            return false;
        }
        return true;
    }
}