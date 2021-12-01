<?php
App::uses('Username', 'Model');

/**
 * Username Test Case
 */
class UsernameTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.username'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Username = ClassRegistry::init('Username');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Username);

		parent::tearDown();
	}

}
