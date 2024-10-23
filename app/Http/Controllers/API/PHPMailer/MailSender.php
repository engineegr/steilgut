<?php

namespace App\Http\Controllers\API\PHPMailer;

interface MailSender {
	public function send(String $mailBody) : bool;
	public function subject(String $subject): MailSender;
	public function to(String $recipient) : MailSender;
	public function cc(String $ccRecipient) : MailSender;
}
