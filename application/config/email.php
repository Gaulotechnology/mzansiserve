<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/

/*
$config['protocol']     = 'mail';
$config['imap_host'] = 'ssl0.ovh.net';
$config['imap_user'] = 'info@lorekominternational.com';
$config['imap_pass'] = 'Lorekom88';
$config['imap_port'] = '993';
$config['imap_mailbox'] = 'INBOX';
$config['imap_path'] = '';
$config['imap_server_encoding'] = 'utf-8';
$config['imap_attachemnt_dir'] = './tmp/';
$config['mailtype'] = 'html';
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;
  */       

$config['mailtype']     = 'html';
$config['useragent']    = 'Post Title';
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'mail.mzansiserve.com';
$config['smtp_user']    = 'test01@mzansiserve.com';
$config['smtp_pass']    = 'Password@2019';
$config['smtp_port']    = '587';
$config['charset']      = 'UTF-8';
$config['smtp_timeout'] = '300';
$config['wordwrap']     = TRUE;
$config['validation'] = FALSE;
$config['newline']      = "\r\n"; 
//print_r($config);


*/

/*

*/
/* End of file email.php */
/* Location: ./application/config/email.php */
