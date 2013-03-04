<?php
/**
 *  Base include file for SimpleTest.
 *  @package    SimpleTest
 *  @subpackage WebTester
 *  @version    $Id: selector.php 1723 2008-04-08 00:34:10Z lastcraft $
 */

/**#@+
 * include SimpleTest files
 */
require_once(dirname(__FILE__) . '/tag.php');
require_once(dirname(__FILE__) . '/encoding.php');
/**#@-*/

/**
 *    Used to extract form elements for testing against.
 *    Searches by name attribute.
 *    @package SimpleTest
 *    @subpackage WebTester
*/
class SimpleByName {
	var $_name;

	/**
	 *    Stashes the name for later comparison.
	 *    @param string $name     Name attribute to match.
	 */
	function __construct($name) {
		$this->_name = $name;
	}

	function getName() {
		return $this->_name;
	}

	/**
	 *    Compares with name attribute of widget.
	 *    @param SimpleWidget $widget    Control to compare.
	 *    @access public
	 */
	function isMatch($widget) {
		return ($widget->getName() == $this->_name);
	}
}

/**
 *    Used to extract form elements for testing against.
 *    Searches by visible label or alt text.
 *    @package SimpleTest
 *    @subpackage WebTester
 */
class SimpleByLabel {
	var $_label;

	/**
	 *    Stashes the name for later comparison.
	 *    @param string $label     Visible text to match.
	 */
	function __construct($label) {
		$this->_label = $label;
	}

	/**
	 *    Comparison. Compares visible text of widget or
	 *    related label.
	 *    @param SimpleWidget $widget    Control to compare.
	 *    @access public
	 */
	function isMatch($widget) {
		if (! method_exists($widget, 'isLabel')) {
			return false;
		}
		return $widget->isLabel($this->_label);
	}
}

/**
 *    Used to extract form elements for testing against.
 *    Searches dy id attribute.
 *    @package SimpleTest
 *    @subpackage WebTester
 */
class SimpleById {
	var $_id;

	/**
	 *    Stashes the name for later comparison.
	 *    @param string $id     ID atribute to match.
	 */
	function __construct($id) {
		$this->_id = $id;
	}

	/**
	 *    Comparison. Compares id attribute of widget.
	 *    @param SimpleWidget $widget    Control to compare.
	 *    @access public
	 */
	function isMatch($widget) {
		return $widget->isId($this->_id);
	}
}

/**
 *    Used to extract form elements for testing against.
 *    Searches by visible label, name or alt text.
 *    @package SimpleTest
 *    @subpackage WebTester
 */
class SimpleByLabelOrName {
	var $_label;

	/**
	 *    Stashes the name/label for later comparison.
	 *    @param string $label     Visible text to match.
	 */
	function __construct($label) {
		$this->_label = $label;
	}

	/**
	 *    Comparison. Compares visible text of widget or
	 *    related label or name.
	 *    @param SimpleWidget $widget    Control to compare.
	 *    @access public
	 */
	function isMatch($widget) {
		if (method_exists($widget, 'isLabel')) {
			if ($widget->isLabel($this->_label)) {
				return true;
			}
		}
		return ($widget->getName() == $this->_label);
	}
}
?>
