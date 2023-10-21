<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function vote(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('user_id') AND $request->input('choice_id') AND $request->input('poll_id')) {
        
            $data_post = [
                'user_id' => $request->input('user_id'),
                'choice_id' => $request->input('choice_id'),
                'poll_id' => $request->input('poll_id'),
            ];

            if (!empty($data_post['user_id'])) {

                if (!empty($data_post['choice_id'])) {

                    if (!empty($data_post['poll_id'])) {

                    DB::table('votes')->insert([
                        'user_id' => $data_post['user_id'],
                        'choice_id' => $data_post['choice_id'],
                        'poll_id' => $data_post['poll_id'],
                    ]);

                    $data['message'] = 'registrasi berhasil';

                } else {
                    $data['message'] = 'deskripsi tidak boleh kosong';
                }
            } else {
                $data['message'] = 'judul tidak boleh kosong';
            }
        }
        }

        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function all()
    {
        //
        $votes = [];

        $data = DB::table('votes')->get();
        
        foreach($data as $loop) {

            $data_users = DB::table('users')->where('id', $loop->user_id)->first();

            if ($data_users) {
                $username = $data_users->username;
            } else {
                $username = '';
            }

            $data_poll = DB::table('polls')->where('id', $loop->poll_id)->first();

            if ($data_poll) {
                $title = $data_poll->title;
            } else {
                $title = '';
            }

            $votes[] = [
                'username' => $username,
                'title' => $title,
                'user_id' => $loop->user_id,
                'choice_id' => $loop->choice_id,
                'poll_id' => $loop->poll_id,
            ];
        }
        
        echo json_encode([
            'status' => 200,
            'message' => 'Data voes',
            'data' => $votes,
        ]);
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
