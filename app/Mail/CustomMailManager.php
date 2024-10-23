<?php

namespace App\Mail;

use Illuminate\Mail\MailManager;
use App\Mail\Transport\PhpMailerTransport;

class CustomMailManager extends MailManager
{

	protected function createPhpmailerTransport(array $config)
	{
		return new PhpMailerTransport($config);
	}
}
