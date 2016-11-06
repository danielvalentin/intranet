<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Http\Models\Image;
use App\Http\Models\Imageversion;

class ImageProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		// Making files create a thumbnail when created
		Image::created(function($image){
			$image->getVersion(120, 120);
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
