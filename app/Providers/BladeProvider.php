<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    Blade::directive('messages', function($expression){
		    return "<?php echo \Site::checkMessages({$expression}); ?>";
    	});
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
