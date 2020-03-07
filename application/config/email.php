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
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['useragent']    = 'Post Title';
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp@magtouch.co.za';
$config['smtp_user']    = 'gautest@magtouch.co.za';
$config['smtp_pass']    = 'SBtuGPxA6Gye';
$config['smtp_port']    = '587';
$config['smtp_timeout'] = '300';
$config['wordwrap']     = TRUE;
$config['smtp_crypto'] = 'tls';
$config['newline']      = "\r\n"; 
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
/*
$config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'tls://smtp.magtouch.co.za',
    'smtp_port' => 587,
    'smtp_user' => 'gautest@magtouch.co.za', // Second user authenticate
    'smtp_pass' => 'SBtuGPxA6Gye',
    'mailtype'  => 'html', 
    'useragent' =>  'CodeIgniter',
    'smtp_timeout' =>  '300',
    'wordrap' =>  TRUE,
    'newline' =>  "\r\n",
    'charset'   => 'UTF-8'
);


*/

/*

$config['mailtype']     = 'html';
$config['useragent']    = 'Post Title';
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp.magtouch.co.za';
$config['smtp_user']    = 'noreply@onlineguarding.co.za';
$config['smtp_pass']    = '3nfKMpfUSswJ';
$config['smtp_port']    = '587';
$config['charset']      = 'UTF-8';
$config['smtp_timeout'] = '300';
$config['wordwrap']     = TRUE;
$config['validation'] = FALSE;
$config['newline']      = "\r\n";  

*/
/* End of file email.php */
/* Location: ./application/config/email.php */