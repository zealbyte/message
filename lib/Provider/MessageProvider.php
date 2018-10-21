<?php

/*
 * This file is part of the ZealByte Message Package.
 *
 * (c) ZealByte <info@zealbyte.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZealByte\Message\Provider
{
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\Security\Core\User\UserInterface;
	use Symfony\Component\EventDispatcher\EventDispatcherInterface;
	use ZealByte\Message\Entity\Message;
	use ZealByte\Message\Message as MessageEvents;
	use ZealByte\Message\Event\ActionMessageEvent;
	use ZealByte\Message\Event\ErrorMessageEvent;
	use ZealByte\Message\Event\ExceptionMessageEvent;
	use ZealByte\Message\Event\InfoMessageEvent;
	use ZealByte\Message\Event\NoticeMessageEvent;
	use ZealByte\Message\Event\SuccessMessageEvent;
	use ZealByte\Message\Event\WarningMessageEvent;

	/**
	 * Message Provider
	 *
	 * @author Dustin Martella <dustin.martella@zealbyte.com>
	 */
	class MessageProvider
	{
		private $dispatcher;

		private $request;

		private $user;

		public function __construct (EventDispatcherInterface $dispatcher = null)
		{
			if ($dispatcher)
				$this->setEventDispatcher($dispatcher);
		}

		public function setEventDispatcher (EventDispatcherInterface $dispatcher)
		{
			$this->dispatcher = $dispatcher;
		}

		public function setRequest (Request $request)
		{
			$this->request = $request;
		}

		public function setUser (UserInterface $user = null)
		{
			$this->user = $user;
		}

		/**
		 * Log an action message to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addAction (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new ActionMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_ACTION, $event);
		}

		/**
		 * Log an error message to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addError (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new ErrorMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_ERROR, $event);
		}

		/**
		 * Log an exception to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param Exception The exception to be logged in debug console
		 */
		public function addException (string $summary, \Exception $exception)
		{
			$message = new Message($summary, $exception->getMessage());
			$event = new ExceptionMessageEvent($message, $this->request, $this->user);

			$event->setException($exception);
			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_EXCEPTION, $event);
		}

		/**
		 * Log an info notice to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addInfo (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new InfoMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_INFO, $event);
		}

		/**
		 * Log a system notice to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addNotice (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new NoticeMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_NOTICE, $event);
		}

		/**
		 * Log a success message to the system log.
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addSuccess (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new SuccessMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_SUCCESS, $event);
		}

		/**
		 *
		 * @param string The class or module the log entry comes from.
		 * @param string The summary (short version) of the message.
		 * @param string The long extended version of the message if there is one.
		 */
		public function addWarning (string $summary, string $fullMessage = null)
		{
			$message = new Message($summary, $fullMessage);
			$event = new WarningMessageEvent($message, $this->request, $this->user);

			$message->setEvent($event);

			$this->dispatcher->dispatch(MessageEvents::EVENT_MESSAGE_WARNING, $event);
		}

	}
}
