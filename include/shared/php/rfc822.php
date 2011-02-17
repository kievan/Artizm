<?php

        #
	# RFC822 Email Parser
	#
	# By Cal Henderson <cal@iamcal.com>
	# This code is licensed under a Creative Commons Attribution-ShareAlike 2.5 License
	# http://creativecommons.org/licenses/by-sa/2.5/
	#
	# $Revision: 1.1 $
	#

	##################################################################################

	function is_valid_email_address($email)
	{

		$qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';

		$dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';

		$atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
			'\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';

		$quoted_pair = '\\x5c[\\x00-\\x7f]';

		$domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";

		$quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";

		$domain_ref = $atom;

		$sub_domain = "($domain_ref|$domain_literal)";

		$word = "($atom|$quoted_string)";

		$domain = "$sub_domain(\\x2e$sub_domain)*";

		$local_part = "$word(\\x2e$word)*";

		$addr_spec = "$local_part\\x40$domain";

		//return preg_match("!^$addr_spec$!", $email) ? 1 : 0;
		return preg_match("!^$addr_spec$!", $email) ? true : false;
	}
	
	##################################################################################

?>