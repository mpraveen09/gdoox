<?php return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mongodb'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */
  'connections' => [
		'mongodb' => [
		'driver'   => 'mongodb',
		'host'     => 'localhost',
		'port'     => 27017,
		'username' => 'deep',
		'password' => 'qwas321', 
		'database' => 'gdoox_trial',
		'options' => array(
			'db' => 'admin' // sets the authentication database required by mongo 3
			)
		],
  //mongodump -d gdoox -o dump/
//mongorestore -h ds047124.mongolab.com:47124 -d heroku_w24zgwk3 -u heroku_gdoox -p qwaszxXZSAWQ1! dump/gdoox/

  //AMAZON 
//  'connections' => [
//		'mongodb' => [
//		'driver'   => 'mongodb',
//		'host'     => 'ds039341.mlab.com',
//		'port'     => 39341,
//		'username' => 'aws_gdoox',
//		'password' => 'qwaszxXZSAWQ1!',
//		'database' => 'gdooxdemo',
//		'options' => array(
//			'db' => 'gdooxdemo'  //sets the authentication database required by mongo 3
//			)
//		],
  //HEROKU
//  'connections' => [
//		'mongodb' => [
//		'driver'   => 'mongodb',
//		'host'     => 'ds035985.mongolab.com',
//		'port'     => 35985,
//		'username' => 'heroku_gdoox',
//		'password' => 'qwaszxXZSAWQ1!',
//		'database' => 'heroku_821q7qs6',
//		'options' => array(
//			'db' => 'heroku_821q7qs6'  //sets the authentication database required by mongo 3
//			)
//		],
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => storage_path('database.sqlite'),
            'prefix'   => '',
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
        ],

    ],

];
