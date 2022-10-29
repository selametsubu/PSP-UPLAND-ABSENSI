<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\Select2DesaTrait;
use App\Http\Traits\Select2KabTrait;
use App\Http\Traits\Select2KecTrait;
use App\Models\MsFasdes;
use App\Models\MsPengelola;
use App\Models\MsPenyuluh;
use App\Models\SysRole;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    use Select2KabTrait, Select2KecTrait, Select2DesaTrait;

    public function dataCaptha()
    {
        return response()->json([
            'url' => captcha_src()
        ], 200);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $jenis_kelamin = DB::table('v_ref_jenis_kelamin')->get()->toJson();
        $peran = SysRole::query()
            ->where('show_on_register', 1)
            ->get()->toJson();
        return view('auth.register', compact('jenis_kelamin', 'peran'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $role = SysRole::find($request->roleid);

        $request->validate([
            'captcha' => ['required', 'captcha'],
            'fullname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255'],
            'photo' => ['required'],
            'nik' => ['required', 'unique:sys_user'],
            'telpno' => ['required'],
            'tgl_lahir' => ['required'],
            'tgl_join' => ['required'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
            'roleid' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:sys_user'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($role, $request) {

            $user = User::create([
                'fullname' => $request->fullname,
                'nickname' => $request->nickname,
                'photo' => $request->file('photo')->store('user/photo', 'public'),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nik' => $request->nik,
                'telpno' => $request->telpno,
                'tgl_lahir' => Carbon::make($request->tgl_lahir),
                'tgl_join' => Carbon::make($request->tgl_join),
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'roleid' => $request->roleid,
                'kdkab' => $request->kdkab ?? null,
                'kdkec' => $request->kdkec ?? null,
                'kddesa' => $request->kddesa ?? null,
                'created_at' => Carbon::now(),
                'created_by' => 0,
            ]);

            // if ($role->group == 'fasilitator') {
            //     MsFasdes::create([
            //         'nomorid' => DB::select(
            //             'select f_generate_nomorid("F",
            //             "' . $request->kdkab . '",
            //             "' . $request->kdkec . '",
            //             "' . $request->kddesa . '") as nomorid'
            //         )[0]->nomorid,
            //         'nama' => $user->fullname,
            //         'nik' => $user->nik,
            //         'tgl_lahir' => $user->tgl_lahir,
            //         'email' => $user->email,
            //         'kdkab' => $user->kdkab,
            //         'kdkec' => $user->kdkec,
            //         'kddesa' => $user->kddesa,
            //         'alamat' => $user->alamat,
            //         'nohp' => $user->telpno,
            //         'created_at' => $user->created_at,
            //         'created_by' => $user->created_by,
            //         'userid' => $user->userid,
            //         'jenis_kelamin' => $user->jenis_kelamin,
            //         'roleid' => $user->roleid,
            //     ]);
            // } elseif ($role->group == 'pengelola') {
            //     MsPengelola::create([
            //         'nomorid' => DB::select(
            //             'select f_generate_nomorid("N",
            //             "' . $request->kdkab . '",
            //             "' . $request->kdkec . '",
            //             "' . $request->kddesa . '") as nomorid'
            //         )[0]->nomorid,
            //         'nama' => $user->fullname,
            //         'nik' => $user->nik,
            //         'tgl_lahir' => $user->tgl_lahir,
            //         'email' => $user->email,
            //         'kdkab' => $user->kdkab,
            //         'kdkec' => $user->kdkec,
            //         'kddesa' => $user->kddesa,
            //         'alamat' => $user->alamat,
            //         'nohp' => $user->telpno,
            //         'created_at' => $user->created_at,
            //         'created_by' => $user->created_by,
            //         'userid' => $user->userid,
            //         'jenis_kelamin' => $user->jenis_kelamin,
            //         'roleid' => $user->roleid,
            //     ]);
            // } elseif ($role->group == 'penyuluh') {
            //     MsPenyuluh::create([
            //         'nomorid' => DB::select(
            //             'select f_generate_nomorid("Y",
            //             "' . $request->kdkab . '",
            //             "' . $request->kdkec . '",
            //             "' . $request->kddesa . '") as nomorid'
            //         )[0]->nomorid,
            //         'nama' => $user->fullname,
            //         'nik' => $user->nik,
            //         'tgl_lahir' => $user->tgl_lahir,
            //         'email' => $user->email,
            //         'kdkab' => $user->kdkab,
            //         'kdkec' => $user->kdkec,
            //         'kddesa' => $user->kddesa,
            //         'alamat' => $user->alamat,
            //         'nohp' => $user->telpno,
            //         'created_at' => $user->created_at,
            //         'created_by' => $user->created_by,
            //         'userid' => $user->userid,
            //         'jenis_kelamin' => $user->jenis_kelamin,
            //         'roleid' => $user->roleid,
            //     ]);
            // }

            event(new Registered($user));

            return $user;
        });



        return response()->json([
            'message' => 'Pendaftaran berhasil. Silahkan melakukan verifikasi email dan Login ke sistem'
        ], 200);


        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
    }
}
