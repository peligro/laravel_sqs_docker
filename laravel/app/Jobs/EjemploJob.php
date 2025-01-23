<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Ejemplo;
use Illuminate\Http\Request;
class EjemploJob implements ShouldQueue
{
    use  Queueable;

    public  string $mensaje;
    
    /**
     * Create a new job instance.
     */
    public function __construct(string $mensaje)
    {
        $this->mensaje = $mensaje;
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /*
        //info("Procesando mensaje: {$this->mensaje}");
        $save=new Ejemplo ;
        $save->mensaje=$this->mensaje;
        $save->estado=0;
        $save->fecha=date("Y-m-d H:i:s");
        $save->save();  
        //\Log::info('Processing job with message: ' . $this->mensaje);
        //logger("Mensaje procesado: " . $this->mensaje);
        //info("Trabajo completado: {$this->mensaje}");
        */

        try {
            // Tu lógica aquí
            info("Procesando mensaje: {$this->mensaje}");
            $save=new Ejemplo ;
            $save->mensaje=$this->mensaje;
            $save->estado=0;
            $save->fecha=date("Y-m-d H:i:s");
            $save->save();  
            // Simula un error
            throw new \Exception("Ocurrió un error");
        } catch (\Exception $e) {
            logger()->error("Error procesando mensaje: {$e->getMessage()}");
        }
    }
}
