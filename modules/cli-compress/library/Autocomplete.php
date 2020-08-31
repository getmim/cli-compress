<?php
/**
 * Autocomplete provider
 * @package cli-compress
 * @version 0.0.1
 */

namespace CliCompress\Library;

use Mim\Library\Fs;

class Autocomplete extends \Cli\Autocomplete
{
	static function files(array $args): string{
		return '2';
	}

	static function command(array $args): string{
		$farg = $args[1] ?? null;
		$result = ['all', 'brotli', 'gzip', 'webp', 'jp2'];

		if(!$farg)
			return trim(implode(' ', $result));

		return parent::lastArg($farg, $result);
	}
}