<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Query
{
    public static $TYPES = [
        'UPDATE' => 4,
        'QUERY' => 6
    ];

    /**
     * @Assert\Choice(callback="getTypes")
     * @Assert\NotBlank()
     * @var string
     */
    private $type;

    /**
     * @var int[]
     */
    private $fields;

    /**
     * @var TestCase
     */
    private $testCase;

    public static function getTypes() { return self::$TYPES; }

    public function getType() { return $this->type; }

    public function setType($type) { $this->type = $type; }

    public function getFields() { return $this->fields; }

    public function testCase() { return $this->testCase(); }

    public function setTestCase($testCase) { $this->testCase = $testCase; }

    public function setFields($fields) { $this->fields = $fields; }
}
