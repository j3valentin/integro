<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class TestCase
{
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 1,
     *     max = 100
     * )
     * @var int
     */
    private $n;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 1,
     *     max = 1000
     * )
     * @var int
     */
    private $m;

    /**
     * @var Query[]|ArrayCollection
     */
    private $queries;

    /**
     * @var array
     */
    private $matrix;

    public function __construct() { $this->queries = new ArrayCollection(); }

    public function getN() { return $this->n; }

    public function getM() { return $this->m; }

    public function setM($m) { $this->m = $m; }

    public function getQueries() { return $this->queries; }

    public function setQueries($queries) { $this->queries = $queries; }

    public function addQuery(Query $query)
    {
        if ($query->testCase() === null) {
            $query->setTestCase($this);
        }
        $this->queries->add($query);
    }

    /**
     * Build matrix
     * @param int $n
     */
    public function setN($n)
    {
        $this->n = $n;
        for ($i = 0; $i <= $n; $i++) {
            for ($j = 0; $j <= $n; $j++) {
                for ($k = 0; $k <= $n; $k++) {
                    $this->matrix[$i][$j][$k] = 0;
                }
            }
        }
    }

    public function output()
    {
        $anws = [];
        /** @var Query $query */
        foreach ($this->queries as $query) {
            $type = array_search($query->getType(), Query::$TYPES);
            if ($type === false) {
                continue;
            }
            $anw = $this->$type($query->getFields());
            if ($anw !== null) {
                $anws[] = $anw;
            }
        }
        return $anws;
    }

    public function update($fields)
    {
        $this->matrix[$fields[0]][$fields[1]][$fields[2]] = $fields[3];
    }

    public function query($fields)
    {
        $sum = 0;
        for ($x = $fields[0]; $x <= $fields[3]; $x++) {
            for ($y = $fields[1]; $y <= $fields[4]; $y++) {
                for ($z = $fields[2]; $z <= $fields[5]; $z++) {
                    $sum += $this->matrix[$x][$y][$z];
                }
            }
        }
        return $sum;
    }
}
