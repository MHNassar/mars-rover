<?php

namespace App\Core\Models;

class Plateau
{
    private int $xMax;

    private int $yMax;

    private int $xMin = 0;

    private int $yMin = 0;


    /**
     * @param int $xMax
     */
    public function setXMax(int $xMax): void
    {
        $this->xMax = $xMax;
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

    public function isValidCoordinate(CoordinatePoint $point): bool
    {

        if ($point->xAxis >= $this->xMax || $point->xAxis < $this->xMin ||
            $point->yAxis >= $this->yMax || $point->yAxis < $this->yMin) {
            return false;
        }
        return true;
    }
}