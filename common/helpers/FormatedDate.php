<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.06.18
 * Time: 14:22
 */

namespace common\helpers;


class FormatedDate {
	/**
	 * форматирует дату
	 *
	 * @param $date
	 *
	 * @return false|string
	 */
	public static function asDate( $date ) {
		return date( "Y-m-d", $date );

	}
}