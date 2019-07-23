<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['useragent'] = 'sendmail';
$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_user'] = '********';
$config['smtp_pass'] = '********';
$config['smtp_port'] = 465;
$config['smtp_timeout'] = 5;
$config['smtp_keepalive'] = FALSE;
$config['smtp_crypto'] = 'ssl';
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['charset'] = 'utf-8';
$config['validate'] = TRUE;
$config['priority'] = 3;
$config['crlf'] = '\n';
$config['newline'] = '\r\n';
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;
$config['dsn'] = FALSE;
$config['mailtype'] = 'html';
/* END OF forms config */
