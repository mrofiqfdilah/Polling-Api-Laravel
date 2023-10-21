<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use League\CommonMark\Extension\CommonMark\Parser\Inline\HtmlInlineParser;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('username') AND $request->input('password')) {
        
            $data_post = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ];

            $data_users = DB::table('users')->where('username', $data_post['username'])->first();

            if ($data_users) {
                
                if ($data_post['password'] == $data_users->password) {

                    $token_login = uniqid();

                    DB::table('users')->where('id', $data_users->id)->update([
                        'token_login' => $token_login,
                    ]);

                    $data['status'] = 200;
                    $data['message'] = 'login telah berhasil';
                    $data['data'] = [
                        'token' => $token_login,
                    ];
                } else {
                    $data['message'] = 'password salah';
                }
            } else {
                $data['message'] = 'username salah';
            }
        } else {
            $data['message'] = 'parameter belum lengkap';
        }

        echo json_encode($data);
    }

    public function daftarakun(Request $request)
    {

        if  ($request->input('username')) {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://127.0.0.1:8000/api/auth/register',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                    'role' => $request->input('role'),
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response, true);

            var_dump($response); die;

        }

        return view('daftarakun');
    }

    public function loginakun(Request $request)
    {
        return view('loginakun');
    }
    public function halamanuser(Request $request)
    {
        return view('halamanuser');
    }
    public function halamanadmin(Request $request)
    {
        $vote = DB::table('votes')->get();

        return view('halamanadmin', compact('vote'));
    }


    public function register(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('username') AND $request->input('password')) {
        
            $data_post = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
            ];

            if (!empty($data_post['username'])) {

                if (!empty($data_post['password'])) {

                    if (in_array($data_post['role'], ['Member', 'Admin'])) {

                        $cek_users = DB::table('users')->where('username', $data_post['username'])->first();

                        if ($cek_users == null) {

                            DB::table('users')->insert([
                                'username' => $data_post['username'],
                                'password' => $data_post['password'],
                                'role' => $data_post['role'],
                                'token_login' => '',
                            ]);

                            $data['message'] = 'registrasi berhasil';

                        } else {
                            $data['message'] = 'username sudah terdaftar';
                        }
                    } else {
                        $data['message'] = 'role hanya boleh Admin / Member';
                    }
                } else {
                    $data['message'] = 'password tidak boleh kosong';
                }
            } else {
                $data['message'] = 'username tidak boleh kosong';
            }
        } else {
            $data['message'] = 'parameter belum lengkap';
        }

        echo json_encode($data);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('token')) {
        
            $data_post = [
                'token' => $request->input('token'),
            ];

            $data_users = DB::table('users')->where('token_login', $data_post['token'])->first();

            if ($data_users) {

                DB::table('users')->where('id', $data_users->id)->update([
                    'token_login' => '',
                ]);

                $data['status'] = 200;
                $data['message'] = 'logout dari akun telah berhasil';
                    
            } else {
                $data['message'] = 'token tidak terdaftar';
            }
        } else {
            $data['message'] = 'parameter belum lengkap';
        }

        echo json_encode($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function me(Request $request)
    {
        $data = [
            'status' => 401,
            'message' => 'parameter diperlukan',
            'data' => [],
        ];
        
        if ($request->input('token')) {
        
            $data_post = [
                'token' => $request->input('token'),
            ];

            $data_users = DB::table('users')->where('token_login', $data_post['token'])->first();

            if ($data_users) {

                $data['status'] = 200;
                $data['message'] = 'data akun';
                $data['data'] = [
                    'username' => $data_users->username,
                    'password' => $data_users->password,
                ];  
            } else {
                $data['message'] = 'token tidak terdaftar';
            }
        } else {
            $data['message'] = 'parameter belum lengkap';
        }

        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     */
    public function reset_password(string $id)
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
