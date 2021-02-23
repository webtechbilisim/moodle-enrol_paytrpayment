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

/**e
 * PayTR enrolment plugin version specification.
 *
 * @package    enrol_paytrpayment
 * @copyright  2019 Dualcube Team
 * @copyright  2021 WebTech Bilisim
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Disable moodle specific debug messages and any errors in output,
// comment out when debugging or better look into error log!
define('NO_DEBUG_DISPLAY', true);

require("../../config.php");
require_once("lib.php");
require_once($CFG->libdir . '/enrollib.php');
require_once($CFG->libdir . '/filelib.php');

$post = $_POST;
//require_login();

/**
 * Send payment error message to the admin.
 *
 * @param string $subject
 * @param stdClass $data
 */
	function message_paytrpayment_error_to_admin($subject, $data)
	{
		die($subject);
		$admin = get_admin();
		$site = get_site();

		$message = "$site->fullname:  Transaction failed.\n\n$subject\n\n";

		foreach ($data as $key => $value) {
			$message .= s($key) . " => " . s($value) . "\n";
		}

		$subject = "PayTR PAYMENT ERROR: " . $subject;
		$fullmessage = $message;
		$fullmessagehtml = html_to_text('<p>' . $message . '</p>');

		// Send test email.
		ob_start();
		$success = email_to_user($admin, $admin, $subject, $fullmessage, $fullmessagehtml);
		$smtplog = ob_get_contents();
		ob_end_clean();
	}

	$data = [];
	$plugin = enrol_get_plugin('paytrpayment');
	## 2. ADIM için örnek kodlar ##

	## ÖNEMLİ UYARILAR ##
	## 1) Bu sayfaya oturum (SESSION) ile veri taşıyamazsınız. Çünkü bu sayfa müşterilerin yönlendirildiği bir sayfa değildir.
	## 2) Entegrasyonun 1. ADIM'ında gönderdiğniz merchant_oid değeri bu sayfaya POST ile gelir. Bu değeri kullanarak
	## veri tabanınızdan ilgili siparişi tespit edip onaylamalı veya iptal etmelisiniz.
	## 3) Aynı sipariş için birden fazla bildirim ulaşabilir (Ağ bağlantı sorunları vb. nedeniyle). Bu nedenle öncelikle
	## siparişin durumunu veri tabanınızdan kontrol edin, eğer onaylandıysa tekrar işlem yapmayın. Örneği aşağıda bulunmaktadır.

	

	####################### DÜZENLEMESİ ZORUNLU ALANLAR #######################
	#
	## API Entegrasyon Bilgileri - Mağaza paneline giriş yaparak BİLGİ sayfasından alabilirsiniz.
	$merchant_key 	= $plugin->get_config('merchant_key');
	$merchant_salt	= $plugin->get_config('merchant_salt_key');
	###########################################################################

	####### Bu kısımda herhangi bir değişiklik yapmanıza gerek yoktur. #######
	#
	## POST değerleri ile hash oluştur.
	$hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );
	#
	## Oluşturulan hash'i, paytr'dan gelen post içindeki hash ile karşılaştır (isteğin paytr'dan geldiğine ve değişmediğine emin olmak için)
	## Bu işlemi yapmazsanız maddi zarara uğramanız olasıdır.
	if( $hash != $post['hash'] )
		die('PAYTR Notification Failed: Bad Hash');
	###########################################################################

	## BURADA YAPILMASI GEREKENLER
	## 1) Siparişin durumunu $post['merchant_oid'] değerini kullanarak veri tabanınızdan sorgulayın.
	## 2) Eğer sipariş zaten daha önceden onaylandıysa veya iptal edildiyse  echo "OK"; exit; yaparak sonlandırın.

	if( $post['status'] == 'success' ) { ## Ödeme Onaylandı
		
		$parts = explode("S", $post['merchant_oid']);
		$userId = $parts[0];
		$courseId = $parts[1];
		$instanceId = $parts[2];

		## BURADA YAPILMASI GEREKENLER
		## 1) Siparişi onaylayın.
		## 2) Eğer müşterinize mesaj / SMS / e-posta gibi bilgilendirme yapacaksanız bu aşamada yapmalısınız.
		## 3) 1. ADIM'da gönderilen payment_amount sipariş tutarı taksitli alışveriş yapılması durumunda
		## değişebilir. Güncel tutarı $post['total_amount'] değerinden alarak muhasebe işlemlerinizde kullanabilirsiniz.
		
		// Geçersiz Kullanıcı ID
		if (!$user = $DB->get_record("user", array("id" => $userId))) {
			message_paytrpayment_error_to_admin("Not a valid user id", $data);
			//redirect($CFG->wwwroot);
		}
		// Geçersiz Kurs
		if (!$course = $DB->get_record("course", array("id" => $courseId))) {
			message_paytrpayment_error_to_admin("Not a valid course id", $data);
			//redirect($CFG->wwwroot);
		}
		if (!$context = context_course::instance(
			$course->id,
			IGNORE_MISSING
		)) {
			message_paytrpayment_error_to_admin("Not a valid context id", $data);
			//redirect($CFG->wwwroot);
		}

		$PAGE->set_context($context);
		// Geçersiz İnstance Kontrolü
		if (!$plugininstance = $DB->get_record("enrol", array("id" => $instanceId, "status" => 0))) {
			message_paytrpayment_error_to_admin("Not a valid instance id", $data);
			//redirect($CFG->wwwroot);
		}

		// If currency is incorrectly set then someone maybe trying to cheat the system.

		if ($courseId != $plugininstance->courseid) {
			message_paytrpayment_error_to_admin("Course Id does not match to the course settings, received: " . $data->courseid, $data);
			//redirect($CFG->wwwroot);
		}


		if ($post['status'] != "success") {
			echo "<p>" . $post['failed_reason_msg'] . " Error Code : " . $post['failed_reason_code'] . "</p>";
		} else {
			// ALL CLEAR !

			$paymentData = new stdClass;
			$paymentData->payment_id = $instanceId;
			$paymentData->course_id = $courseId;
			$paymentData->user_id = $userId;
			$paymentData->instance_id = $instanceId;
			$paymentData->price = $post['total_amount'];
			$paymentData->paid_price = $post['total_amount'];
			$paymentData->currency = $post['currency'];
			$paymentData->payment_status = $post['status'];
			$paymentData->pending_reason = "success";
			$paymentData->reason_code = "200";
			$paymentData->time_updated = time();

			$DB->insert_record("enrol_paytrpayment", $paymentData);

			if ($plugininstance->enrolperiod) {
				$timestart = time();
				$timeend   = $timestart + $plugininstance->enrolperiod;
			} else {
				$timestart = 0;
				$timeend   = 0;
			}

			// Enrol user.
			$plugin->enrol_user($plugininstance, $user->id, $plugininstance->roleid, $timestart, $timeend);

			// Pass $view=true to filter hidden caps if the user cannot see them.
			if ($users = get_users_by_capability(
				$context,
				'moodle/course:update',
				'u.*',
				'u.id ASC',
				'',
				'',
				'',
				'',
				false,
				true
			)) {
				$users = sort_by_roleassignment_authority($users, $context);
				$teacher = array_shift($users);
			} else {
				$teacher = false;
			}

			$mailstudents = $plugin->get_config('mailstudents');
			$mailteachers = $plugin->get_config('mailteachers');
			$mailadmins   = $plugin->get_config('mailadmins');
			$shortname = format_string($course->shortname, true, array('context' => $context));

			$coursecontext = context_course::instance($course->id);

			if (!empty($mailstudents)) {
				$a = new stdClass();
				$a->coursename = format_string($course->fullname, true, array('context' => $coursecontext));
				$a->profileurl = "$CFG->wwwroot/user/view.php?id=$user->id";

				$userfrom = empty($teacher) ? core_user::get_support_user() : $teacher;
				$subject = get_string("enrolmentnew", 'enrol', $shortname);
				$fullmessage = get_string('welcometocoursetext', '', $a);
				$fullmessagehtml = html_to_text('<p>' . get_string('welcometocoursetext', '', $a) . '</p>');

				// Send test email.
				ob_start();
				$success = email_to_user($user, $userfrom, $subject, $fullmessage, $fullmessagehtml);
				$smtplog = ob_get_contents();
				ob_end_clean();
			}

			if (!empty($mailteachers) && !empty($teacher)) {
				$a->course = format_string($course->fullname, true, array('context' => $coursecontext));
				$a->user = fullname($user);

				$subject = get_string("enrolmentnew", 'enrol', $shortname);
				$fullmessage = get_string('enrolmentnewuser', 'enrol', $a);
				$fullmessagehtml = html_to_text('<p>' . get_string('enrolmentnewuser', 'enrol', $a) . '</p>');

				// Send test email.
				ob_start();
				$success = email_to_user($teacher, $user, $subject, $fullmessage, $fullmessagehtml);
				$smtplog = ob_get_contents();
				ob_end_clean();
			}

			if (!empty($mailadmins)) {
				$a->course = format_string($course->fullname, true, array('context' => $coursecontext));
				$a->user = fullname($user);
				$admins = get_admins();
				foreach ($admins as $admin) {
					$subject = get_string("enrolmentnew", 'enrol', $shortname);
					$fullmessage = get_string('enrolmentnewuser', 'enrol', $a);
					$fullmessagehtml = html_to_text('<p>' . get_string('enrolmentnewuser', 'enrol', $a) . '</p>');

					// Send test email.
					ob_start();
					$success = email_to_user($admin, $user, $subject, $fullmessage, $fullmessagehtml);
					$smtplog = ob_get_contents();
					ob_end_clean();
				}
			}
			
		
		}

	} else { ## Ödemeye Onay Verilmedi

		## BURADA YAPILMASI GEREKENLER
		## 1) Siparişi iptal edin.
		## 2) Eğer ödemenin onaylanmama sebebini kayıt edecekseniz aşağıdaki değerleri kullanabilirsiniz.
		## $post['failed_reason_code'] - başarısız hata kodu
		## $post['failed_reason_msg'] - başarısız hata mesajı

	}

	## Bildirimin alındığını PayTR sistemine bildir.
	echo "OK";
	exit;
