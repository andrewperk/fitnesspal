This is your Logger Application. It's a plugin which can be added 
to any CakePHP 2.X application.

The Plugin consists of the following functionality:

-Stand alone authentication
-Default Admin User created



Installation

1. Copy the Plugin into your Cake's /app/Plugin/ directory.

   Make sure the plugin folder itself is named "Logger".

2. Load the plugin in your /app/Config/bootstrap file:
   
   CakePlugin::load('Logger', array('bootstrap'=>true, 'routes'=>true));

3. Change the default Logger Admin and Password in the /app/Plugin/Logger/Config/bootstrap.php file

4. Make sure you have the $logger database config set up in your /app/Config/database.php file

   public $logger = array(
   	// Your DB credentials
   );

4. Generate the table's schema for the Logger in your console:

   // The -c tells it which DB connection to use
   // The -p tells it to use the schema from the Logger Plugin

   $ cd /path/to/cakeapp/app/
   $ ./Console/cake schema create logger -c logger -p Logger