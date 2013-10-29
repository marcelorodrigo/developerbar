<?php defined('SYSPATH') or die('No direct script access.');
/**
 * This controller is only for routing (portability) of the 
 * CSS, JS and Images for the Developer Bar
 *
 * @package    DeveloperBar
 * @category   Controllers
 * @author     Chris Go
 */
class Controller_DeveloperBar extends Controller {

	// Routes
	protected $base_dir = 'media/developerbar';

	/**
	 * Index to serve files
	 * 
	 * @author Chris Go
	 * @author Marcelo Rodrigo
	 * @param mixed $file File to load/serve
	 */
	public function action_index($file = null)
	{
		
		if(!$file)
			$file = Request::current()->param('file');
		
		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		
		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));
		
		// Try loading file
		$file = Kohana::find_file($this->base_dir, $file, $ext);
		
		if($file)
		{
			// Check if the browser sent an "if-none-match: <etag>" header, and tell if the file hasn't changed
			$this->response->check_cache(sha1($this->request->uri()).filemtime($file), $this->request);

			// Send the file content as the response
			// $this->response->body(file_get_contents($file));

			// Set the proper headers to allow caching
			$this->response->headers('content-type',  File::mime_by_ext($ext));
			$this->response->headers('last-modified', date('r', filemtime($file)));

			echo file_get_contents($file);
		}
		else
		{
			// Return a 404 status
			$this->response->status(404);
		}
	}
}