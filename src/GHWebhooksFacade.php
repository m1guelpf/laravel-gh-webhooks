<?php

namespace M1guelpf\GHWebhooks;

use Illuminate\Support\Facades\Facade;

/**
 * @see \M1guelpf\GHWebhooks\GHWebhooksClass
 */
class GHWebhooksFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ghwebhooks';
    }
}
