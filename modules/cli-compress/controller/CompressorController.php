<?php
/**
 * Compressor controller
 * @package cli-compress
 * @version 0.0.1
 */

namespace CliCompress\Controller;

use LibCompress\Library\Compressor;
use Cli\Library\Bash;

class CompressorController extends \Cli\Controller
{
	public function compressAction(): void{
		$type = $this->req->param->type;
		$files= $this->req->param->files;

		foreach($files as $index => $file)
			$files[$index] = realpath($file);

		$types = ['webp', 'brotli', 'gzip', 'jp2'];
		if($type !== 'all')
			$types = [$type];

		$ext_by_type = [
			'webp'   => 'webp',
			'brotli' => 'br',
			'gzip'   => 'gz',
			'jp2'    => 'jp2'
		];

		foreach($types as $type){
			Bash::echo('Compression with `' . $type . '`');

			foreach($files as $file){
				$file_exts = explode('.', $file);
				$file_ext  = end($file_exts);

				if(in_array($file_ext, ['br', 'gz', 'webp', 'jp2']))
					continue;

				$file_mime = mime_content_type($file);
				$is_image  = false !== strstr($file_mime, 'image');

				$file_target = $file . '.' . $ext_by_type[$type];
				$file_name   = basename($file);

				$skip_compression = !$is_image && in_array($type, ['jp2','webp']);

				if($skip_compression)
					Bash::echo(' - Skipping file `' . $file_name . '`');
				else{
					Bash::echo(' + Compressing file `' . $file_name . '`');
					if(Compressor::$type($file, $file_target))
						Bash::echo('   - Compression success');
					else
						Bash::echo('   - Compression failed');
				}				
			}
		}
	}
}