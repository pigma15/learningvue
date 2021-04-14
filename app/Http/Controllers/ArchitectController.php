<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use App\Http\Resources\ArchitectResource;
use Illuminate\Http\Request;
use Response;

class ArchitectController extends Controller
{

    public function index()
    {
        return Response::json(
            [
                'architects' => ArchitectResource::collection(Architect::all()),
            ]
        );
    }

    public function create(Request $request)
    {
        $architect = null;
        $error = null;
        
        if (isset($request['name']) && '' != $request['name'] && !preg_match('/<script>/', $request['name']) && !preg_match('/onerror/', $request['name']) && 30 > mb_strlen($request['name'])) {
            $architect['name'] = $request['name'];
        } else {
            $error['name'] = 'invalid name';
        }

        if (isset($request['surname']) && '' != $request['surname'] && !preg_match('/<script>/', $request['surname']) && !preg_match('/onerror/', $request['surname']) && 30 > mb_strlen($request['surname'])) {
            $architect['surname'] = $request['surname'];
        } else {
            $error['surname'] = 'invalid surname';
        }

        if (isset($request['about']) && '' != $request['about'] && !preg_match('/<script>/', $request['about']) && !preg_match('/onerror/', $request['about']) && 1000 > mb_strlen($request['about'])) {
            $architect['about'] = $request['about'];
        } else {
            $error['about'] = 'invalid about section';
        }

        if(null === $error) {
            Architect::create($architect);
            return Response::json(
                [
                    'success' => ['name' => $architect['name'], 'surname' => $architect['surname']]
                ]
            );
        }
        
        return Response::json(
            [
                'architect' => $architect,
                'error' => $error
            ]
        );
    }
    
}
