<?php
/*
* Caches API calls to a local file which is updated on a given time interval.
*/
class APICache 
{
	private $_update_interval; // how often to update
	private $_cache_file;      // file to save results to
	private $_api_call;        // API call (URL with params)
	
	public function __construct($api_call, $update_interval=10, $cache_file='api_cache.json')
  	{
    	$this->_api_call        = $api_call;
    	$this->_update_interval = $update_interval * 60; // minutes to seconds
    	$this->_cache_file      = $cache_file;
  	}

  	/*
	* Updates cache if last modified is greater than
	* update interval and returns cache contents
	*/
 	public function get_api_cache() 
 	{
    	if(!file_exists($this->_cache_file) || time() - filemtime($this->_cache_file) > $this->_update_interval) 
    	{
      		$this->_update_cache();
    	}
    	return file_get_contents($this->_cache_file);
  	}

  	/*
	* Http expires date
	*/
  	public function get_expires_datetime() 
  	{
    	if(file_exists($this->_cache_file)) 
    	{
      		return date ('D, d M Y H:i:s \G\M\T',filemtime($this->_cache_file) + ($this->_update_interval));
    	}
  	}

  	/*
	* Makes the api call and updates the cache
	*/
  	private function _update_cache() 
  	{
    	$fp = fopen($this->_cache_file, 'a+');

    	if($fp) 
    	{
    		//  acquire an exclusive lock (writer)
      		if (flock($fp, LOCK_EX)) 
      		{
        		$apiData = file_get_contents($this->_api_call);

        		if ($apiData !== FALSE) 
        		{
          			fseek($fp, 0);         // move back to the beginning of the file
          			ftruncate($fp, 0);     // truncates the file
          			fwrite($fp, $apiData); // writes to the file
        		}
        		flock($fp, LOCK_UN); // release a lock
      		}
      		fclose($fp);
    	}
  	}
}