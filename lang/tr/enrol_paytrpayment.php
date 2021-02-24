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
 *
 * @package    enrol_paytrpayment
 * @copyright  2021 WebTech Bilişim
 * @license    http://www.gnu.org/licenses/agpl-3.0.html GNU AGPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['applycode'] = 'Kodu girin';

$string['merchant_id'] = 'PayTR Mağaza No';
$string['merchant_id_desc'] = 'PayTR tarafından verilen Mağaza No';
$string['merchant_key'] = 'PayTR Mağaza Parolası';
$string['merchant_key_desc'] = 'PayTR tarafından verilen Mağaza Numarası';
$string['merchant_salt_key'] = 'PayTR Salt Key';
$string['merchant_salt_key_desc'] = 'PayTR tarafından verilen Mağaza Gizli Anahtarı';
$string['assignrole'] = 'Rol belirle';
$string['canntenrol'] = 'Kayıt devredışı veya etkin değil';
$string['charge_description1'] = 'Makbuz için müşteri oluştur';
$string['charge_description2'] = 'Kurs kayıt ücretini tahsil et';
$string['cost'] = 'Kayıt ücreti';
$string['costerror'] = 'Kayıt ücreti sayı olmak zorundadır.';
$string['costorkey'] = 'Lütfen bir kayıt yöntemi seçin.';
$string['couponcode'] = 'Kupon kodu';
$string['currency'] = 'Para birimi';
$string['defaultrole'] = 'Varsayılan rol ataması';
$string['defaultrole_desc'] = 'PayTR kayıtları sırasında kullanıcılara atanacak rolü seçin';
$string['enrol'] = 'Kayıt ol';
$string['enrolenddate'] = 'Son kayıt tarihi';
$string['enrolenddaterror'] = 'Son kayıt tarihi, kayıt başlangıç tarihinden önce olamaz';
$string['enrolenddate_help'] = 'Eğer etkinleştirilirse kullanıcılar bu tarihten daha önce kayıt olamazlar.';
$string['enrolperiod'] = 'Kayıt süresi';
$string['enrolperiod_desc'] = 'Kaydın geçerli olacağı varsayılan süre. Eğer değer 0 olarak ayarlanırsa süre sınırsız olacaktır.';
$string['enrolperiod_help'] = 'Üye kayıt olduktan sonra kaydın geçerlilik süres. Eğer devre dışı bırakılırsa süre sınırsız olacaktır.';
$string['enrolstartdate'] = 'Kayıt başlangıç tarihi';
$string['enrolstartdate_help'] = 'Eğer etkinleştirilirse kullanıcılar bu tarihten sonra kayıt olabilir.';
$string['expiredaction'] = 'Kayıt geçerlilik süresi dolunca gerçekleştirilecek eylem';
$string['expiredaction_help'] = 'Kullanıcı kaydı zaman aşımına uğradığında ne olacağını seçin. Lütfen kayıt silme sırasında kimi kullanıcı veri ve ayarlarının sistemden silindiğine dikkat edin.';
$string['invalidcouponcode'] = 'Geçersiz Kupon Kodu';
$string['invalidcouponcodevalue'] = 'Kupon Kodu {$a} geçersiz!';
$string['paytr:manage'] = 'Kayıtlı kullanıcıları yönetin';
$string['paytr:unenrol'] = 'Dersten kullanıcı kayıtlarını silin';
$string['paytr:unenrolself'] = 'Kendi kaydını dersten sil';
$string['paytraccepted'] = 'PayTR ödemesi kabul edildi';
$string['paytrpayment:config'] = 'PayTR ödeme yapılandırması';
$string['paytrpayment:manage'] = 'PayTR ödeme yönetimi';
$string['paytrpayment:unenrol'] = 'PayTR ödeme kaydını sil';
$string['paytrpayment:unenrolself'] = 'Kendi PayTR ödeme kaydını sil';
$string['paytr_sorry'] = 'Üzgünüz, betiği bu şekilde kullanamazsınız.';
$string['mailadmins'] = 'Yöneticiye haber ver';
$string['mailstudents'] = 'Öğrencilere haber ver';
$string['mailteachers'] = 'Öğretmenlere haber ver';
$string['maxenrolled'] = 'Azami kayıtlı kullanıcı';
$string['maxenrolledreached'] = 'İzin verilen azami kayıt sayısına ulaşıldı.';
$string['maxenrolled_help'] = 'PayTR ile kursa kaydı alınacak kullanıcı sayısını girin. 0 sınırsız anlamına gelir.';
$string['messageprovider:paytrpayment_enrolment'] = 'Mesaj sağlayıcı';
$string['messageprovider:paytr_enrolment'] = 'PayTR kayıt mesajları';
$string['newcost'] = 'Yeni ücret';
$string['nocost'] = 'Bu derse kaydolmak için belirlenmiş bir ücret yok.';
$string['pluginname'] = 'PayTR Ödeme';
$string['pluginname_desc'] = 'PayTR ödeme modülü ücretli dersler sunmanızı sağlar. Eğer herhangi bir ders ücretsiz ise, öğrencilerden giriş için ödeme talep edilmez. Tüm site çapında varsayılan olarak belirleyebileceğiniz bir ücret ayarı olduğu gibi her ders için tek tek ücret belirleyebileceğiniz bir ayar da mevcuttur. Ders ücreti site çapındaki ücreti devre dışı bırakır.';

$string['sandboxmode'] = 'PayTR deneme modu';
$string['sandboxmode_desc'] = 'Hata ayıklama ve test için PayTR deneme modunu kullanın';
$string['secretkey'] = 'PayTR Gizli Anahtarı';
$string['secretkey_desc'] = 'PayTR tarafından verilen API Gizli Anahtarı';
$string['sendpaymentbutton'] = 'PayTR ile ödeme yap';
$string['status'] = 'PayTR kayıtlarına izin ver';
$string['status_desc'] = 'Kullanıcıların varsayılan olarak PayTR ile kayıt olmasına izin ver.';
$string['unenrolselfconfirm'] = '"{$a}" dersinden kaydınızı silmek istediğinize emin misiniz?';
