<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPUnit\Framework;

use DeepCopy\DeepCopy;
use PHPUnit\Framework\Constraint\Exception as ExceptionConstraint;
use PHPUnit\Framework\Constraint\ExceptionCode;
use PHPUnit\Framework\Constraint\ExceptionMessage;
use PHPUnit\Framework\Constraint\ExceptionMessageRegularExpression;
use PHPUnit\Framework\MockObject\Generator as MockGenerator;
use PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount as AnyInvokedCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex as InvokedAtIndexMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastCount as InvokedAtLeastCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce as InvokedAtLeastOnceMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtMostCount as InvokedAtMostCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedCount as InvokedCountMatcher;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls as ConsecutiveCallsStub;
use PHPUnit\Framework\MockObject\Stub\Exception as ExceptionStub;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument as ReturnArgumentStub;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback as ReturnCallbackStub;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf as ReturnSelfStub;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap as ReturnValueMapStub;
use PHPUnit\Runner\BaseTestRunner;
use PHPUnit\Runner\PhptTestCase;
use PHPUnit\Util\GlobalState;
use PHPUnit\Util\InvalidArgumentHelper;
use PHPUnit\Util\PHP\AbstractPhpProcess;
use Prophecy;
use Prophecy\Exception\Prediction\PredictionException;
use Prophecy\Prophet;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\Factory as ComparatorFactory;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Exporter\Exporter;
use SebastianBergmann\GlobalState\Blacklist;
use SebastianBergmann\GlobalState\Restorer;
use SebastianBergmann\GlobalState\Snapshot;
use SebastianBergmann\ObjectEnumerator\Enumerator;
use Text_Template;
use Throwable;

/**
 * A TestCase defines the fixture to run multiple tests.
 *
 * To define a TestCase
 *
 *   1) Implement a subclass of PHPUnit\Framework\TestCase.
 *   2) Define instance variables that store the state of the fixture.
 *   3) Initialize the fixture state by overriding setUp().
 *   4) Clean-up after a test by overriding tearDown().
 *
 * Each test runs in its own fixture so there can be no side effects
 * among test runs.
 *
 * Here is an example:
 *
 * <code>
 * <?php
 * class MathTest extends PHPUnit\Framework\TestCase
 * {
 *     public $value1;
 *     public $value2;
 *
 *     protected function setUp()
 *     {
 *         $this->value1 = 2;
 *         $this->value2 = 3;
 *     }
 * }
 * ?>
 * </code>
 *
 * For each test implement a method which interacts with the fixture.
 * Verify the expected results with assertions specified by calling
 * assert with a boolean.
 *
 * <code>
 * <?php
 * public function testPass()
 * {
 *     $this->assertTrue($this->value1 + $this->value2 == 5);
 * }
 * ?>
 * </code>
 */
abstract class TestCase extends Assert implements Test, SelfDescribing
{
    /**
     * Enable or disable the backup and restoration of the $GLOBALS array.
     * Overwrite this attribute in a child class of TestCase.
     * Setting this attribute in setUp() has no effect!
     *
     * @var bool
     */
    protected $backupGlobals;

    /**
     * @var array
     */
    protected $backupGlobalsBlacklist = [];

    /**
     * Enable or disable the backup and restoration of static attributes.
     * Overwrite this attribute in a child class of TestCase.
     * Setting this attribute in setUp() has no effect!
     *
     * @var bool
     */
    protected $backupStaticAttributes;

    /**
     * @var array
     */
    protected $backupStaticAttributesBlacklist = [];

    /**
     * Whether or not this test is to be run in a separate PHP process.
     *
     * @var bool
     */
    protected $runTestInSeparateProcess;

    /**
     * Whether or not this class is to be run in a separate PHP process.
     *
     * @var bool
     */
    private $runClassInSeparateProcess;

    /**
     * Whether or not this test should preserve the global state when
     * running in a separate PHP process.
     *
     * @var bool
     */
    protected $preserveGlobalState = true;

    /**
     * Whether or not this test is running in a separate PHP process.
     *
     * @var bool
     */
    private $inIsolation = false;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $dataName;

    /**
     * @var bool
     */
    private $useErrorHandler;

    /**
     * The name of the expected Exception.
     *
     * @var null|string
     */
    private $expectedException;

    /**
     * The message of the expected Exception.
     *
     * @var string
     */
    private $expectedExceptionMessage;

    /**
     * The regex pattern to validate the expected Exception message.
     *
     * @var string
     */
    private $expectedExceptionMessageRegExp;

    /**
     * The code of the expected Exception.
     *
     * @var null|int|string
     */
    private $expectedExceptionCode;

    /**
     * The name of the test case.
     *
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $dependencies = [];

    /**
     * @var array
     */
    private $dependencyInput = [];

    /**
     * @var array
     */
    private $iniSettings = [];

    /**
     * @var array
     */
    private $locale = [];

    /**
     * @var array
     */
    private $mockObjects = [];

    /**
     * @var MockGenerator
     */
    private $mockObjectGenerator;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $statusMessage = '';

    /**
     * @var int
     */
    private $numAssertions = 0;

    /**
     * @var TestResult
     */
    private $result;

    /**
     * @var mixed
     */
    private $testResult;

    /**
     * @var string
     */
    private $output = '';

    /**
     * @var string
     */
    private $outputExpectedRegex;

    /**
     * @var string
     */
    private $outputExpectedString;

    /**
     * @var mixed
     */
    private $outputCallback = false;

    /**
     * @var bool
     */
    private $outputBufferingActive = false;

    /**
     * @var int
     */
    private $outputBufferingLevel;

    /**
     * @var Snapshot
     */
    private $snapshot;

    /**
     * @var Prophecy\Prophet
     */
    private $prophet;

    /**
     * @var bool
     */
    private $beStrictAboutChangesToGlobalState = false;

    /**
     * @var bool
     */
    private $registerMockObjectsFromTestArgumentsRecursively = false;

    /**
     * @var string[]
     */
    private $warnings = [];

    /**
     * @var array
     */
    private $groups = [];

    /**
     * @var bool
     */
    private $doesNotPerformAssertions = false;

    /**
     * @var Comparator[]
     */
    private $customComparators = [];

    /**
     * Constructs a test case with the given name.
     *
     * @param string $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        if ($name !== null) {
            $this->setName($name);
        }

        $this->data     = $data;
        $this->dataName = $dataName;
    }

    /**
     * Returns a string representation of the test case.
     *
     * @return string
     */
    public function toString()
    {
        $class = new ReflectionClass($this);

        $buffer = \sprintf(
            '%s::%s',
            $class->name,
            $this->getName(false)
        );

        return $buffer . $this->getDataSetAsString();
    }

