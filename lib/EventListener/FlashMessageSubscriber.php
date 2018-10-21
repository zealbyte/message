<?php

/*
 * This file is part of the ZealByte Message Package.
 *
 * (c) ZealByte <info@zealbyte.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZealByte\Message\EventListener
{
	use Symfony\Component\EventDispatcher\EventSubscriberInterface;
	use Symfony\Component\HttpFoundation\Session\Session;
	use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
	use ZealByte\Message\Message;
	use ZealByte\Message\Event\ErrorMessageEvent;
	use ZealByte\Message\Event\ExceptionMessageEvent;
	use ZealByte\Message\Event\InfoMessageEvent;
	use ZealByte\Message\Event\NoticeMessageEvent;
	use ZealByte\Message\Event\SuccessMessageEvent;
	use ZealByte\Message\Event\WarningMessageEvent;

	/**
	 * Message Event Subscriber
	 *
	 * @author Dustin Martella <dustin.martella@zealbyte.com>
	 */
	class FlashMessageSubscriber implements EventSubscriberInterface
	{
		private $flashBag;

		public static function getSubscribedEvents ()
		{
			return [
				Message::EVENT_MESSAGE_ERROR  => [
					'onMessageError'
				],
				Message::EVENT_MESSAGE_EXCEPTION => [
					'onMessageException'
				],
				Message::EVENT_MESSAGE_INFO => [
					'onMessageInfo'
				],
				Message::EVENT_MESSAGE_NOTICE => [
					'onMessageNotice'
				],
				Message::EVENT_MESSAGE_SUCCESS => [
					'onMessageSuccess'
				],
				Message::EVENT_MESSAGE_WARNING => [
					'onMessageWarn'
				],
			];
		}

		public function __construct (Session $session = null)
		{
			if ($session)
				$this->setFlashBag($session->getFlashBag());
		}

		public function setFlashBag (FlashBag $flash_bag)
		{
			$this->flashBag = $flash_bag;
		}

		public function onMessageError (ErrorMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_ERROR, $event->getMessage()->getSummary());
		}

		public function onMessageException (ExceptionMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_EXCEPTION, $event->getMessage()->getSummary());
		}

		public function onMessageInfo (InfoMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_INFO, $event->getMessage()->getSummary());
		}

		public function onMessageNotice (NoticeMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_NOTICE, $event->getMessage()->getSummary());
		}

		public function onMessageSuccess (SuccessMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_SUCCESS, $event->getMessage()->getSummary());
		}

		public function onMessageWarn (WarningMessageEvent $event)
		{
			if ($this->flashBag)
				$this->flashBag->add(Message::EVENT_MESSAGE_WARN, $event->getMessage()->getSummary());
		}

	}
}

