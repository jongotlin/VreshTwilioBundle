<?php

namespace Vresh\TwilioBundle\Service;

/**
 * This file is part of the VreshTwilioBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Jon Gotlin <jon@jon.se>
 */
class VreshTwilio
{
    protected $twilioWrapper;
    protected $senderNumber;
    protected $deliveryNumber = null;
    protected $enabled = true;

    /**
     * @param string $sid
     * @param string $token
     * @param string $version
     * @param int $retryAttempts
     * @param string $senderNumber
     */
    public function __construct($sid, $token, $version = null, $retryAttempts = 1, $senderNumber = null)
    {
        $this->twilio = new \Services_Twilio($sid, $token, $version, null, $retryAttempts);
        $this->senderNumber = $senderNumber;
    }

    /**
     * @param string $deliveryNumber
     */
    public function setDeliveryNumber($deliveryNumber)
    {
        $this->deliveryNumber = $deliveryNumber;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return \Services_Twilio_Rest_Message
     */
    public function sendMessage($to, $message)
    {
        if ($this->enabled) {
            return $this->twilio->account->messages->sendMessage(
                $this->senderNumber,
                $this->deliveryNumber ?: $to,
                $message
            );
        }
    }
}