    /**
     * Counts the number of test cases executed by run(TestResult result).
     *
     * @return int
     */
    public function count()
    {
        return 1;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     */
    public function setGroups(array $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Returns the annotations for this test.
     *
     * @return array
     */
    public function getAnnotations()
    {
        return \PHPUnit\Util\Test::parseTestMethodAnnotations(
            \get_class($this),
            $this->name
        );
    }

    /**
     * Gets the name of a TestCase.
     *
     * @param bool $withDataSet
     *
     * @return string
     */
    public function getName($withDataSet = true)
    {
        if ($withDataSet) {
            return $this->name . $this->getDataSetAsString(false);
        }

        return $this->name;
    }

    /**
     * Returns the size of the test.
     *
     * @return int
     */
    public function getSize()
    {
        return \PHPUnit\Util\Test::getSize(
            \get_class($this),
            $this->getName(false)
        );
    }

    /**
     * @return bool
     */
    public function hasSize()
    {
        return $this->getSize() !== \PHPUnit\Util\Test::UNKNOWN;
    }

    /**
     * @return bool
     */
    public function isSmall()
    {
        return $this->getSize() === \PHPUnit\Util\Test::SMALL;
    }

    /**
     * @return bool
     */
    public function isMedium()
    {
        return $this->getSize() === \PHPUnit\Util\Test::MEDIUM;
    }

    /**
     * @return bool
     */
    public function isLarge()
    {
        return $this->getSize() === \PHPUnit\Util\Test::LARGE;
    }

    /**
     * @return string
     */
    public function getActualOutput()
    {
        if (!$this->outputBufferingActive) {
            return $this->output;
        }

        return \ob_get_contents();
    }

    /**
     * @return bool
     */
    public function hasOutput()
    {
        if (\strlen($this->output) === 0) {
            return false;
        }

        if ($this->hasExpectationOnOutput()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function doesNotPerformAssertions()
    {
        return $this->doesNotPerformAssertions;
    }

    /**
     * @param string $expectedRegex
     *
     * @throws Exception
     */
    public function expectOutputRegex($expectedRegex)
    {
        if ($this->outputExpectedString !== null) {
            throw new Exception;
        }

        if (\is_string($expectedRegex) || null === $expectedRegex) {
            $this->outputExpectedRegex = $expectedRegex;
        }
    }

    /**
     * @param string $expectedString
     */
    public function expectOutputString($expectedString)
    {
        if ($this->outputExpectedRegex !== null) {
            throw new Exception;
        }

        if (\is_string($expectedString) || null === $expectedString) {
            $this->outputExpectedString = $expectedString;
        }
    }

    /**
     * @return bool
     */
    public function hasExpectationOnOutput()
    {
        return \is_string($this->outputExpectedString) || \is_string($this->outputExpectedRegex);
    }

    /**
     * @return null|string
     */
    public function getExpectedException()
    {
        return $this->expectedException;
    }

    /**
     * @return null|int|string
     */
    public function getExpectedExceptionCode()
    {
        return $this->expectedExceptionCode;
    }

    /**
     * @return string
     */
    public function getExpectedExceptionMessage()
    {
        return $this->expectedExceptionMessage;
    }

    /**
     * @return string
     */
    public function getExpectedExceptionMessageRegExp()
    {
        return $this->expectedExceptionMessageRegExp;
    }

    /**
     * @param string $exception
     */
    public function expectException($exception)
    {
        if (!\is_string($exception)) {
            throw InvalidArgumentHelper::factory(1, 'string');
        }

        $this->expectedException = $exception;
    }

    /**
     * @param int|string $code
     *
     * @throws Exception
     */
    public function expectExceptionCode($code)
    {
        if (!\is_int($code) && !\is_string($code)) {
            throw InvalidArgumentHelper::factory(1, 'integer or string');
        }

        $this->expectedExceptionCode = $code;
    }

    /**
     * @param string $message
     *
     * @throws Exception
     */
    public function expectExceptionMessage($message)
    {
        if (!\is_string($message)) {
            throw InvalidArgumentHelper::factory(1, 'string');
        }

        $this->expectedExceptionMessage = $message;
    }

    /**
     * @param string $messageRegExp
     *
     * @throws Exception
     */
    public function expectExceptionMessageRegExp($messageRegExp)
    {
        if (!\is_string($messageRegExp)) {
            throw InvalidArgumentHelper::factory(1, 'string');
        }

        $this->expectedExceptionMessageRegExp = $messageRegExp;
    }

    /**
     * Sets up an expectation for an exception to be raised by the code under test.
     * Information for expected exception class, expected exception message, and
     * expected exception code are retrieved from a given Exception object.
     */
    public function expectExceptionObject(\Exception $exception)
    {
        $this->expectException(\get_class($exception));
        $this->expectExceptionMessage($exception->getMessage());
        $this->expectExceptionCode($exception->getCode());
    }

    /**
     * @param bool $flag
     */
    public function setRegisterMockObjectsFromTestArgumentsRecursively($flag)
    {
        if (!\is_bool($flag)) {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->registerMockObjectsFromTestArgumentsRecursively = $flag;
    }

    protected function setExpectedExceptionFromAnnotation()
    {
        try {
            $expectedException = \PHPUnit\Util\Test::getExpectedException(
                \get_class($this),
                $this->name
            );

            if ($expectedException !== false) {
                $this->expectException($expectedException['class']);

                if ($expectedException['code'] !== null) {
                    $this->expectExceptionCode($expectedException['code']);
                }

                if ($expectedException['message'] !== '') {
                    $this->expectExceptionMessage($expectedException['message']);
                } elseif ($expectedException['message_regex'] !== '') {
                    $this->expectExceptionMessageRegExp($expectedException['message_regex']);
                }
            }
        } catch (ReflectionException $e) {
        }
    }

    /**
     * @param bool $useErrorHandler
     */
    public function setUseErrorHandler($useErrorHandler)
    {
        $this->useErrorHandler = $useErrorHandler;
    }

    protected function setUseErrorHandlerFromAnnotation()
    {
        try {
            $useErrorHandler = \PHPUnit\Util\Test::getErrorHandlerSettings(
                \get_class($this),
                $this->name
            );

            if ($useErrorHandler !== null) {
                $this->setUseErrorHandler($useErrorHandler);
            }
        } catch (ReflectionException $e) {
        }
    }

    protected function checkRequirements()
    {
        if (!$this->name || !\method_exists($this, $this->name)) {
            return;
        }

        $missingRequirements = \PHPUnit\Util\Test::getMissingRequirements(
            \get_class($this),
            $this->name
        );

        if (!empty($missingRequirements)) {
            $this->markTestSkipped(\implode(PHP_EOL, $missingRequirements));
        }
    }

    /**
     * Returns the status of this test.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function markAsRisky()
    {
        $this->status = BaseTestRunner::STATUS_RISKY;
    }

    /**
     * Returns the status message of this test.
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * Returns whether or not this test has failed.
     *
     * @return bool
     */
    public function hasFailed()
    {
        $status = $this->getStatus();

        return $status == BaseTestRunner::STATUS_FAILURE ||
            $status == BaseTestRunner::STATUS_ERROR;
    }

    /**
     * Runs the test case and collects the results in a TestResult object.
     * If no TestResult object is passed a new one will be created.
     *
     * @param TestResult $result
     *
     * @return TestResult
     *
     * @throws Exception
     */
    public function run(TestResult $result = null)
    {
        if ($result === null) {
            $result = $this->createResult();
        }

        if (!$this instanceof WarningTestCase) {
            $this->setTestResultObject($result);
            $this->setUseErrorHandlerFromAnnotation();
        }

        if ($this->useErrorHandler !== null) {
            $oldErrorHandlerSetting = $result->getConvertErrorsToExceptions();
            $result->convertErrorsToExceptions($this->useErrorHandler);
        }

        if (!$this instanceof WarningTestCase &&
            !$this instanceof SkippedTestCase &&
            !$this->handleDependencies()) {
            return $result;
        }

        $runEntireClass =  $this->runClassInSeparateProcess && !$this->runTestInSeparateProcess;

        if (($this->runTestInSeparateProcess === true || $this->runClassInSeparateProcess === true) &&
            $this->inIsolation !== true &&
            !$this instanceof PhptTestCase) {
            $class = new ReflectionClass($this);

            if ($runEntireClass) {
                $template = new Text_Template(
                    __DIR__ . '/../Util/PHP/Template/TestCaseClass.tpl'
                );
            } else {
                $template = new Text_Template(
                    __DIR__ . '/../Util/PHP/Template/TestCaseMethod.tpl'
                );
            }

            if ($this->preserveGlobalState) {
                $constants     = GlobalState::getConstantsAsString();
                $globals       = GlobalState::getGlobalsAsString();
                $includedFiles = GlobalState::getIncludedFilesAsString();
                $iniSettings   = GlobalState::getIniSettingsAsString();
            } else {
                $constants = '';
                if (!empty($GLOBALS['__PHPUNIT_BOOTSTRAP'])) {
                    $globals = '$GLOBALS[\'__PHPUNIT_BOOTSTRAP\'] = ' . \var_export($GLOBALS['__PHPUNIT_BOOTSTRAP'], true) . ";\n";
                } else {
                    $globals = '';
                }
                $includedFiles = '';
                $iniSettings   = '';
            }

            $coverage                                   = $result->getCollectCodeCoverageInformation() ? 'true' : 'false';
            $isStrictAboutTestsThatDoNotTestAnything    = $result->isStrictAboutTestsThatDoNotTestAnything() ? 'true' : 'false';
            $isStrictAboutOutputDuringTests             = $result->isStrictAboutOutputDuringTests() ? 'true' : 'false';
            $enforcesTimeLimit                          = $result->enforcesTimeLimit() ? 'true' : 'false';
            $isStrictAboutTodoAnnotatedTests            = $result->isStrictAboutTodoAnnotatedTests() ? 'true' : 'false';
            $isStrictAboutResourceUsageDuringSmallTests = $result->isStrictAboutResourceUsageDuringSmallTests() ? 'true' : 'false';

            if (\defined('PHPUNIT_COMPOSER_INSTALL')) {
                $composerAutoload = \var_export(PHPUNIT_COMPOSER_INSTALL, true);
            } else {
                $composerAutoload = '\'\'';
            }

            if (\defined('__PHPUNIT_PHAR__')) {
                $phar = \var_export(__PHPUNIT_PHAR__, true);
            } else {
                $phar = '\'\'';
            }

            if ($result->getCodeCoverage()) {
                $codeCoverageFilter = $result->getCodeCoverage()->filter();
            } else {
                $codeCoverageFilter = null;
            }

            $data               = \var_export(\serialize($this->data), true);
            $dataName           = \var_export($this->dataName, true);
            $dependencyInput    = \var_export(\serialize($this->dependencyInput), true);
            $includePath        = \var_export(\get_include_path(), true);
            $codeCoverageFilter = \var_export(\serialize($codeCoverageFilter), true);
            // must do these fixes because TestCaseMethod.tpl has unserialize('{data}') in it, and we can't break BC
            // the lines above used to use addcslashes() rather than var_export(), which breaks null byte escape sequences
            $data               = "'." . $data . ".'";
            $dataName           = "'.(" . $dataName . ").'";
            $dependencyInput    = "'." . $dependencyInput . ".'";
            $includePath        = "'." . $includePath . ".'";
            $codeCoverageFilter = "'." . $codeCoverageFilter . ".'";

            $configurationFilePath = $GLOBALS['__PHPUNIT_CONFIGURATION_FILE'] ?? '';

            $var = [
                'composerAutoload'                           => $composerAutoload,
                'phar'                                       => $phar,
                'filename'                                   => $class->getFileName(),
                'className'                                  => $class->getName(),
                'collectCodeCoverageInformation'             => $coverage,
                'data'                                       => $data,
                'dataName'                                   => $dataName,
                'dependencyInput'                            => $dependencyInput,
                'constants'                                  => $constants,
                'globals'                                    => $globals,
                'include_path'                               => $includePath,
                'included_files'                             => $includedFiles,
                'iniSettings'                                => $iniSettings,
                'isStrictAboutTestsThatDoNotTestAnything'    => $isStrictAboutTestsThatDoNotTestAnything,
                'isStrictAboutOutputDuringTests'             => $isStrictAboutOutputDuringTests,
                'enforcesTimeLimit'                          => $enforcesTimeLimit,
                'isStrictAboutTodoAnnotatedTests'            => $isStrictAboutTodoAnnotatedTests,
                'isStrictAboutResourceUsageDuringSmallTests' => $isStrictAboutResourceUsageDuringSmallTests,
                'codeCoverageFilter'                         => $codeCoverageFilter,
                'configurationFilePath'                      => $configurationFilePath,
                'name'                                       => $this->getName(false),
            ];

            if (!$runEntireClass) {
                $var['methodName'] = $this->name;
            }

            $template->setVar(
                $var
            );

            $this->prepareTemplate($template);

            $php = AbstractPhpProcess::factory();
            $php->runTestJob($template->render(), $this, $result);
        } else {
            $result->run($this);
        }

        if (isset($oldErrorHandlerSetting)) {
            $result->convertErrorsToExceptions($oldErrorHandlerSetting);
        }

        $this->result = null;

        return $result;
    }

    /**
     * Runs the bare test sequence.
     */
    public function runBare()
    {
        $this->numAssertions = 0;

        $this->snapshotGlobalState();
        $this->startOutputBuffering();
        \clearstatcache();
        $currentWorkingDirectory = \getcwd();

        $hookMethods = \PHPUnit\Util\Test::getHookMethods(\get_class($this));

        try {
            $hasMetRequirements = false;
            $this->checkRequirements();
            $hasMetRequirements = true;

            if ($this->inIsolation) {
                foreach ($hookMethods['beforeClass'] as $method) {
                    $this->$method();
                }
            }

            $this->setExpectedExceptionFromAnnotation();
            $this->setDoesNotPerformAssertionsFromAnnotation();

            foreach ($hookMethods['before'] as $method) {
                $this->$method();
            }

            $this->assertPreConditions();
            $this->testResult = $this->runTest();
            $this->verifyMockObjects();
            $this->assertPostConditions();

            if (!empty($this->warnings)) {
                throw new Warning(
                    \implode(
                        "\n",
                        \array_unique($this->warnings)
                    )
                );
            }

            $this->status = BaseTestRunner::STATUS_PASSED;
        } catch (IncompleteTest $e) {
            $this->status        = BaseTestRunner::STATUS_INCOMPLETE;
            $this->statusMessage = $e->getMessage();
        } catch (SkippedTest $e) {
            $this->status        = BaseTestRunner::STATUS_SKIPPED;
            $this->statusMessage = $e->getMessage();
        } catch (Warning $e) {
            $this->status        = BaseTestRunner::STATUS_WARNING;
            $this->statusMessage = $e->getMessage();
        } catch (AssertionFailedError $e) {
            $this->status        = BaseTestRunner::STATUS_FAILURE;
            $this->statusMessage = $e->getMessage();
        } catch (PredictionException $e) {
            $this->status        = BaseTestRunner::STATUS_FAILURE;
            $this->statusMessage = $e->getMessage();
        } catch (Throwable $_e) {
            $e = $_e;
        }

        // Clean up the mock objects.
        $this->mockObjects = [];
        $this->prophet     = null;

        // Tear down the fixture. An exception raised in tearDown() will be
        // caught and passed on when no exception was raised before.
        try {
            if ($hasMetRequirements) {
                foreach ($hookMethods['after'] as $method) {
                    $this->$method();
                }

                if ($this->inIsolation) {
                    foreach ($hookMethods['afterClass'] as $method) {
                        $this->$method();
                    }
                }
            }
        } catch (Throwable $_e) {
            if (!isset($e)) {
                $e = $_e;
            }
        }

        try {
            $this->stopOutputBuffering();
        } catch (RiskyTestError $_e) {
            if (!isset($e)) {
                $e = $_e;
            }
        }

        if (isset($_e)) {
            $this->status        = BaseTestRunner::STATUS_ERROR;
            $this->statusMessage = $_e->getMessage();
        }

        \clearstatcache();

        if ($currentWorkingDirectory != \getcwd()) {
            \chdir($currentWorkingDirectory);
        }

        $this->restoreGlobalState();
        $this->unregisterCustomComparators();
        $this->cleanupIniSettings();
        $this->cleanupLocaleSettings();

        // Perform assertion on output.
        if (!isset($e)) {
            try {
                if ($this->outputExpectedRegex !== null) {
                    $this->assertRegExp($this->outputExpectedRegex, $this->output);
                } elseif ($this->outputExpectedString !== null) {
                    $this->assertEquals($this->outputExpectedString, $this->output);
                }
            } catch (Throwable $_e) {
                $e = $_e;
            }
        }

        // Workaround for missing "finally".
        if (isset($e)) {
            if ($e instanceof PredictionException) {
                $e = new AssertionFailedError($e->getMessage());
            }

            $this->onNotSuccessfulTest($e);
        }
    }

    /**
     * Override to run the test and assert its state.
     *
     * @return mixed
     *
     * @throws Exception|Exception
     * @throws Exception
     */
    protected function runTest()
    {
        if ($this->name === null) {
            throw new Exception(
                'PHPUnit\Framework\TestCase::$name must not be null.'
            );
        }

        try {
            $class  = new ReflectionClass($this);
            $method = $class->getMethod($this->name);
        } catch (ReflectionException $e) {
            $this->fail($e->getMessage());
        }

        $testArguments = \array_merge($this->data, $this->dependencyInput);

        $this->registerMockObjectsFromTestArguments($testArguments);

        try {
            $testResult = $method->invokeArgs($this, $testArguments);
        } catch (Throwable $t) {
            $exception = $t;
        }

        if (isset($exception)) {
            if ($this->checkExceptionExpectations($exception)) {
                if ($this->expectedException !== null) {
                    $this->assertThat(
                        $exception,
                        new ExceptionConstraint(
                            $this->expectedException
                        )
                    );
                }

                if ($this->expectedExceptionMessage !== null) {
                    $this->assertThat(
                        $exception,
                        new ExceptionMessage(
                            $this->expectedExceptionMessage
                        )
                    );
                }

                if ($this->expectedExceptionMessageRegExp !== null) {
                    $this->assertThat(
                        $exception,
                        new ExceptionMessageRegularExpression(
                            $this->expectedExceptionMessageRegExp
                        )
                    );
                }

                if ($this->expectedExceptionCode !== null) {
                    $this->assertThat(
                        $exception,
                        new ExceptionCode(
                            $this->expectedExceptionCode
                        )
                    );
                }

                return;
            }

            throw $exception;
        }

        if ($this->expectedException !== null) {
            $this->assertThat(
                null,
                new ExceptionConstraint(
                    $this->expectedException
                )
            );
        } elseif ($this->expectedExceptionMessage !== null) {
            $this->numAssertions++;

            throw new AssertionFailedError(
                \sprintf(
                    'Failed asserting that exception with message "%s" is thrown',
                    $this->expectedExceptionMessage
                )
            );
        } elseif ($this->expectedExceptionMessageRegExp !== null) {
            $this->numAssertions++;

            throw new AssertionFailedError(
                \sprintf(
                    'Failed asserting that exception with message matching "%s" is thrown',
                    $this->expectedExceptionMessageRegExp
                )
            );
        } elseif ($this->expectedExceptionCode !== null) {
            $this->numAssertions++;

            throw new AssertionFailedError(
                \sprintf(
                    'Failed asserting that exception with code "%s" is thrown',
                    $this->expectedExceptionCode
                )
            );
        }

        return $testResult;
    }

    /**
     * Verifies the mock object expectations.
     */
    protected function verifyMockObjects()
    {
        foreach ($this->mockObjects as $mockObject) {
            if ($mockObject->__phpunit_hasMatchers()) {
                $this->numAssertions++;
            }

            $mockObject->__phpunit_verify(
                $this->shouldInvocationMockerBeReset($mockObject)
            );
        }

        if ($this->prophet !== null) {
            try {
                $this->prophet->checkPredictions();
            } catch (Throwable $t) {
                /* Intentionally left empty */
            }

            foreach ($this->prophet->getProphecies() as $objectProphecy) {
                foreach ($objectProphecy->getMethodProphecies() as $methodProphecies) {
                    foreach ($methodProphecies as $methodProphecy) {
                        $this->numAssertions += \count($methodProphecy->getCheckedPredictions());
                    }
                }
            }

            if (isset($t)) {
                throw $t;
            }
        }
    }

    /**
     * Sets the name of a TestCase.
     *
     * @param  string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Sets the dependencies of a TestCase.
     *
     * @param string[] $dependencies
     */
    public function setDependencies(array $dependencies)
    {
        $this->dependencies = $dependencies;
    }

    /**
     * Returns true if the tests has dependencies
     *
     * @return bool
     */
    public function hasDependencies()
    {
        return \count($this->dependencies) > 0;
    }

    /**
     * Sets
     *
     * @param array $dependencyInput
     */
    public function setDependencyInput(array $dependencyInput)
    {
        $this->dependencyInput = $dependencyInput;
    }

    /**
     * @param bool $beStrictAboutChangesToGlobalState
     */
    public function setBeStrictAboutChangesToGlobalState($beStrictAboutChangesToGlobalState)
    {
        $this->beStrictAboutChangesToGlobalState = $beStrictAboutChangesToGlobalState;
    }

    /**
     * Calling this method in setUp() has no effect!
     *
     * @param bool $backupGlobals
     */
    public function setBackupGlobals($backupGlobals)
    {
        if (null === $this->backupGlobals && \is_bool($backupGlobals)) {
            $this->backupGlobals = $backupGlobals;
        }
    }

    /**
     * Calling this method in setUp() has no effect!
     *
     * @param bool $backupStaticAttributes
     */
    public function setBackupStaticAttributes($backupStaticAttributes)
    {
        if (null === $this->backupStaticAttributes &&
            \is_bool($backupStaticAttributes)) {
            $this->backupStaticAttributes = $backupStaticAttributes;
        }
    }

    /**
     * @param bool $runTestInSeparateProcess
     *
     * @throws Exception
     */
    public function setRunTestInSeparateProcess($runTestInSeparateProcess)
    {
        if (\is_bool($runTestInSeparateProcess)) {
            if ($this->runTestInSeparateProcess === null) {
                $this->runTestInSeparateProcess = $runTestInSeparateProcess;
            }
        } else {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }
    }

    /**
     * @param bool $runClassInSeparateProcess
     *
     * @throws Exception
     */
    public function setRunClassInSeparateProcess($runClassInSeparateProcess)
    {
        if (\is_bool($runClassInSeparateProcess)) {
            if ($this->runClassInSeparateProcess === null) {
                $this->runClassInSeparateProcess = $runClassInSeparateProcess;
            }
        } else {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }
    }

    /**
     * @param bool $preserveGlobalState
     *
     * @throws Exception
     */
    public function setPreserveGlobalState($preserveGlobalState)
    {
        if (\is_bool($preserveGlobalState)) {
            $this->preserveGlobalState = $preserveGlobalState;
        } else {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }
    }

    /**
     * @param bool $inIsolation
     *
     * @throws Exception
     */
    public function setInIsolation($inIsolation)
    {
        if (\is_bool($inIsolation)) {
            $this->inIsolation = $inIsolation;
        } else {
            throw InvalidArgumentHelper::factory(1, 'boolean');
        }
    }

    /**
     * @return bool
     */
    public function isInIsolation()
    {
        return $this->inIsolation;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->testResult;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->testResult = $result;
    }

    /**
     * @param callable $callback
     *
     * @throws Exception
     */
    public function setOutputCallback($callback)
    {
        if (!\is_callable($callback)) {
            throw InvalidArgumentHelper::factory(1, 'callback');
        }

        $this->outputCallback = $callback;
    }

    /**
     * @return TestResult
     */
    public function getTestResultObject()
    {
        return $this->result;
    }

    /**
     * @param TestResult $result
     */
    public function setTestResultObject(TestResult $result)
    {
        $this->result = $result;
    }

    /**
     * @param MockObject $mockObject
     */
    public function registerMockObject(MockObject $mockObject)
    {
        $this->mockObjects[] = $mockObject;
    }

    /**
     * This method is a wrapper for the ini_set() function that automatically
     * resets the modified php.ini setting to its original value after the
     * test is run.
     *
     * @param string $varName
     * @param string $newValue
     *
     * @throws Exception
     */
    protected function iniSet($varName, $newValue)
    {
        if (!\is_string($varName)) {
            throw InvalidArgumentHelper::factory(1, 'string');
        }

        $currentValue = \ini_set($varName, $newValue);

        if ($currentValue !== false) {
            $this->iniSettings[$varName] = $currentValue;
        } else {
            throw new Exception(
                \sprintf(
                    'INI setting "%s" could not be set to "%s".',
                    $varName,
                    $newValue
                )
            );
        }
    }

    /**
     * This method is a wrapper for the setlocale() function that automatically
     * resets the locale to its original value after the test is run.
     *
     * @param int    $category
     * @param string $locale
     *
     * @throws Exception
     */
    protected function setLocale()
    {
        $args = \func_get_args();

        if (\count($args) < 2) {
            throw new Exception;
        }

        list($category, $locale) = $args;

        $categories = [
            LC_ALL, LC_COLLATE, LC_CTYPE, LC_MONETARY, LC_NUMERIC, LC_TIME
        ];

        if (\defined('LC_MESSAGES')) {
            $categories[] = LC_MESSAGES;
        }

        if (!\in_array($category, $categories)) {
            throw new Exception;
        }

        if (!\is_array($locale) && !\is_string($locale)) {
            throw new Exception;
        }

        $this->locale[$category] = \setlocale($category, 0);

        $result = \call_user_func_array('setlocale', $args);

        if ($result === false) {
            throw new Exception(
                'The locale functionality is not implemented on your platform, ' .
                'the specified locale does not exist or the category name is ' .
                'invalid.'
            );
        }
    }

    /**
     * Returns a builder object to create mock objects using a fluent interface.
     *
     * @param string|string[] $className
     *
     * @return MockBuilder
     */
    public function getMockBuilder($className)
    {
        return new MockBuilder($this, $className);
    }

    /**
     * Returns a test double for the specified class.
     *
     * @param string $originalClassName
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function createMock($originalClassName)
    {
        return $this->getMockBuilder($originalClassName)
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->disallowMockingUnknownTypes()
                    ->getMock();
    }

    /**
     * Returns a configured test double for the specified class.
     *
     * @param string $originalClassName
     * @param array  $configuration
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function createConfiguredMock($originalClassName, array $configuration)
    {
        $o = $this->createMock($originalClassName);

        foreach ($configuration as $method => $return) {
            $o->method($method)->willReturn($return);
        }

        return $o;
    }

    /**
     * Returns a partial test double for the specified class.
     *
     * @param string   $originalClassName
     * @param string[] $methods
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function createPartialMock($originalClassName, array $methods)
    {
        return $this->getMockBuilder($originalClassName)
                    ->disableOriginalConstructor()
                    ->disableOriginalClone()
                    ->disableArgumentCloning()
                    ->disallowMockingUnknownTypes()
                    ->setMethods(empty($methods) ? null : $methods)
                    ->getMock();
    }

    /**
     * Returns a test proxy for the specified class.
     *
     * @param string $originalClassName
     * @param array  $constructorArguments
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function createTestProxy($originalClassName, array $constructorArguments = [])
    {
        return $this->getMockBuilder($originalClassName)
                    ->setConstructorArgs($constructorArguments)
                    ->enableProxyingToOriginalMethods()
                    ->getMock();
    }

    /**
     * Mocks the specified class and returns the name of the mocked class.
     *
     * @param string $originalClassName
     * @param array  $methods
     * @param array  $arguments
     * @param string $mockClassName
     * @param bool   $callOriginalConstructor
     * @param bool   $callOriginalClone
     * @param bool   $callAutoload
     * @param bool   $cloneArguments
     *
     * @return string
     *
     * @throws Exception
     */
    protected function getMockClass($originalClassName, $methods = [], array $arguments = [], $mockClassName = '', $callOriginalConstructor = false, $callOriginalClone = true, $callAutoload = true, $cloneArguments = false)
    {
        $mock = $this->getMockObjectGenerator()->getMock(
            $originalClassName,
            $methods,
            $arguments,
            $mockClassName,
            $callOriginalConstructor,
            $callOriginalClone,
            $callAutoload,
            $cloneArguments
        );

        return \get_class($mock);
    }

    /**
     * Returns a mock object for the specified abstract class with all abstract
     * methods of the class mocked. Concrete methods are not mocked by default.
     * To mock concrete methods, use the 7th parameter ($mockedMethods).
     *
     * @param string $originalClassName
     * @param array  $arguments
     * @param string $mockClassName
     * @param bool   $callOriginalConstructor
     * @param bool   $callOriginalClone
     * @param bool   $callAutoload
     * @param array  $mockedMethods
     * @param bool   $cloneArguments
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function getMockForAbstractClass($originalClassName, array $arguments = [], $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = [], $cloneArguments = false)
    {
        $mockObject = $this->getMockObjectGenerator()->getMockForAbstractClass(
            $originalClassName,
            $arguments,
            $mockClassName,
            $callOriginalConstructor,
            $callOriginalClone,
            $callAutoload,
            $mockedMethods,
            $cloneArguments
        );

        $this->registerMockObject($mockObject);

        return $mockObject;
    }

    /**
     * Returns a mock object based on the given WSDL file.
     *
     * @param string $wsdlFile
     * @param string $originalClassName
     * @param string $mockClassName
     * @param array  $methods
     * @param bool   $callOriginalConstructor
     * @param array  $options                 An array of options passed to SOAPClient::_construct
     *
     * @return MockObject
     */
    protected function getMockFromWsdl($wsdlFile, $originalClassName = '', $mockClassName = '', array $methods = [], $callOriginalConstructor = true, array $options = [])
    {
        if ($originalClassName === '') {
            $fileName          = \pathinfo(\basename(\parse_url($wsdlFile)['path']), PATHINFO_FILENAME);
            $originalClassName = \preg_replace('/[^a-zA-Z0-9_]/', '', $fileName);
        }

        if (!\class_exists($originalClassName)) {
            eval(
                $this->getMockObjectGenerator()->generateClassFromWsdl(
                    $wsdlFile,
                    $originalClassName,
                    $methods,
                    $options
                )
            );
        }

        $mockObject = $this->getMockObjectGenerator()->getMock(
            $originalClassName,
            $methods,
            ['', $options],
            $mockClassName,
            $callOriginalConstructor,
            false,
            false
        );

        $this->registerMockObject($mockObject);

        return $mockObject;
    }

    /**
     * Returns a mock object for the specified trait with all abstract methods
     * of the trait mocked. Concrete methods to mock can be specified with the
     * `$mockedMethods` parameter.
     *
     * @param string $traitName
     * @param array  $arguments
     * @param string $mockClassName
     * @param bool   $callOriginalConstructor
     * @param bool   $callOriginalClone
     * @param bool   $callAutoload
     * @param array  $mockedMethods
     * @param bool   $cloneArguments
     *
     * @return MockObject
     *
     * @throws Exception
     */
    protected function getMockForTrait($traitName, array $arguments = [], $mockClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true, $mockedMethods = [], $cloneArguments = false)
    {
        $mockObject = $this->getMockObjectGenerator()->getMockForTrait(
            $traitName,
            $arguments,
            $mockClassName,
            $callOriginalConstructor,
            $callOriginalClone,
            $callAutoload,
            $mockedMethods,
            $cloneArguments
        );

        $this->registerMockObject($mockObject);

        return $mockObject;
    }

    /**
     * Returns an object for the specified trait.
     *
     * @param string $traitName
     * @param array  $arguments
     * @param string $traitClassName
     * @param bool   $callOriginalConstructor
     * @param bool   $callOriginalClone
     * @param bool   $callAutoload
     *
     * @return object
     *
     * @throws Exception
     */
    protected function getObjectForTrait($traitName, array $arguments = [], $traitClassName = '', $callOriginalConstructor = true, $callOriginalClone = true, $callAutoload = true)
    {
        return $this->getMockObjectGenerator()->getObjectForTrait(
            $traitName,
            $arguments,
            $traitClassName,
            $callOriginalConstructor,
            $callOriginalClone,
            $callAutoload
        );
    }

    /**
     * @param string|null $classOrInterface
     *
     * @return \Prophecy\Prophecy\ObjectProphecy
     *
     * @throws \LogicException
     */
    protected function prophesize($classOrInterface = null)
    {
        return $this->getProphet()->prophesize($classOrInterface);
    }

    /**
     * Adds a value to the assertion counter.
     *
     * @param int $count
     */
    public function addToAssertionCount($count)
    {
        $this->numAssertions += $count;
    }

    /**
     * Returns the number of assertions performed by this test.
     *
     * @return int
     */
    public function getNumAssertions()
    {
        return $this->numAssertions;
    }

    /**
     * Returns a matcher that matches when the method is executed
     * zero or more times.
     *
     * @return AnyInvokedCountMatcher
     */
    public static function any()
    {
        return new AnyInvokedCountMatcher;
    }

    /**
     * Returns a matcher that matches when the method is never executed.
     *
     * @return InvokedCountMatcher
     */
    public static function never()
    {
        return new InvokedCountMatcher(0);
    }

    /**
     * Returns a matcher that matches when the method is executed
     * at least N times.
     *
     * @param int $requiredInvocations
     *
     * @return InvokedAtLeastCountMatcher
     */
    public static function atLeast($requiredInvocations)
    {
        return new InvokedAtLeastCountMatcher(
            $requiredInvocations
        );
    }

    /**
     * Returns a matcher that matches when the method is executed at least once.
     *
     * @return InvokedAtLeastOnceMatcher
     */
    public static function atLeastOnce()
    {
        return new InvokedAtLeastOnceMatcher;
    }

    /**
     * Returns a matcher that matches when the method is executed exactly once.
     *
     * @return InvokedCountMatcher
     */
    public static function once()
    {
        return new InvokedCountMatcher(1);
    }

    /**
     * Returns a matcher that matches when the method is executed
     * exactly $count times.
     *
     * @param int $count
     *
     * @return InvokedCountMatcher
     */
    public static function exactly($count)
    {
        return new InvokedCountMatcher($count);
    }

    /**
     * Returns a matcher that matches when the method is executed
     * at most N times.
     *
     * @param int $allowedInvocations
     *
     * @return InvokedAtMostCountMatcher
     */
    public static function atMost($allowedInvocations)
    {
        return new InvokedAtMostCountMatcher($allowedInvocations);
    }

    /**
     * Returns a matcher that matches when the method is executed
     * at the given index.
     *
     * @param int $index
     *
     * @return InvokedAtIndexMatcher
     */
    public static function at($index)
    {
        return new InvokedAtIndexMatcher($index);
    }

    /**
     * @param mixed $value
     *
     * @return ReturnStub
     */
    public static function returnValue($value)
    {
        return new ReturnStub($value);
    }

    /**
     * @param array $valueMap
     *
     * @return ReturnValueMapStub
     */
    public static function returnValueMap(array $valueMap)
    {
        return new ReturnValueMapStub($valueMap);
    }

    /**
     * @param int $argumentIndex
     *
     * @return ReturnArgumentStub
     */
    public static function returnArgument($argumentIndex)
    {
        return new ReturnArgumentStub($argumentIndex);
    }

    /**
     * @param mixed $callback
     *
     * @return ReturnCallbackStub
     */
    public static function returnCallback($callback)
    {
        return new ReturnCallbackStub($callback);
    }

    /**
     * Returns the current object.
     *
     * This method is useful when mocking a fluent interface.
     *
     * @return ReturnSelfStub
     */
    public static function returnSelf()
    {
        return new ReturnSelfStub;
    }

    /**
     * @param Throwable $exception
     *
     * @return ExceptionStub
     */
    public static function throwException(Throwable $exception)
    {
        return new ExceptionStub($exception);
    }

    /**
     * @param mixed $value , ...
     *
     * @return ConsecutiveCallsStub
     */
    public static function onConsecutiveCalls()
    {
        $args = \func_get_args();

        return new ConsecutiveCallsStub($args);
    }

    /**
     * @return bool
     */
    public function usesDataProvider()
    {
        return !empty($this->data);
    }

    /**
     * @return string
     */
    public function dataDescription()
    {
        return \is_string($this->dataName) ? $this->dataName : '';
    }

    /**
     * @return int|string
     */
    public function dataName()
    {
        return $this->dataName;
    }

    public function registerComparator(Comparator $comparator)
    {
        ComparatorFactory::getInstance()->register($comparator);

        $this->customComparators[] = $comparator;
    }

    /**
     * Gets the data set description of a TestCase.
     *
     * @param bool $includeData
     *
     * @return string
     */
    public function getDataSetAsString($includeData = true)
    {
        $buffer = '';

        if (!empty($this->data)) {
            if (\is_int($this->dataName)) {
                $buffer .= \sprintf(' with data set #%d', $this->dataName);
            } else {
                $buffer .= \sprintf(' with data set "%s"', $this->dataName);
            }

            $exporter = new Exporter;

            if ($includeData) {
                $buffer .= \sprintf(' (%s)', $exporter->shortenedRecursiveExport($this->data));
            }
        }

        return $buffer;
    }

    /**
     * Gets the data set of a TestCase.
     *
     * @return array
     */
    protected function getProvidedData()
    {
        return $this->data;
    }

    /**
     * Creates a default TestResult object.
     *
     * @return TestResult
     */
    protected function createResult()
    {
        return new TestResult;
    }

    protected function handleDependencies()
    {
        if (!empty($this->dependencies) && !$this->inIsolation) {
            $className  = \get_class($this);
            $passed     = $this->result->passed();
            $passedKeys = \array_keys($passed);
            $numKeys    = \count($passedKeys);

            for ($i = 0; $i < $numKeys; $i++) {
                $pos = \strpos($passedKeys[$i], ' with data set');

                if ($pos !== false) {
                    $passedKeys[$i] = \substr($passedKeys[$i], 0, $pos);
                }
            }

            $passedKeys = \array_flip(\array_unique($passedKeys));

            foreach ($this->dependencies as $dependency) {
                $deepClone    = false;
                $shallowClone = false;

                if (\strpos($dependency, 'clone ') === 0) {
                    $deepClone  = true;
                    $dependency = \substr($dependency, \strlen('clone '));
                } elseif (\strpos($dependency, '!clone ') === 0) {
                    $deepClone  = false;
                    $dependency = \substr($dependency, \strlen('!clone '));
                }

                if (\strpos($dependency, 'shallowClone ') === 0) {
                    $shallowClone = true;
                    $dependency   = \substr($dependency, \strlen('shallowClone '));
                } elseif (\strpos($dependency, '!shallowClone ') === 0) {
                    $shallowClone = false;
                    $dependency   = \substr($dependency, \strlen('!shallowClone '));
                }

                if (\strpos($dependency, '::') === false) {
                    $dependency = $className . '::' . $dependency;
                }

                if (!isset($passedKeys[$dependency])) {
                    $this->result->startTest($this);
                    $this->result->addError(
                        $this,
                        new SkippedTestError(
                            \sprintf(
                                'This test depends on "%s" to pass.',
                                $dependency
                            )
                        ),
                        0
                    );
                    $this->result->endTest($this, 0);

                    return false;
                }

                if (isset($passed[$dependency])) {
                    if ($passed[$dependency]['size'] != \PHPUnit\Util\Test::UNKNOWN &&
                        $this->getSize() != \PHPUnit\Util\Test::UNKNOWN &&
                        $passed[$dependency]['size'] > $this->getSize()) {
                        $this->result->addError(
                            $this,
                            new SkippedTestError(
                                'This test depends on a test that is larger than itself.'
                            ),
                            0
                        );

                        return false;
                    }

                    if ($deepClone) {
                        $deepCopy = new DeepCopy;
                        $deepCopy->skipUncloneable(false);

                        $this->dependencyInput[$dependency] = $deepCopy->copy($passed[$dependency]['result']);
                    } elseif ($shallowClone) {
                        $this->dependencyInput[$dependency] = clone $passed[$dependency]['result'];
                    } else {
                        $this->dependencyInput[$dependency] = $passed[$dependency]['result'];
                    }
                } else {
                    $this->dependencyInput[$dependency] = null;
                }
            }
        }

        return true;
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called before the execution of a test starts
     * and after setUp() is called.
     */
    protected function assertPreConditions()
    {
    }

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called after the execution of a test ends
     * and before tearDown() is called.
     */
    protected function assertPostConditions()
    {
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * This method is called when a test method did not execute successfully.
     *
     * @param Throwable $t
     *
     * @throws Throwable
     */
    protected function onNotSuccessfulTest(Throwable $t)
    {
        throw $t;
    }

    /**
     * Performs custom preparations on the process isolation template.
     *
     * @param Text_Template $template
     */
    protected function prepareTemplate(Text_Template $template)
    {
    }

    /**
     * Get the mock object generator, creating it if it doesn't exist.
     *
     * @return MockGenerator
     */
    private function getMockObjectGenerator()
    {
        if (null === $this->mockObjectGenerator) {
            $this->mockObjectGenerator = new MockGenerator;
        }

        return $this->mockObjectGenerator;
    }

    private function startOutputBuffering()
    {
        \ob_start();

        $this->outputBufferingActive = true;
        $this->outputBufferingLevel  = \ob_get_level();
    }

    private function stopOutputBuffering()
    {
        if (\ob_get_level() != $this->outputBufferingLevel) {
            while (\ob_get_level() >= $this->outputBufferingLevel) {
                \ob_end_clean();
            }

            throw new RiskyTestError(
                'Test code or tested code did not (only) close its own output buffers'
            );
        }

        $output = \ob_get_contents();

        if ($this->outputCallback === false) {
            $this->output = $output;
        } else {
            $this->output = \call_user_func_array(
                $this->outputCallback,
                [$output]
            );
        }

        \ob_end_clean();

        $this->outputBufferingActive = false;
        $this->outputBufferingLevel  = \ob_get_level();
    }

    private function snapshotGlobalState()
    {
        if ($this->runTestInSeparateProcess ||
            $this->inIsolation ||
            (!$this->backupGlobals === true && !$this->backupStaticAttributes)) {
            return;
        }

        $this->snapshot = $this->createGlobalStateSnapshot($this->backupGlobals === true);
    }

    private function restoreGlobalState()
    {
        if (!$this->snapshot instanceof Snapshot) {
            return;
        }

        if ($this->beStrictAboutChangesToGlobalState) {
            try {
                $this->compareGlobalStateSnapshots(
                    $this->snapshot,
                    $this->createGlobalStateSnapshot($this->backupGlobals === true)
                );
            } catch (RiskyTestError $rte) {
                // Intentionally left empty
            }
        }

        $restorer = new Restorer;

        if ($this->backupGlobals === true) {
            $restorer->restoreGlobalVariables($this->snapshot);
        }

        if ($this->backupStaticAttributes) {
            $restorer->restoreStaticAttributes($this->snapshot);
        }

        $this->snapshot = null;

        if (isset($rte)) {
            throw $rte;
        }
    }

    /**
     * @param bool $backupGlobals
     *
     * @return Snapshot
     */
    private function createGlobalStateSnapshot($backupGlobals)
    {
        $blacklist = new Blacklist;

        foreach ($this->backupGlobalsBlacklist as $globalVariable) {
            $blacklist->addGlobalVariable($globalVariable);
        }

        if (!\defined('PHPUNIT_TESTSUITE')) {
            $blacklist->addClassNamePrefix('PHPUnit');
            $blacklist->addClassNamePrefix('File_Iterator');
            $blacklist->addClassNamePrefix('SebastianBergmann\CodeCoverage');
            $blacklist->addClassNamePrefix('PHP_Invoker');
            $blacklist->addClassNamePrefix('PHP_Timer');
            $blacklist->addClassNamePrefix('PHP_Token');
            $blacklist->addClassNamePrefix('Symfony');
            $blacklist->addClassNamePrefix('Text_Template');
            $blacklist->addClassNamePrefix('Doctrine\Instantiator');
            $blacklist->addClassNamePrefix('Prophecy');

            foreach ($this->backupStaticAttributesBlacklist as $class => $attributes) {
                foreach ($attributes as $attribute) {
                    $blacklist->addStaticAttribute($class, $attribute);
                }
            }
        }

        return new Snapshot(
            $blacklist,
            $backupGlobals,
            (bool) $this->backupStaticAttributes,
            false,
            false,
            false,
            false,
            false,
            false,
            false
        );
    }

    /**
     * @param Snapshot $before
     * @param Snapshot $after
     *
     * @throws RiskyTestError
     */
    private function compareGlobalStateSnapshots(Snapshot $before, Snapshot $after)
    {
        $backupGlobals = $this->backupGlobals === null || $this->backupGlobals === true;

        if ($backupGlobals) {
            $this->compareGlobalStateSnapshotPart(
                $before->globalVariables(),
                $after->globalVariables(),
                "--- Global variables before the test\n+++ Global variables after the test\n"
            );

            $this->compareGlobalStateSnapshotPart(
                $before->superGlobalVariables(),
                $after->superGlobalVariables(),
                "--- Super-global variables before the test\n+++ Super-global variables after the test\n"
            );
        }

        if ($this->backupStaticAttributes) {
            $this->compareGlobalStateSnapshotPart(
                $before->staticAttributes(),
                $after->staticAttributes(),
                "--- Static attributes before the test\n+++ Static attributes after the test\n"
            );
        }
    }

    /**
     * @param array  $before
     * @param array  $after
     * @param string $header
     *
     * @throws RiskyTestError
     */
    private function compareGlobalStateSnapshotPart(array $before, array $after, $header)
    {
        if ($before != $after) {
            $differ   = new Differ($header);
            $exporter = new Exporter;

            $diff = $differ->diff(
                $exporter->export($before),
                $exporter->export($after)
            );

            throw new RiskyTestError(
                $diff
            );
        }
    }

    /**
     * @return Prophecy\Prophet
     */
    private function getProphet()
    {
        if ($this->prophet === null) {
            $this->prophet = new Prophet;
        }

        return $this->prophet;
    }

    /**
     * @param MockObject $mock
     *
     * @return bool
     */
    private function shouldInvocationMockerBeReset(MockObject $mock)
    {
        $enumerator = new Enumerator;

        foreach ($enumerator->enumerate($this->dependencyInput) as $object) {
            if ($mock === $object) {
                return false;
            }
        }

        if (!\is_array($this->testResult) && !\is_object($this->testResult)) {
            return true;
        }

        foreach ($enumerator->enumerate($this->testResult) as $object) {
            if ($mock === $object) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $testArguments
     * @param array $visited
     */
    private function registerMockObjectsFromTestArguments(array $testArguments, array &$visited = [])
    {
        if ($this->registerMockObjectsFromTestArgumentsRecursively) {
            $enumerator = new Enumerator;

            foreach ($enumerator->enumerate($testArguments) as $object) {
                if ($object instanceof MockObject) {
                    $this->registerMockObject($object);
                }
            }
        } else {
            foreach ($testArguments as $testArgument) {
                if ($testArgument instanceof MockObject) {
                    if ($this->isCloneable($testArgument)) {
                        $testArgument = clone $testArgument;
                    }

                    $this->registerMockObject($testArgument);
                } elseif (\is_array($testArgument) && !\in_array($testArgument, $visited, true)) {
                    $visited[] = $testArgument;

                    $this->registerMockObjectsFromTestArguments(
                        $testArgument,
                        $visited
                    );
                }
            }
        }
    }

    private function setDoesNotPerformAssertionsFromAnnotation()
    {
        $annotations = $this->getAnnotations();

        if (isset($annotations['method']['doesNotPerformAssertions'])) {
            $this->doesNotPerformAssertions = true;
        }
    }

    /**
     * @param MockObject $testArgument
     *
     * @return bool
     */
    private function isCloneable(MockObject $testArgument)
    {
        $reflector = new ReflectionObject($testArgument);

        if (!$reflector->isCloneable()) {
            return false;
        }

        if ($reflector->hasMethod('__clone') &&
            $reflector->getMethod('__clone')->isPublic()) {
            return true;
        }

        return false;
    }

    private function unregisterCustomComparators()
    {
        $factory = ComparatorFactory::getInstance();

        foreach ($this->customComparators as $comparator) {
            $factory->unregister($comparator);
        }

        $this->customComparators = [];
    }

    private function cleanupIniSettings()
    {
        foreach ($this->iniSettings as $varName => $oldValue) {
            \ini_set($varName, $oldValue);
        }

        $this->iniSettings = [];
    }

    private function cleanupLocaleSettings()
    {
        foreach ($this->locale as $category => $locale) {
            \setlocale($category, $locale);
        }

        $this->locale = [];
    }

    private function checkExceptionExpectations(Throwable $throwable): bool
    {
        $result = false;

        if ($this->expectedException !== null || $this->expectedExceptionCode !== null || $this->expectedExceptionMessage !== null || $this->expectedExceptionMessageRegExp !== null) {
            $result = true;
        }

        if ($throwable instanceof Exception) {
            $result = false;
        }

        if (\is_string($this->expectedException)) {
            $reflector = new ReflectionClass($this->expectedException);

            if ($this->expectedException === 'PHPUnit\Framework\Exception' ||
                $this->expectedException === '\PHPUnit\Framework\Exception' ||
                $reflector->isSubclassOf('PHPUnit\Framework\Exception')) {
                $result = true;
            }
        }

        return $result;
    }
}
