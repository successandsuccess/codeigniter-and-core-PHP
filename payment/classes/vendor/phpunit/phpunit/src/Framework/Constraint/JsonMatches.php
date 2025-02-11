<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Constraint;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Util\Json;
use SebastianBergmann\Comparator\ComparisonFailure;

/**
 * Asserts whether or not two JSON objects are equal.
 */
class JsonMatches extends Constraint
{
    /**
     * @var string
     */
    protected $value;

    /**
     * Creates a new constraint.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct();
        $this->value = $value;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
     * @param mixed $other Value or object to evaluate.
     *
     * @return bool
     */
    protected function matches($other)
    {
        list($error, $recodedOther) = Json::canonicalize($other);
        if ($error) {
            return false;
        }

        list($error, $recodedValue) = Json::canonicalize($this->value);
        if ($error) {
            return false;
        }

        return $recodedOther == $recodedValue;
    }

    /**
     * Throws an exception for the given compared value and test description
     *
     * @param mixed             $other             Evaluated value or object.
     * @param string            $description       Additional information about the test
     * @param ComparisonFailure $comparisonFailure
     *
     * @throws ExpectationFailedException
     */
    protected function fail($other, $description, ComparisonFailure $comparisonFailure = null)
    {
        if ($comparisonFailure === null) {
            list($error) = Json::canonicalize($other);
            if ($error) {
                parent::fail($other, $description);

                return;
            }

            list($error) = Json::canonicalize($this->value);
            if ($error) {
                parent::fail($other, $description);

                return;
            }

            $comparisonFailure = new ComparisonFailure(
                \json_decode($this->value),
                \json_decode($other),
                Json::prettify($this->value),
                Json::prettify($other),
                false,
                'Failed asserting that two json values are equal.'
            );
        }

        parent::fail($other, $description, $comparisonFailure);
    }

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function toString()
    {
        return \sprintf(
            'matches JSON string "%s"',
            $this->value
        );
    }
}
