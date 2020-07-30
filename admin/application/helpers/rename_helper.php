<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function renameFile($fileName, $price, $new_code) {
			$now		= substr(md5(date('Y-m-d H:i:s')), -6);
			$split	= '.';
			$type		= explode($split, $fileName);
			$new_card_name = 'CARD'.$price.$new_code.'-'.$now.'.'.$type[1];  // NEW PHOTO NAME
			return $new_card_name;
}




/* End of file rename_helper.php */
/* Location: ./system/helpers/rename_helper.php */


