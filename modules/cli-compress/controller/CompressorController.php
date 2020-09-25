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

		$types = ['webp', 'brotli', 'gzip'];
		if($type !== 'all')
			$types = [$type];

		$ext_by_type = [
			'webp'   => 'webp',
			'brotli' => 'br',
			'gzip'   => 'gz'
		];

		foreach($types as $type){
			Bash::echo('Compression with `' . $type . '`');

			foreach($files as $file){
				$file_exts = explode('.', $file);
				$file_ext  = end($file_exts);
                $file_ext  = strtolower($file_ext);

				if(in_array($file_ext, ['br', 'gz', 'webp']))
					continue;

				$file_mime = mime_content_type($file);
				$is_image  = false !== strstr($file_mime, 'image');

				$file_target = $file . '.' . $ext_by_type[$type];
				$file_name   = basename($file);

				$skip_compression = false;
                
                // image only compress with webp
                if($is_image && !in_array($type, ['webp']))
                    $skip_compression = true;
                // other file should skip webp compress
                elseif(!$is_image && in_array($type, ['webp']))
                    $skip_compression = true;

				if($skip_compression)
					Bash::echo(' - Skipping file `' . $file_name . '`');
				else{
					Bash::echo(' + Compressing file `' . $file_name . '`');
                    $args = [$file, $file_target];

                    if($file_ext == 'jpg' || $file_ext == 'jpeg')
                        $args[] = 85;

                    $result = call_user_func_array(['LibCompress\Library\Compressor', $type], $args);

					if($result)
						Bash::echo('   - Compression success');
					else
						Bash::echo('   - Compression failed');
				}				
			}
		}
	}
}