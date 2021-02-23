<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * PayTR enrolment plugin version specification.
 *
 * @package    enrol_paytrpayment
 * @copyright  2019 Dualcube Team
 * @copyright  2021 WebTech Bilisim
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Disable moodle specific debug messages and any errors in output,
// comment out when debugging or better look into error log!


defined('MOODLE_INTERNAL') || die();
global $CFG, $USER;

/**
 * Generate a random string, using a cryptographically secure 
 * pseudorandom number generator (random_int)
 *
 * This function uses type hints now (PHP 7+ only), but it was originally
 * written for PHP 5 as well.
 * 
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 * 
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */

//  PayTR START

require_once "paytr-lib/paytr.php";

$paytr = new PayTr(); 
  
  // SET IMPORTANT INFORMATION
  
  $paytr->setMerchantId($this->get_config('merchant_id'));                                          
  $paytr->setMerchantKey($this->get_config('merchant_key'));                                        
  $paytr->setMerchantSalt($this->get_config('merchant_salt_key'));                                  
  $paytr->setEmail($USER->email);   
  $paytr->setTestMode($this->get_config('sandboxmode'));                                                               
  $paytr->setPaymentAmount($cost);                                                                  
  $paytr->setUserName($USER->firstname . " " . $USER->lastname); 
  $paytr->setMerchantOrderIdByVal($USER->id . "S" . $course->id . "S" . $instance->id . "S" . rand(1111111111111111,999999999999999999));
  if ($USER->address!="" && $USER->city!="" && $USER->country!="")
  {
	  $paytr->setAddress($USER->address . " " . $USER->city . " " . $USER->country);  
  }               
  // Create Basket
  $Basket = array (
    "name"     => $coursefullname,
    "price"    => $cost,
    "currency" => $instance->currency
  );
  $paytr->setBasket($Basket);  
  $paytr->setCurrency($instance->currency);
  $paytr->setSuccessUrl($CFG->wwwroot."/course/view.php?id=".$course->id);   // example: https://example.com/succsess.php
  $paytr->setFailUrl($CFG->wwwroot."/course/view.php?id=".$course->id);      // example: https://example.com/fail.php
  $paytr->initialize();
  $token = $paytr->token;
?>

<script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
<iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token;?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
<script>iFrameResize({},'#paytriframe');</script>
