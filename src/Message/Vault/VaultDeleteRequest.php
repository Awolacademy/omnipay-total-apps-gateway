<?php

namespace Omnipay\TotalAppsGateway\Message\Vault;

use Omnipay\TotalAppsGateway\Message\Transaction\AuthorizeRequest;
use Omnipay\TotalAppsGateway\Message\Response\DeleteResponse;

class VaultDeleteRequest extends AuthorizeRequest
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'delete_customer';
    }
    
    /**
     * @return Array
     * @throws InvalidCreditCardException
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('cardReference');
        $data = $this->getBaseData();
        unset($data['type']);
        $data['customer_vault'] = $this->getType();
        $data['customer_vault_id'] = $this->getCardReference();
        return $data;
    }
    
    /**
     * @param string $data
     * @return Response
     */
    protected function createResponse($data)
    {
        return $this->response = new DeleteResponse($this, $data);
    }
}
