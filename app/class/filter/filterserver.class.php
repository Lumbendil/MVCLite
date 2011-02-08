<?php
/**
 * Class wich deals with $_SERVER data.
 *
 * @package MVCLite
 * @subpackage Filters
 */
class FilterServer extends FilterUnsetSource implements Filter
{
	protected function initData()
	{
		$this->data	= $_SERVER;
		$_SERVER	= array();
	}

	/**
	 * Checks if an IP is valid.
	 *
	 * @param string $ip
	 *
	 * @return boolean
	 *
	 * @author <admin@webbsense.com>
	 *
	 * @link http://algorytmy.pl/doc/php/function.getenv.php
	 */
	protected function validIp( $ip ) {
		if ( !empty( $ip ) && ip2long( $ip )!= -1 )
		{
			$reserved_ips = array (
				array( '0.0.0.0', '2.255.255.255' )
				, array( '10.0.0.0', '10.255.255.255' )
				, array( '127.0.0.0', '127.255.255.255' )
				, array( '169.254.0.0', '169.254.255.255' )
				, array( '172.16.0.0', '172.31.255.255' )
				, array( '192.0.2.0', '192.0.2.255' )
				, array( '192.168.0.0', '192.168.255.255' )
				, array( '255.255.255.0', '255.255.255.255' )
			);

			foreach ( $reserved_ips as $r )
			{
				$min = ip2long( $r[0] );
				$max = ip2long( $r[1] );
				if ( ( ip2long( $ip ) >= $min ) && ( ip2long( $ip ) <= $max ) )
				{
					return false;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns the current IP.
	 *
	 * @return string	The IP in the 4 dot-ed standard.
	 *
	 * @author <admin@webbsense.com>
	 *
	 * @link http://algorytmy.pl/doc/php/function.getenv.php
	 */
	public function getIp() {
		if ($this->validIp( $this->getData( 'HTTP_CLIENT_IP' ) ) )
		{
			return $this->getData( 'HTTP_CLIENT_IP' );
		}
		foreach ( explode( ',', $this->getData( 'HTTP_X_FORWARDED_FOR' ) ) as $ip )
		{
			if ( $this->validIp( trim( $ip ) ) ) {
				return $ip;
			}
		}
		if ( $this->validIp( $this->getData( 'HTTP_X_FORWARDED' ) ) )
		{
			return $this->getData( 'HTTP_X_FORWARDED' );
		}
		elseif( $this->validIp( $this->getData( 'HTTP_FORWARDED_FOR' ) ) )
		{
			return $this->getData( 'HTTP_FORWARDED_FOR' );
		}
		elseif ( $this->validIp( $this->getData( 'HTTP_FORWARDED' ) ) )
		{
			return $this->getData( 'HTTP_FORWARDED' );
		}
		elseif ( $this->validIp( $this->getData( 'HTTP_X_FORWARDED' ) ) )
		{
			return $this->getData( 'HTTP_X_FORWARDED' );
		}
		else {
			return $this->getData( 'REMOTE_ADDR' );
		}
	}

	/**
	 * Returns a trimmed IP (removed the last digit group) in the numeric notation.
	 */
	public function getTrimmedIntIp()
	{
		$ip = $this->getIp();

		return ip2long( preg_replace( '/\.\d{1,3}$/', '', $ip ) );
	}
}
