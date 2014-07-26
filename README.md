codeigniter_native_session
==========================

A Native Session library to CodeIgniter

Install
---------------------

- Put 'native_session.php' into CI's libraries folder:
    application >> libraries >> native_session.php
- In application >> config >> autoload.php, put 'native_session' in libraries array

```php
/*
| -------------------------------------------------------------------
|  Auto-load Libraries
| -------------------------------------------------------------------
| These are the classes located in the system/libraries folder
| or in your application/libraries folder.
*/

$autoload['libraries'] = array('database', 'native_session', 'user_agent');
```

- Set the sess_cookie_name and sess_expiration in: application >> config >> config.php

```php
/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_cookie_name'		= the name you want for the cookie
| 'sess_expiration'			= the number of SECONDS you want the session to last.
|   by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'sess_expire_on_close'	= Whether to cause the session to expire automatically
|   when the browser window is closed
| 'sess_encrypt_cookie'		= Whether to encrypt the cookie
| 'sess_use_database'		= Whether to save the session data to a database
| 'sess_table_name'			= The name of the session database table
| 'sess_match_ip'			= Whether to match the user's IP address when reading the session data
| 'sess_match_useragent'	= Whether to match the User Agent when reading the session data
| 'sess_time_to_update'		= how many seconds between CI refreshing Session Information
|
*/
$config['sess_cookie_name']		= 'mydomain';
$config['sess_expiration']		= 86200;
```

- And now, just use like CI Session.


Instructions
---------------------

### Set a value

```php
$this->native_session->set('key', 'value');

// or an array

$data = array(
  'key1' => 'value1',
  'key2' => 'value2',
);

$this->native_session->set($data);
```

### Get a value

```php
$value = $this->native_session->get('key');
```

### Get all Session (array)

```php
$all_session = $this->native_session->all_session();
```

### Destroy Session

```php
$this->native_session->destroy();
```

Flashdata Instructions
---------------------

### Set a value

```php
$this->native_session->set_flashdata('key', 'value');

// or an array

$data = array(
  'key1' => 'value1',
  'key2' => 'value2',
);

$this->native_session->set_flashdata($data);
```

### Get a value

```php
$value = $this->native_session->get_flashdata('key');
```

### Keep Flashdata

```php
$this->native_session->keep_flashdata();
```
