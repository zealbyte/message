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
	use Exception;

	/**
	 * The message event is dispatched each time a message is generated
	 * in the system.
	 */
	class ExceptionMessageEvent extends MessageEvent
	{
		private $exception;

		public function getException ()
		{
			return $this->exception;
		}

		public function setException (Exception $exception)
		{
			$this->exception = $exception;
		}
	}
}
