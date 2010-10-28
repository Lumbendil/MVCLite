<?php
class TranslationModel extends Model
{
	public function getAllTranslations( $locale )
	{
		if ( !preg_match( '/^[a-z]{2}_[A-Z]{2}$/' ,$locale ) )
		{
			throw new Exception('Wrong language code');
		}
		$sql = <<<SQL_QUERY
SELECT
	`key`
	, `translation`
FROM
	`translation`
WHERE
	`locale` = :locale;
SQL_QUERY;

		$prepared_query	= $this->db->prepare( $sql );
		$params			= array ( 'locale' => $locale );

		$prepared_query->execute( $params );

		return $prepared_query->fetchAll( Database::FETCH_KEY_PAIR );
	}
}