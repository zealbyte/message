<?php

/*
 * This file is part of the ZealByte Message Package.
 *
 * (c) ZealByte <info@zealbyte.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZealByte\Message\Event
{
	use DateTime;
	use Symfony\Component\EventDispatcher\Event;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Security\Core\User\UserInterface;
	use ZealByte\Message\Entity\Message;

	/**
	 * The message event is dispatched each time a message is generated
	 * in the system.
	 */
	abstract class MessageEvent extends Event
	{
		private $date;

		private $message;

		private $request;

		private $user;

		public function __construct (Message $message, Request $request = null, UserInterface $user = null)
		{
			$this->date = new DateTime('now');
			$this->message = $message;

			if ($request)
				$this->request = $request;

			if ($user)
				$this->user = $user;
		}

		public function getId ()
		{
		}

		public function getMessage ()
		{
			return $this->message;
		}

		public function getRequest ()
		{
			return $this->request;
		}

		public function getUser ()
		{
			return $this->user;
		}
	}
}
