<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class CubeSummation
{
    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min = 1,
     *     max = 50
     * )
     * @var int
     */
    private $nTestCases;

    /**
     * @var TestCase[]|ArrayCollection
     */
    private $testCases;

    public function __construct() { $this->testCases = new ArrayCollection(); }

    public function getNTestCases() { return $this->nTestCases; }

    public function setNTestCases($nTestCases) { $this->nTestCases = $nTestCases; }

    public function getTestCases() { return $this->testCases; }

    public function setTestCases($testCases) { $this->testCases = $testCases; }

    public function addTestCase(TestCase $testCase) { $this->testCases->add($testCase); }

    public function output()
    {
        $anws = [];
        foreach ($this->testCases as $testCase) {
            $anws[] = $testCase->output();
        }
        return $anws;
    }
}
