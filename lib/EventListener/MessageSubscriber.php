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
	use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
	use Symfony\Component\Security\Core\User\UserInterface;
	use Symfony\Component\HttpKernel\KernelEvents;
	use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
	use Symfony\Component\HttpKernel\Event\GetResponseEvent;
	use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
	use ZealByte\Message\Provider\MessageProvider;

	/**
	 * Message Event Subscriber
	 *
	 * @author Dustin Martella <dustin.martella@zealbyte.com>
	 */
	class MessageSubscriber implements EventSubscriberInterface
	{
		private $tokenStorage;

		private $messages;

		public static function getSubscribedEvents()
		{
			return [
				KernelEvents::REQUEST => [
					['onKernelRequest', -1000]
				],
				KernelEvents::EXCEPTION => [
					['onKernelException', -1000]
				],
			];
		}

		public function __construct (MessageProvider $messages, ?TokenStorageInterface $token_storage = null)
		{
			$this->messages = $messages;

			if ($token_storage)
				$this->setTokenStorage($token_storage);
		}

		public function onKernelRequest (GetResponseEvent $event)
		{
			if ($this->tokenStorage) {
				$token = $this->tokenStorage->getToken();

				if ($token) {
					$user = $token->getUser();

					if ($user && ($user instanceof UserInterface))
						$this->messages->setUser($user);
				}
			}

			$this->messages->setRequest($event->getRequest());
		}

		public function onKernelException (GetResponseForExceptionEvent $event)
		{
			$this->messages->addException('Unexpected Error!', $event->getException());
		}

		public function setTokenStorage (TokenStorageInterface $token_storage) : self
		{
			$this->tokenStorage = $token_storage;

			return $this;
		}

	}
}

