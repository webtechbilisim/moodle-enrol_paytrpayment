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
 * Strings for component 'enrol_paytrpayment', language 'en'.
 *
 * @package    enrol_paytrpayment
 * @copyright  2019 Dualcube Team
 * @copyright  2021 WebTech Bilişim
 * @license    http://www.gnu.org/licenses/agpl-3.0.html GNU AGPL v3 or later
 */

$string['assignrole'] = 'Assign role';

$string['merchant_id'] = 'PayTR Merchant ID';
$string['merchant_id_desc'] = 'The Merchant ID of PayTR account';
$string['merchant_key'] = 'PayTR Merchant Key';
$string['merchant_key_desc'] = 'The Merchant Key of PayTR account';
$string['merchant_salt_key'] = 'PayTR Salt Key';
$string['merchant_salt_key_desc'] = 'The API Salt Key of PayTR account';
$string['sandboxmode'] = 'PayTR Sandbox Mode';
$string['sandboxmode_desc'] = 'Use PayTR Sandbox Mode for debugging';
$string['cost'] = 'Enrol cost';
$string['costerror'] = 'The enrolment cost is not numeric';
$string['costorkey'] = 'Please choose one of the following methods of enrolment.';
$string['currency'] = 'Currency';
$string['defaultrole'] = 'Default role assignment';
$string['defaultrole_desc'] = 'Select role which should be assigned to users during PayTR enrolments';
$string['enrolenddate'] = 'End date';
$string['enrolenddate_help'] = 'If enabled, users can be enrolled until this date only.';
$string['enrolenddaterror'] = 'Enrolment end date cannot be earlier than start date';
$string['enrolperiod'] = 'Enrolment duration';
$string['enrolperiod_desc'] = 'Default length of time that the enrolment is valid. If set to zero, the enrolment duration will be unlimited by default.';
$string['enrolperiod_help'] = 'Length of time that the enrolment is valid, starting with the moment the user is enrolled. If disabled, the enrolment duration will be unlimited.';
$string['enrolstartdate'] = 'Start date';
$string['enrolstartdate_help'] = 'If enabled, users can be enrolled from this date onward only.';
$string['expiredaction'] = 'Enrolment expiration action';
$string['expiredaction_help'] = 'Select action to carry out when user enrolment expires. Please note that some user data and settings are purged from course during course unenrolment.';
$string['mailadmins'] = 'Notify admin';
$string['mailstudents'] = 'Notify students';
$string['mailteachers'] = 'Notify teachers';
$string['messageprovider:paytr_enrolment'] = 'PayTR enrolment messages';
$string['nocost'] = 'There is no cost associated with enrolling in this course!';
$string['paytr:config'] = 'Configure PayTR enrol instances';
$string['paytr:manage'] = 'Manage enrolled users';
$string['paytr:unenrol'] = 'Unenrol users from course';
$string['paytr:unenrolself'] = 'Unenrol self from the course';
$string['paytraccepted'] = 'PayTR payments accepted';
$string['pluginname'] = 'PayTR Payment';
$string['pluginname_desc'] = 'The PayTR module allows you to set up paid courses.  If the cost for any course is zero, then students are not asked to pay for entry.  There is a site-wide cost that you set here as a default for the whole site and then a course setting that you can set for each course individually. The course cost overrides the site cost.';
$string['sendpaymentbutton'] = 'Send payment via PayTR';
$string['status'] = 'Allow PayTR enrolments';
$string['status_desc'] = 'Allow users to use PayTR to enrol into a course by default.';
$string['unenrolselfconfirm'] = 'Do you really want to unenrol yourself from course "{$a}"?';
$string['messageprovider:paytrpayment_enrolment'] = 'Message Provider';

$string['maxenrolled'] = 'Max enrolled users';
$string['maxenrolled_help'] = 'Specifies the maximum number of users that can paytr payment enrol. 0 means no limit.';
$string['maxenrolledreached'] = 'Maximum number of users allowed to paytr payment-enrol was already reached.';

$string['canntenrol'] = 'Enrolment is disabled or inactive';
$string['paytrpayment:config'] = 'Configure paytr payment';
$string['paytrpayment:manage'] = 'Manage paytr payment';
$string['paytrpayment:unenrol'] = 'Unenrol paytr payment';
$string['paytrpayment:unenrolself'] = 'Unenrolself paytr payment';

$string['charge_description1'] = "create customer for email receipt";
$string['charge_description2'] = 'Charge for Course Enrolment Cost.';

$string['paytr_sorry'] = "Sorry, you can not use the script that way.";
$string['newcost'] = 'New Cost';
$string['couponcode'] = 'Coupon Code';
$string['applycode'] = 'Apply Code';
$string['invalidcouponcode'] = 'Invalid Coupon Code';
$string['invalidcouponcodevalue'] = 'Coupon Code {$a} is not valid!';
$string['enrol'] = 'Enrol';
