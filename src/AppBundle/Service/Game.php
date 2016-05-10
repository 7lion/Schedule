<?php

namespace AppBundle\Service;

class Game
{
    public $debug = false;

    private $step = 0;

    private $map = [
        [0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0],
    ];

    public function setFirstPoint($x, $y)
    {
        if (!isset($this->map[$x][$y])) {
            throw new \InvalidArgumentException(
                sprintf('Invalid argument x = %s or y = %s', $x, $y)
            );
        }
        $this->map[$x][$y] = 1;
    }

    public function capture()
    {
        if ($this->isMapEmpty()) {
            throw new \RuntimeException('First you need to setFirstPoint');
        }

        $this->incrementStep();
        if ($this->debug) {
            $this->printView();
        }

        $map = &$this->map;
        $doCapture = function ($x, $y, $step) use (&$map) {
            if (isset($map[$x - 1][$y]) && empty($map[$x - 1][$y])) {
                $map[$x - 1][$y] = $step;
            }
            if (isset($map[$x + 1][$y]) && empty($map[$x + 1][$y])) {
                $map[$x + 1][$y] = $step;
            }
            if (isset($map[$x][$y - 1]) && empty($map[$x][$y - 1])) {
                $map[$x][$y - 1] = $step;
            }
            if (isset($map[$x][$y + 1]) && empty($map[$x][$y + 1])) {
                $map[$x][$y + 1] = $step;
            }
        };

        foreach ($map as $x => $area) {
            foreach ($area as $y => $value) {
                if ($value === $this->step) {
                    $doCapture($x, $y, $this->step + 1);
                }
            }
        }
        if (!$this->isGameOver()) {
            $this->capture();
        }
    }

    public function printView()
    {
        foreach ($this->map as $values) {
            foreach ($values as $value) {
                echo $value . ' ';
            }
            echo "<br />";
        }
        echo "<hr />";
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->step;
    }

    private function incrementStep()
    {
        $this->step++;
    }

    /**
     * @return bool
     */
    private function isGameOver()
    {
        $isFinished = true;
        array_walk_recursive($this->map, function ($val) use (&$isFinished) {
            if ($val === 0) {
                $isFinished = false;
            }
        });

        return $isFinished;
    }

    /**
     * @return bool
     */
    private function isMapEmpty()
    {
        $empty = true;
        array_walk_recursive($this->map, function ($val) use (&$empty) {
            if (!empty($val)) {
                $empty = false;
            }
        });

        return $empty;
    }
}
