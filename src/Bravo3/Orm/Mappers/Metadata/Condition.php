<?php
namespace Bravo3\Orm\Mappers\Metadata;

use Bravo3\Orm\Exceptions\UnexpectedValueException;

class Condition
{
    /**
     * @var string
     */
    protected $column;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $comparison;

    public function __construct($column, $value, $comparison = '=')
    {
        $this->column     = $column;
        $this->value      = $value;
        $this->comparison = $comparison;
    }

    /**
     * Get Column
     *
     * @return string
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set Column
     *
     * @param string $column
     * @return $this
     */
    public function setColumn($column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Get Value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get Comparison
     *
     * @return string
     */
    public function getComparison()
    {
        return $this->comparison;
    }

    /**
     * Set Comparison
     *
     * @param string $comparison
     * @return $this
     */
    public function setComparison($comparison)
    {
        $this->comparison = $comparison;
        return $this;
    }

    /**
     * Test a value against this condition
     *
     * @param mixed $value
     * @return bool
     */
    public function test($value)
    {
        switch ($this->comparison) {
            case '=':
            case '==':
                return $value == $this->value;
            case '===':
                return $value === $this->value;
            case '>':
                return $value > $this->value;
            case '<':
                return $value < $this->value;
            case '<=':
                return $value <= $this->value;
            case '>=':
                return $value >= $this->value;
            case '!=':
                return $value != $this->value;
            case '!==':
                return $value !== $this->value;
            default:
                throw new UnexpectedValueException("Unknown comparison operator: ".$this->comparison);
        }
    }
}
