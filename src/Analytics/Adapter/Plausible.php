<?php

/**
 * Utopia PHP Framework
 *
 *
 * @link https://github.com/utopia-php/framework
 *
 * @version 1.0 RC1
 *
 * @license The MIT License (MIT) <http://www.opensource.org/licenses/mit-license.php>
 */

namespace Utopia\Analytics\Adapter;

use Utopia\Analytics\Adapter;
use Utopia\Analytics\Event;

class Plausible extends Adapter
{
    /**
     *  Endpoint for Plausible

     *
     *  @var string
     */
    protected string $endpoint = 'https://plausible.io/api';

    /**
     * Global Headers
     *
     * @var array
     */
    protected $headers = [];

    /**
     * Plausible API key

     *
     * @var string
     */
    protected string $apiKey;

    /**
     * Domain to use for events
     *
     * @var string
     */
    protected string $domain;

    /**
     * Gets the name of the adapter.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Plausible';
    }

    /**
     * Constructor.
     *
     * @param  string  $domain    The domain to use for events
     * @param  string  $apiKey    The API key to use for requests
     * @param  string  $useragent The useragent to use for requests
     * @param  string  $clientIP  The IP address to forward to Plausible
     * @return Plausible
     */
    public function __construct(string $domain, string $apiKey, string $useragent, string $clientIP)
    {
        $this->domain = $domain;
        $this->apiKey = $apiKey;
        $this->userAgent = $useragent;
        $this->clientIP = $clientIP;
    }

    /**
     * Sends an event to Plausible.
     *
     * @param  Event  $event The event to send.
     * @return bool
     */
    public function send(Event $event): bool
    {
        if (! $this->enabled) {
            return false;
        }

        if (! $this->provisionGoal($event->getType())) {
            return false;
        }

        $params = [
            'url' => $event->getUrl(),
            'props' => $event->getProps(),
            'domain' => $this->domain,
            'name' => $event->getType(),
        ];

        $headers = [
            'X-Forwarded-For' => $this->clientIP,
            'User-Agent' => $this->userAgent,
            'Content-Type' => 'application/json',
        ];

        $this->call('POST', '/event', $headers, $params);

        return true;
    }

    /**
     * Provision a goal for the given event.
     *
     * @param  string  $eventName The name of the event.
     * @return bool
     */
    private function provisionGoal(string $eventName): bool
    {
        $params = [
            'site_id' => $this->domain,
            'goal_type' => 'event',
            'event_name' => $eventName,
        ];

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.$this->apiKey,
        ];

        $this->call('PUT', '/v1/sites/goals', $headers, $params);

        return true;
    }
}
