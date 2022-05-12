<?php

namespace Payone\Transaction;

class PayPalExpressGetCheckout extends Base {
	/**
	 * @param \Payone\Gateway\GatewayBase $gateway
     * @param string $authorization_method
	 */
	public function __construct( $gateway, $authorization_method = null ) {
		parent::__construct( 'genericpayment' );
		$this->set_data_from_gateway( $gateway );

        $this->set( 'clearingtype', 'wlt' );
        $this->set( 'wallettype', 'PPE' );
        $this->set( 'add_paydata[action]', 'getexpresscheckoutdetails' );
        $this->set( 'add_paydata[request_billing_address]', '1' );
	}

	/**
	 * @param \WC_Cart $cart
	 *
	 * @return \Payone\Payone\Api\Response
	 */
	public function execute( \WC_Cart $cart ) {
        $this->set_once( 'amount', $cart->get_total( 'non-view' ) * 100 );
        $this->set( 'currency', strtoupper( get_woocommerce_currency() ) );

		return $this->submit();
	}
}
