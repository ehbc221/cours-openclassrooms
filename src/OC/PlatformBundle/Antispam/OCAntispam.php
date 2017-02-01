<?php

namespace OC\PlatformBundle\Antispam;

class OCAntispam
{
	private $mailer;
	private $locale;
	private $minLength;

	public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
	{
		$this->mailer =        $mailer;
		$this->locale =         $locale;
		$this->minLength = (int) $minLength;
	}

	/**
	 * [Verify if the text is a spam or not]
	 * @method isSpam
	 * @param  [string]  $text [The text that we have to verify if it's a spam]
	 * @return boolean       [If it' a spam or not]
	 */
	public function isSpam($text)
	{
		return strlen($text) < $this->minLength;
	}
}
