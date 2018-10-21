<?php

/*
 * This file is part of the ZealByte Message Package.
 *
 * (c) ZealByte <info@zealbyte.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZealByte\Message\Entity
{
	use ZealByte\Message\Event\MessageEvent;

	/**
	 * Message Entity
	 *
	 * @author Dustin Martella <dustin.martella@zealbyte.com>
	 */
	class Message
	{
		private $event;

		private $summary;

		private $message;

		public function __construct (string $summary, string $message = null)
		{
			$this->summary = $summary;
			$this->message = $message ?: $summary;
		}

		public function __toString ()
		{
			return $this->getSummary();
		}

		public function getEvent ()
		{
			return $this->event;
		}

		public function getMessage ()
		{
			return (string) $this->message;
		}

		public function getSummary ()
		{
			return (string) $this->summary;
		}

		public function setEvent (MessageEvent $event = null) : self
		{
			if ($event)
				$this->event = $event;

			return $this;
		}

	}
}
