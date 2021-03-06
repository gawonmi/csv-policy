<?php

namespace Zumba\CsvPolicy\Test\Rule;

use \Zumba\CsvPolicy\Test\TestCase;

/**
 * @group rule
 */
class RuleTest extends TestCase {

	public function setUp() {
		$this->rule = $this->getMock('\\Zumba\\CsvPolicy\\Rule', array('validationLogic'));
	}

	public function testValidateMethodTracksTokens() {
		$this->rule->validate('a');
		$this->rule->validate('b');
		$this->rule->validate('c');

		$this->assertEquals(['a', 'b', 'c'], $this->rule->getTokens());
	}

	public function testValidateCallsValidationLogic(){
		$once = $this->atLeastOnce();
		$return = $this->returnValue(true);
		$this->rule->expects($once)->method('validationLogic')->will($return);

		$this->rule->validate('a');
	}

	public function testGetErrorMessageReturnsString(){
		$this->assertTrue(gettype($this->rule->getErrorMessage('explode')) === 'string');
	}
}