<?php defined('SYSPATH') or die('No direct script access.');

class Developerbar
{
	
	protected $content;
	
	public static function render(){
		
		echo self::generate();
		
	}
	
	public static function generate(){
		
		if(!self::is_enabled())
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
		
		
		
		// Rendering data
		$content = View::Factory('developerbar/developerbar')
				->bind('queries', $queries)
				->bind('files', $files)
				->render();
		
		return $content;
	}
	
	public static function files()
	{
		$files = (array)get_included_files();
		sort($files);
		return $files;
		
	}
	
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
	
	
	/** Determines if all the conditions are correct to display the toolbar
	 * (pretty kludgy, I know)
	 *
	 * @returns bool toolbar enabled
	 */
	public static function is_enabled()
	{
		
		// Don't developerbar yourself
		if(Request::initial()->controller() == 'developerbar')
			return FALSE;
		
		// Don't auto render toolbar for ajax requests
		if (Request::initial()->is_ajax())
			return FALSE;

		// Don't auto render toolbar if $_GET['debug'] = 'false'
		if (isset($_GET['debug']) and strtolower($_GET['debug']) == 'false')
			return FALSE;

		// Don't auto render if auto_render config is FALSE
		//if (Kohana::config('debugbar.auto_render') !== TRUE)
			//return FALSE;

		// Auto render if secret key isset
		//$secret_key = Kohana::config('debugbar.secret_key');
		//if ($secret_key !== FALSE and isset($_GET[$secret_key]))
		//	return TRUE;

		// Don't auto render when in PRODUCTION (this can obviously be
		// overridden by the above secret key)
		if (Kohana::$environment == Kohana::PRODUCTION)
			return FALSE;

		return TRUE;
	}
}