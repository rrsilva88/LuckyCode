<?php

class App_Lib_PagSeguroStatus 
{
    protected static $_transactionStatus = array(
            'WAITING_PAYMENT' => 'Aguardando Pagamento',
            'IN_ANALYSIS' => 'Em análise',
            'PAID' => 'Paga',
            'AVAILABLE' => 'Disponível',
            'IN_DISPUTE' => 'Em disputa',
            'REFUNDED' => 'Devolvida',
            'CANCELLED' => 'Cancelada'
            );
     protected static $_transactionStatusID = array(
            'WAITING_PAYMENT' => '1',
            'IN_ANALYSIS' => '2',
            'PAID' => '3',
            'AVAILABLE' => '4',
            'IN_DISPUTE' => '5',
            'REFUNDED' => '6',
            'CANCELLED' => '7'
            );
    
    protected static $_metodoDePagamento = array(
        'CREDIT_CARD' => 'Cartão de crédito',
        'BOLETO' => 'Boleto',
        'ONLINE_TRANSFER' => 'Débito online (TEF)',
        'BALANCE' => 'Saldo PagSeguro',
        'OI_PAGGO' => 'Oi pago'
    );
    
    static public function getTransactionStatus($statusValue)
    {
        return self::$_transactionStatus[$statusValue];
    }
    static public function getTransactionStatusID($statusValue)
    {
        return self::$_transactionStatusID[$statusValue];
    }
    
    
    
    static public function getMetodoDePagamento($metodo)
    {
        return self::$_metodoDePagamento[$metodo];
    }
}