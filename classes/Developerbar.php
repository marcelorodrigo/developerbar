<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Developer Bar
 * Prints debug information about your Kohana Application
 * 
 * @author Marcelo Rodrigo
 * @package DeveloperBar
 * @category Classes
 */
class Developerbar
{
	
	/**
	 * User enabled control
	 * @var bool
	 */
	private $_userEnabled = null;
	
	/**
	 * Store instance of class
	 * @var Developerbar
	 */
    private static $instance;
	
	/**
	 * Factory Method
	 * @return Developerbar 
	 */
	public static function factory()
	{
		if(!isset(self::$instance)) {
			//$c = __CLASS__;
			self::$instance = new Developerbar;
        }

        return self::$instance;
	}
	
	/**
	 * Render the generated debug info
	 * @return mixed
	 */
	public function render()
	{
		echo $this->generate();	
	}
	
	/**
	 * Generate all the debug info
	 * 
	 * @return string
	 */
	public function generate()
	{
		
		if(!$this->is_enabled())
			return false;
		
		// Queries
		$queries	= self::queries();
		$queries	= View::Factory('developerbar/queries')
				->bind('queries',$queries)
				->render();
		
		// Files
		$files		= self::files();
		$files		= View::Factory('developerbar/files')
				->bind('files',$files)
				->render();
		
		// Modules
		$modules	= self::modules();
		$modules	= View::Factory('developerbar/modules')
				->bind('modules',$modules)
				->render();
		
		// Routes
		$routes		= self::routes();
		$routes		= View::Factory('developerbar/routes')
				->bind('routes',$routes)
				->render();
		
		// Session
		$session	= self::session();
		$session	= View::Factory('developerbar/session')
				->bind('session',$session)
				->render();
		
		// $_GET
		$get		= self::get();
		$get	= View::Factory('developerbar/get')
				->bind('get',$get)
				->render();
		
		// $_POST
		$post		= self::post();
		$post	= View::Factory('developerbar/post')
				->bind('post',$post)
				->render();
		
		// Rendering data
		$content = View::Factory('developerbar/developerbar')
				->bind('queries', $queries)
				->bind('files', $files)
				->bind('modules', $modules)
				->bind('routes', $routes)
				->bind('session', $session)
				->bind('get', $get)
				->bind('post', $post)
				->render();
		
		return $content;
	}
	
	/**
	 * Collect all info about included files in KO
	 * 
	 * @return array
	 */
	public static function files()
	{
		$files = (array)get_included_files();
		sort($files);
		return $files;
		
	}
	
	/**
	 * Collect all info about loaded modules in KO
	 * 
	 * @return array
	 */
	public static function modules()
	{
		return Kohana::modules();
		
	}
	
	/**
	 * Collect all info about routes
	 * 
	 * @return array
	 */
	public static function routes()
	{
		return Route::all();
		
	}
	
	/**
	 * Collect all info about session
	 * 
	 * @return array
	 */
	public static function session()
	{
		$session = Session::instance()->as_array();
		ksort($session);
		
		return $session;
	}
	
	/**
	 * Collect all info about get variables
	 * 
	 * @return array
	 */
	public static function get()
	{
		$get = Request::initial()->query();
		ksort($get);
		
		return $get;
	}
	
	/**
	 * Collect all info about post variables
	 * 
	 * @return array
	 */
	public static function post()
	{
		$post = Request::initial()->post();
		ksort($post);
		
		return $post;
	}
	
	/**
	 * Collect all info about queries
	 * 
	 * @return array
	 */
	public static function queries()
	{
		$result = array();
		$count = $time = $memory = 0;

		$groups = Profiler::groups();
		foreach(Database::$instances as $name => $db)
		{
			
			$group_name = 'database (' . strtolower($name) . ')';
			$group = arr::get($groups, $group_name, FALSE);

			if ($group)
			{					
				$sub_time = $sub_memory = $sub_count = 0;
				foreach ($group as $query => $tokens)
				{
					$sub_count += count($tokens);
					foreach ($tokens as $token)
					{
						$total = Profiler::total($token);
						$sub_time += $total[0];
						$sub_memory += $total[1];
						$result[$name][] = array('name' => $query, 'time' => $total[0], 'memory' => $total[1]);
					}
				}
				$count += $sub_count;
				$time += $sub_time;
				$memory += $sub_memory;
				$result[$name]['total'] = array('count'=>$sub_count, 'time'=>$sub_time, 'memory'=>$sub_memory);
			}		
		}
		return array('count' => $count, 'time' => $time, 'memory' => $memory, 'data' => $result);
	}
	
	
	/**
	 * User setting for enable/disable this class
	 * 
	 * @param bool $enabled 
	 */
	public function enabled($enabled)
	{
		$this->_userEnabled = (bool) $enabled;
	}
	
	/** Determines if all the conditions are correct to display the toolbar
	 *
	 * @returns bool toolbar enabled
	 */
	public function is_enabled()
	{
		// User forced enable/disable class?
		if(!is_null($this->_userEnabled))
			return $this->_userEnabled;

		// Don't developerbar yourself
		if(Request::initial()->controller() == 'developerbar')
			return FALSE;
		
		// Don't auto render toolbar for ajax requests
		if (Request::initial()->is_ajax())
			return FALSE;

		// Don't auto render toolbar if $_GET['debug'] = 'false'
		if (isset($_GET['debug']) and strtolower($_GET['debug']) == 'false')
			return FALSE;

		// Don't auto render when in Kohana::PRODUCTION in environment
		if (Kohana::$environment == Kohana::PRODUCTION)
			return FALSE;

		return TRUE;
	}
}