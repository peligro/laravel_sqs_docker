<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Http\Response; 
use Illuminate\Support\Facades\Storage;

class S3Controller extends Controller
{
    public function s3_upload_storage(Request $request)
    {
       
        $validator = \Validator::make($request->all(), 
            [
                'file' => 'required|file|mimes:jpg,jpeg,png|max:4096', // 2MB máximo
            ],
            [
                'file.required'=>'El campo file está vacío',
                'file.file'=>'El campo file no es válido',
                'file.mimes'=>'El campo file debe tener formato JPG|PNG',
                'file.min'=>'El campo file no debe ser mayor a 2 megas',
            ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $file = $request->file('file');

        // Crear un nombre personalizado
        $archivo = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Subir el archivo al disco 'public' con el nombre personalizado
        $path = $file->storeAs('uploads', $archivo, 'public');

        // Obtener la URL del archivo
        $url = asset('storage/' . $path);
        return response()->json([
            'estado' => 'ok',
            'mensaje' => 'Se sube el archivo exitosamente',
            'archivo'=>$archivo,
            'subida'=>$url
        ], 201);
    }
    public function s3_upload_storage_borrar()
    {
            // Verifica si el archivo existe en el disco 'public'
        if (Storage::disk('public')->exists($_GET['id'])) {
            // Elimina el archivo
            Storage::disk('public')->delete($_GET['id']);

            return response()->json([
                'estado' => 'ok',
                'mensaje' => 'Se elimina el archivo exitosamente'
            ], 200);
        } else {
            return response()->json([
                'estado' => 'error',
                'mensaje' => 'Recurso no disponible'
            ], 400);
        }
        
    }
    public function s3_upload_s3(Request $request)
    {
       
        $validator = \Validator::make($request->all(), 
            [
                'file' => 'required|file|mimes:jpg,jpeg,png|max:4096', // 2MB máximo
            ],
            [
                'file.required'=>'El campo file está vacío',
                'file.file'=>'El campo file no es válido',
                'file.mimes'=>'El campo file debe tener formato JPG|PNG',
                'file.min'=>'El campo file no debe ser mayor a 2 megas',
            ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
       
        $file = $request->file('file');

        // Crear un nombre personalizado
        $archivo = 'uploads/' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
    
        // Subir el archivo al disco 's3' con el nombre personalizado
        $path = Storage::disk('s3')->put($archivo, file_get_contents($file));
    
        // Obtener URL pública del archivo
        $url = Storage::disk('s3')->url($archivo);
        return response()->json([
            'estado' => 'ok',
            'mensaje' => 'Se sube el archivo exitosamente',
            'archivo'=>$archivo,
            'subida'=>$url
        ], 201);
    }
    public function s3_upload_s3_borrar()
    {
        
        if (Storage::disk('s3')->exists($_GET['id'])) {
            Storage::disk('s3')->delete($_GET['id']);
    
            return response()->json([
                'estado' => 'ok',
                'mensaje' => 'Se elimina el archivo exitosamente'
            ], 200);
        } else {
            return response()->json([
                'estado' => 'error',
                'mensaje' => 'Recurso no disponible'
            ], 400);
        }
    }
}
