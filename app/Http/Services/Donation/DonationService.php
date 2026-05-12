<?php

namespace App\Http\Services\Donation;
use DTOS\DonationDTO;

Class DonationService
{

    public function donate(DonationDTO $donation) 
    {
        /**vamos criar as models de cada uma das migrations */
        // vai receber o DTO
        // identifica o usuário 
        // informações da transação bancária 
        // identifica tipo de transação bancária 

        // chama services responsáveis pelas regras de cada validação 

        // faz a tratativa do valor 
        // salva informações bancárias e dados sensíveis criptografados
        // nesse caso precisamos de um helper que faça essa criptografia dos dados sensíveis

        



    }

}