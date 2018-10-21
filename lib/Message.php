<?php

/*
 * This file is part of the ZealByte Message Package.
 *
 * (c) ZealByte <info@zealbyte.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ZealByte\Message
{
	/**
	 * Message Event Types
	 *
	 * @author Dustin Martella <dustin.martella@zealbyte.com>
	 */
	class Message
	{
    /**
     * The ACTION event
     *
     * @Event("ZealByte\Message\ActionMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_ACTION = 'message.action';

    /**
     * The AUDIT event
     *
     * @Event("ZealByte\Message\AuditMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_AUDIT = 'message.audit';

    /**
     * The ERROR event
     *
     * @Event("ZealByte\Message\ErrorMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_ERROR = 'message.error';

    /**
     * The EXCEPTION event
     *
     * @Event("ZealByte\Message\ExceptionMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_EXCEPTION = 'message.exception';

    /**
     * The INFO event
     *
     * @Event("ZealByte\Message\InfoMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_INFO = 'message.info';

    /**
     * The NOTICE event
     *
     * @Event("ZealByte\Message\NoticeMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_NOTICE = 'message.notice';

    /**
     * The SUCCESS event
     *
     * @Event("ZealByte\Message\SuccessMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_SUCCESS = 'message.success';

    /**
     * The WARNING event
     *
     * @Event("ZealByte\Message\WarningMessageEvent")
     *
     * @var string
     */
    const EVENT_MESSAGE_WARNING = 'message.warning';
    const EVENT_MESSAGE_WARN = 'message.warning';
	}
}
