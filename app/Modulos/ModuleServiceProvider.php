<?php

namespace App\Modulos;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Inicializar los modulos
        $modulos = config("module.modulos");
        
        foreach($modulos as $modulo){

            //Si en el archivo config/module.php existe un array dentro de otro, ingresa aqui
            if(is_array($modulo)){
                for($i = 1; $i < count($modulo); $i++){

                    //Cargar el archivo de rutas
                    if(file_exists(__DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/routes.php')){
                        include __DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/routes.php';
                    }

                    //Cargar las vistas
                    if(is_dir(__DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/Views')){
                        $this->loadViewsFrom(__DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/Views', $modulo[0]);
                    }

                    //Cargar el idioma
                    if(is_dir(__DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/lang'.$modulo[$i])){
                        $this->loadTranslationsFrom(__DIR__.'/'.$modulo[0].'/'.$modulo[$i].'/lang'.$modulo[$i], 'lang'.$modulo[$i]);
                    }
                }
            }else{

                //Si el modulo no tiene submodulo, pues ingresa aqui.
                
                //Cargar el archivo de rutas
                if(file_exists(__DIR__.'/'.$modulo.'/routes.php')){
                    include __DIR__.'/'.$modulo.'/routes.php';
                }

                //Cargar las vistas
                if(is_dir(__DIR__.'/'.$modulo.'/Views')){
                    $this->loadViewsFrom(__DIR__.'/'.$modulo.'/Views', $modulo);
                }

                //Cargar el idioma
                if(is_dir(__DIR__.'/'.$modulo.'/lang'.$modulo)){
                    $this->loadTranslationsFrom(__DIR__.'/'.$modulo.'/lang'.$modulo, 'lang'.$modulo);
                }

            }
        }
    }
}
