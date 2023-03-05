<?php

declare(strict_types=1);

/**
 * Contains the EuplatescStatus class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-05-14
 *
 */

namespace Vanilo\Euplatesc\Models;

use Konekt\Enum\Enum;

/**
 * Reverse engineered from the PDF documentation:
 *  - Version: 3.2
 *  - 24.08.2014
 *  - Pages 15-24
 *
 * @method static self PENDING_OK()
 * @method static self INVALID_EP_ID()
 * @method static self INVALID_MID()
 * @method static self INVALID_CURR()
 * @method static self INVALID_TIMESTAMP()
 * @method static self INVALID_AMOUNT()
 * @method static self INVALID_OREDR_DESC()
 * @method static self INVALID_RECURRENCE()
 * @method static self INVALID_EMAIL()
 * @method static self INVALID_INVOICE_ID()
 * @method static self TRANSACTION_NOT_APPROVED()
 * @method static self TRANSACTION_EXPIRED()
 * @method static self TRANSACTION_DATA_MISMATCH()
 * @method static self TRANSACTION_ALREADY_CAPTURED()
 * @method static self TRANSACTION_IS_REVERSAL()
 * @method static self REQUEST_ALREADY_SENT()
 * @method static self NOT_PERMITTED_STATUS_CONFLICT()
 * @method static self NOT_PERMITTED_REVERSAL_PENDING()
 * @method static self TRANSACTION_NOT_FOUND()
 * @method static self INTERNAL_ERROR()
 * @method static self INVALID_RECURRING_LIST()
 * @method static self UNKNOWN_ERROR()
 */
class EuplatescStatus extends Enum
{
    public const __DEFAULT = self::UNKNOWN_ERROR;

    public const PENDING_OK = 0;
    public const INVALID_EP_ID = 101;
    public const INVALID_MID = 102;
    public const INVALID_CURR = 103;
    public const INVALID_TIMESTAMP = 104;
    public const INVALID_AMOUNT = 105;
    public const INVALID_OREDR_DESC = 106;
    public const INVALID_RECURRENCE = 107;
    public const INVALID_EMAIL = 108;
    public const INVALID_INVOICE_ID = 109;

    public const TRANSACTION_NOT_APPROVED = 301;
    public const TRANSACTION_EXPIRED = 302;
    public const TRANSACTION_DATA_MISMATCH = 303;
    public const TRANSACTION_ALREADY_CAPTURED = 304;
    public const TRANSACTION_IS_REVERSAL = 305;

    public const REQUEST_ALREADY_SENT = 306;
    public const NOT_PERMITTED_STATUS_CONFLICT = 307;
    public const NOT_PERMITTED_REVERSAL_PENDING = 308;

    public const TRANSACTION_NOT_FOUND = 401;

    public const INTERNAL_ERROR = 901;
    public const INVALID_RECURRING_LIST = 902;
    public const UNKNOWN_ERROR = 999;

    protected static bool $unknownValuesFallbackToDefault = true;
}
