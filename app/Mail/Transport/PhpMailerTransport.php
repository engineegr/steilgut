<?php

namespace App\Mail\Transport;

use Illuminate\Mail\Transport\Transport;
use PHPMailer\PHPMailer\PHPMailer;
use Swift_Mime_SimpleMessage;
use Log;


/* 
 * Integrates PHPMailer\PHPMailer\PHPMailer 
 * as a transport for custom mail driver phpmailer
 */

class PhpMailerTransport extends Transport
{

	private $phpMailer;

	/**
	 *
	 * @param array $options - are extracted from 
	 * phpmailer driver in mail.php
	 */
	public function __construct(array $options)
	{
		$this->phpMailer = new PhpMailer;
		$this->phpMailer->isSMTP();
		$this->phpMailer->SMTPAuth = true;
		$this->phpMailer->SMTPSecure = $options['encryption'];
		$this->phpMailer->Host = $options['host'];
		$this->phpMailer->Username = $options['username'];
		$this->phpMailer->Password = $options['password'];
		$this->phpMailer->Port = $options['port'];
		$this->phpMailer->From = $options['username'];
		$this->phpMailer->FromName = $options['mail_from_name'];
		$this->phpMailer->isHTML(true);
	}

	/**
	 * {@inheritdoc}
	 */
	public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
	{
		$this->beforeSendPerformed($message);

		$this->mapPhpMailer($message);
		if ($this->phpMailer->send()) {
			Log::info("PhpMailerTransport [send message] Success. Used PhpMailer interface");
		} else {
			throw new ThrowExceptionOnFailurePlugin("PhpMailerTransport [send message] Failure. Used PhpMailer plugin");
		}

		$this->sendPerformed($message);

		return $this->numberOfRecipients($message);
	}

	public function mapPhpMailer(Swift_Mime_SimpleMessage $message)
	{
		$this->phpMailer->Body = $message->getBody();

		$msgTo = $message->getTo();
		$msgCc = $message->getCc();
		$msgBcc = $message->getBcc();

		$errMsg = "PhpMailerTransport [ mapPhpMailer ] Swift_Mime_SimpleMessage message: ";

		if ($msgTo && is_array($msgTo)) {
			foreach ($message->getTo() as $toHeader => $toValue)
				$this->phpMailer->addAddress($toHeader);
		} else {
			$errMsg += !$msgTo ? ' recipients are not set' : '';
			$errMsg += !is_array($msgTo) ? ' unknown type of recipients data structure' : '';

			throw new InvalidArgumentException($errMsg);
		}

		if ($msgCc && is_array($msgCc)) {
			foreach ($message->getCc() as $ccHeader => $ccValue)
				$this->phpMailer->addCC($ccHeader);
		}

		if ($msgBcc && is_array($msgBcc)) {
			foreach ($message->getBcc() as $bccHeader => $bccValue)
				$this->phpMailer->addBCC($bccHeader);
		}

		$this->phpMailer->Subject = $message->getSubject();
	}
}
