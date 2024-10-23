<?php

namespace App\Http\Controllers\API\PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;

class PhpMailSender implements MailSender
{

	private $transport = null;

	public function __construct(PHPMailer $transport)
	{
		$this->transport = $transport;
	}

	public function send(String $mailBody): bool
	{
		$this->transport->Body = $mailBody;
		return $this->transport->send();
	}

	public function subject(String $subject): MailSender
	{
		$this->transport->Subject = $subject;
		return $this;
	}

	public function to(String $recipient): MailSender
	{
		$this->transport->addAddress($recipient);
		return $this;
	}

	public function cc(String $ccRecipient): MailSender
	{
		$this->transport->addCC($ccRecipient);
		return $this;
	}

	public static function createTransport(): MailSender
	{
		$phpMailer = new PHPMailer;
		$phpMailer->isSMTP();
		$phpMailer->SMTPAuth = true;
		$phpMailer->SMTPSecure = env('MAIL_ENCRYPTION', 'ssl');
		$phpMailer->Host = env('MAIL_HOST', 'smtp.strato.de');
		$phpMailer->Username = env('MAIL_USERNAME', 'info@steilgut-test.de');
		$phpMailer->Password = env('MAIL_PASSWORD', 'steilguttest9090');
		$phpMailer->Port = env('MAIL_PORT', 465);
		$phpMailer->From = env('MAIL_FROM_ADDRESS', 'info@steilgut-test.de');
		$phpMailer->FromName = env('MAIL_FROM_NAME', 'Steilgut');
		$phpMailer->isHTML(true);

		return new PhpMailSender($phpMailer);
	}
}
