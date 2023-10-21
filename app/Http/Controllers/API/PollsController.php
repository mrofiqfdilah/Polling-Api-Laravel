<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('title') AND $request->input('deskripsi')) {
        
            $data_post = [
                'title' => $request->input('title'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            if (!empty($data_post['title'])) {

                if (!empty($data_post['deskripsi'])) {

                    DB::table('polls')->insert([
                        'title' => $data_post['title'],
                        'deskripsi' => $data_post['deskripsi'],
                    ]);

                    $data['message'] = 'registrasi berhasil';

                } else {
                    $data['message'] = 'deskripsi tidak boleh kosong';
                }
            } else {
                $data['message'] = 'judul tidak boleh kosong';
            }
        }

        echo json_encode($data);
    }


    public function allpoll()
    {
        $data_polls = [];

        $polls = DB::table('polls')->get();
        
        foreach($polls as $loop) {
            $data_polls[] = [
                'title' => $loop->title,
                'deskripsi' => $loop->deskripsi,
            ];
        }

        echo json_encode([
            'status' => 200,
            'message' => 'Data semua polls',
            'data' => $data_polls,
        ]);
    }

    public function getapoll(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        if ($request->input('polls_id')) {
            $data_post = [
                'id' => $request->input('polls_id'),
            ];
            $data_polls = DB::table('polls')->where('id', $data_post['id'])->first();

            if ($data_polls) {

                $data['status'] = 200;
                $data['message'] = 'data poll';
                $data['data'] = [
                    'title' => $data_polls->title,
                    'deskripsi' => $data_polls->deskripsi,
                ];  
            } else {
                $data['message'] = 'token tidak terdaftar';
            }
        }else{
            $data['message'] = 'parameter id diperlukan';
        }
        
        

        echo json_encode($data);
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
