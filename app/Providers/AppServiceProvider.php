<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => 'Hai, ' . auth()->user()->name . '!',
                // 'topnav' => true,
                'icon' => 'avatar'
            ]);
            $event->menu->add(...collect($this->prepareMenu(menu('frontend', '_json'))->toArray()));
        });

        Blade::directive('rupiah', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 2, ',', '.'); ?>";
        });

        Blade::directive('ribuan', function ($amount) {
            return "<?php echo number_format($amount, 2, ',', '.'); ?>";
        });
    }

    private function prepareMenu($array)
    {
        return $array->map(function ($menu) {
            if (count($menu['children']) > 0) {
                (is_array($menu['children']));

                return [
                    'text' => $menu['title'],
                    'icon_color' => $menu['color'],
                    'icon' => $menu['icon_class'],
                    'submenu' => $this->prepareMenu($menu['children'])->toArray(),
                    'active' => [str_replace('/', '', $menu['url']), str_replace('/', '', $menu['url']) . '/*']
                ];
            } else {
                return [
                    'text' => $menu['title'],
                    'icon_color' => $menu['color'],
                    'icon' => $menu['icon_class'],
                    'url' => $menu['url'],
                    'active' => [str_replace('/', '', $menu['url']), str_replace('/', '', $menu['url']) . '/*']
                ];
            }
                
        });
    }
}
