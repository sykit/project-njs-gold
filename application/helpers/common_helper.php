<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getBrowserInfo')) {
   function getBrowserInfo()
   {
      $u_agent = $_SERVER['HTTP_USER_AGENT'];
      $bname = 'Unknown';
      $platform = 'Unknown';
      $version = "";
   
      if (preg_match('/linux/i', $u_agent)) {
         $platform = 'linux';
      } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
         $platform = 'mac';
      } elseif (preg_match('/windows|win32/i', $u_agent)) {
         $platform = 'windows';
      }
   
      if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
         $bname = 'Internet Explorer';
         $ub = "MSIE";
      } elseif (preg_match('/Firefox/i', $u_agent)) {
         $bname = 'Mozilla Firefox';
         $ub = "Firefox";
      } elseif (preg_match('/Chrome/i', $u_agent)) {
         $bname = 'Google Chrome';
         $ub = "Chrome";
      } elseif (preg_match('/Safari/i', $u_agent)) {
         $bname = 'Apple Safari';
         $ub = "Safari";
      } elseif (preg_match('/Opera/i', $u_agent)) {
         $bname = 'Opera';
         $ub = "Opera";
      } elseif (preg_match('/Netscape/i', $u_agent)) {
         $bname = 'Netscape';
         $ub = "Netscape";
      }
   
      $known = array('Version', $ub, 'other');
      $pattern = '#(?<browser>' . join('|', $known) .
         ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
      if (!preg_match_all($pattern, $u_agent, $matches)) {
      }
   
      // see how many we have
      $i = count($matches['browser']);
      if ($i != 1) {
         if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
         } else {
            $version = $matches['version'][1];
         }
      } else {
         $version = $matches['version'][0];
      }
   
      if ($version == null || $version == "") {
         $version = "?";
      }
   
      return array(
         'userAgent' => $u_agent,
         'name'      => $bname,
         'version'   => $version,
         'platform'  => $platform,
         'pattern'    => $pattern
      );
   }
} 

function isEmpty($data)
{
   if ($data == NULL || $data == '') return '-';
   else return $data;
}


function sendemail($email_target, $email_sender, $password, $subject, $message, $filename, $email_sender_name)
{
   $config = [
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => $email_sender,  // Email gmail
      'smtp_pass'   => $password,  // Password  gmail
      'smtp_port'   => 465,
      'crlf'    => "\r\n",
      'newline' => "\r\n",
      'validation' => true
   ];

   if ($email_sender_name == '' || $email_sender_name == NULL) {
      $email_sender_name = 'M2 Virtual Platform';
   }

   $this->load->library('email', $config);
   $this->email->from($email_sender, $email_sender_name);
   $this->email->to($email_target);
   $this->email->subject($subject);
   $this->email->attach($filename);
   $this->email->message($message);
   if ($this->email->send()) {
      return true;
   } else {
      return false;
   }
}

function getRealIpAddr()
{
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
      $ip = $_SERVER['REMOTE_ADDR'];
   }
   return $ip;
}

function generateRandomString($length = 10) {
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[random_int(0, $charactersLength - 1)];
   }
   return $randomString;
}

function transBadge($param){
   switch($param){
      case 'New Transaction' : return '<span class="text-success fw-bold">'.$param.'</span>'; break;
      case 'Verification Required' : return '<span class="text-primary fw-bold">'.$param.'</span>'; break;
      case 'Approval Required' : return '<span class="text-primary fw-bold">'.$param.'</span>'; break;
      case 'Delivery Required' : return '<span class="text-primary fw-bold">'.$param.'</span>'; break;
      case 'Completed' : return '<span class="text-primary fw-bold">'.$param.'</span>'; break;
   }
}

function transBadgeId($param){
   switch($param){
      case '1' : return '<span class="text-dark fw-bold">Draf</span>'; break;
      case '2' : return '<span class="text-dark fw-bold">Diperlukan Verifikasi</span>'; break;
      case '3' : return '<span class="text-dark fw-bold">Dibutuhkan Persetujuan</span>'; break;
      case '4' : return '<span class="text-dark fw-bold">Diperlukan Pengiriman</span>'; break;
      case '5' : return '<span class="text-dark fw-bold">Selesai</span>'; break;
      case '6' : return '<span class="text-dark fw-bold">Diperlukan SP Order</span>'; break;
      case '7' : return '<span class="text-dark fw-bold">Perlu Penyerahan Hasil Produksi </span>'; break;
      case '8' : return '<span class="text-dark fw-bold">Dalam Proses Serah Terima</span>'; break;
      case '9' : return '<span class="text-dark fw-bold">Diperlukan Pengiriman ke Pelanggan</span>'; break;
      case -99 : return '<span class="text-danger fw-bold">Ditolak</span></span>'; break;
   }  
}