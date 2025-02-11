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
use PHPUnit\Framework\TestFailure;

class StringEndsWithTest extends ConstraintTestCase
{
    public function testConstraintStringEndsWithCorrectValueAndReturnResult()
    {
        $constraint = new StringEndsWith('suffix');
        $this->assertTrue($constraint->evaluate('foosuffix', '', true));
    }

    public function testConstraintStringEndsWithNotCorrectValueAndReturnResult()
    {
        $constraint = new StringEndsWith('suffix');
        $this->assertFalse($constraint->evaluate('suffixerror', '', true));
    }

    public function testConstraintStringEndsWithToStringMethod()
    {
        $constraint = new StringEndsWith('suffix');

        $this->assertEquals('ends with "suffix"', $constraint->toString());
    }

    public function testConstraintStringEndsWithCountMethod()
    {
        $constraint = new StringEndsWith('suffix');

        $this->assertCount(1, $constraint);
    }

    public function testConstraintStringEndsWithNotCorrectValueAndExpectation()
    {
        $constraint = new StringEndsWith('suffix');

        try {
            $constraint->evaluate('error');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
Failed asserting that 'error' ends with "suffix".

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }

    public function testConstraintStringEndsWithNotCorrectValueExceptionAndCustomMessage()
    {
        $constraint = new StringEndsWith('suffix');

        try {
            $constraint->evaluate('error', 'custom message');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                <<<EOF
custom message
Failed asserting that 'error' ends with "suffix".

EOF
                ,
                TestFailure::exceptionToString($e)
            );

            return;
        }

        $this->fail();
    }
}
