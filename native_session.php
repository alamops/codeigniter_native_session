<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Native_Session
{
    public $sess_name;
    public $sess_expire_time;

    public function __construct()
    {
        // Load CI
        $CI =& get_instance();

        // Set session name
        $this->sess_name = $CI->config->item('sess_cookie_name');

        // Set session expire
        $this->sess_expire_time = $CI->config->item('sess_expiration');

        // Init Session
        session_start();

        // Verify Session Part 1
        if(isset($_SESSION[$this->sess_name]) && $_SESSION[$this->sess_name])
        {
            if(!$this->verify_expire_time())
                $this->destroy();
            else
            {
                // Verify Keep flash
                if(isset($_SESSION[$this->sess_name]['keep_flash']))
                    $_SESSION[$this->sess_name]['keep_flash'] = false;
                else
                    $this->destroy_flashdata();
            }
        }

        // Verify Session Part 2
        if(!isset($_SESSION[$this->sess_name]) || !$_SESSION[$this->sess_name])
        {
            $_SESSION[$this->sess_name] = array();
            // Add expire time
            $_SESSION[$this->sess_name]['expire'] = time() + $this->sess_expire_time;
            // Flashdata
            $_SESSION[$this->sess_name]['flashdata'] = array();
            // Keep Flash
            $_SESSION[$this->sess_name]['keep_flash'] = false;
        }
    }

    // VERIFY EXPIRE TIME
    private function verify_expire_time()
    {
        if((time() - $_SESSION[$this->sess_name]['expire']) < $this->sess_expire_time)
            return true;
        else
            return false;
    }

    // SET SESSION
    public function set($key, $value = null)
    {
        if($key)
        {
            // Verify if is an array
            if(is_array($key))
                $this->_setarray($key);
            else
                $_SESSION[$this->sess_name][$key] = $value;

            return true;
        }
        else
            return null;
    }

    // SET SESSION ARRAY
    private function _setarray($data)
    {
        foreach ($data as $key => $value)
            $_SESSION[$this->sess_name][$key] = $value;
    }

    // GET A SESSION INSTANCE
    public function get($key)
    {
        if(isset($_SESSION[$this->sess_name][$key]))
            return $_SESSION[$this->sess_name][$key];
        else
            return null;
    }

    // GET ALL SESSION
    public function all_session()
    {
        if($this->verify_expire_time())
            return $_SESSION[$this->sess_name];
        else
        {
            $this->destroy();
            return false;
        }
    }

    // DESTROY SESSION
    public function destroy()
    {
        session_destroy();
    }

    /*
        FLASH DATA
     */
    
    // SET FLASH DATA
    public function set_flashdata($key, $value = null)
    {
        if($key)
        {
            // Verify if it is an array
            if(is_array($key))
                $this->_setflashdataarray($key);
            else
                $_SESSION[$this->sess_name]['flashdata'][$key] = $value;

            $this->keep_flashdata();

            return true;
        }
        else
            return null;
    }

    // GET AN FLASH DATA INSTANCE
    public function get_flashdata($key)
    {
        if(isset($_SESSION[$this->sess_name]['flashdata'][$key]))
            return $_SESSION[$this->sess_name]['flashdata'][$key];
        else
            return null;
    }

    // KEEP FLASH DATA
    public function keep_flashdata()
    {
        $_SESSION[$this->sess_name]['keep_flash'] = true;
    }

    // SET FLASH DATA ARRAY
    private function _setflashdataarray($data)
    {
        foreach ($data as $key => $value)
            $_SESSION[$this->sess_name]['flashdata'][$key] = $value;
    }

    // DESTROY FLASH DATA
    public function destroy_flashdata()
    {
        $_SESSION[$this->sess_name]['flashdata'] = array();
    }

}

/* End of file Native_Session.php */
