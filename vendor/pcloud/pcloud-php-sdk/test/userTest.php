<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

	public function setUp() {
		pCloud\Config::$curllib = "pCloud\TestCurl";
		$this->instance = new pCloud\User();
	}

	public function tearDown() {
		unset($this->instance);
	}

	public function testUserInfo() {
		$expected = pCloud\Config::$host."userinfo";
		$query = $this->instance->getUserInfo();

		$this->assertEquals($expected, $query);
	}
}