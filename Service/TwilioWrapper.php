<?php
namespace Vresh\TwilioBundle\Service;

/**
 * This file is part of the VreshTwilioBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Fridolin Koch <info@fridokoch.de>
 */
class TwilioWrapper extends \Services_Twilio
{
    protected $senderNumber;
    protected $deliveryNumber;

    /**
     * @param string $sid
     * @param string $token
     * @param string $version
     * @param int $retryAttempts
     * @param string $senderNumber
     * @param string $deliveryNumber
     */
    public function __construct($sid, $token, $version = null, $retryAttempts = 1, $senderNumber = null, $deliveryNumber = null)
    {
        parent::__construct($sid, $token, $version, null, $retryAttempts);

        $this->senderNumber = $senderNumber;
        $this->deliveryNumber = $deliveryNumber;
    }

    /**
     * Returns a new \Services_Twilio instance from the given parameters
     *
     * @param string $sid
     * @param string $token
     * @param string $version
     * @param int $retryAttempts
     *
     * @return \Services_Twilio
     */
    public function createInstance($sid, $token, $version = null, $retryAttempts = 1)
    {
        return new \Services_Twilio($sid, $token, null, $version, $retryAttempts);
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return \Services_Twilio_Rest_Message
     */
    public function sendMessage($to, $message)
    {
        return $this->account->messages->sendMessage(
            $this->senderNumber,
            $this->deliveryNumber ?: $to,
            $message
        );
    }
}
