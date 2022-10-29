<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSysUserRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Http\Requests\UpdateSysUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;

class SysUserController extends Controller
{
    public function dt()
    {
        $table = DB::table('v_user');
        return DataTable::generate($table);
    }

    public function index()
    {
        $user = User::with('role')->findOrFail(request('userid'));
        $data = DB::table('v_user');

        if ($user->role->rolename != 'ADMIN' && $user->role->rolename != 'PIU') {
            $data = $data->where('userid', request('userid'));
        }

        /*
            Jika ROLE PIU maka kembalikan data user yang ada pada KAB c PIU tersebut
        */
        if ($user->role->rolename == 'PIU') {
            $p_userid = User::query()
                ->where('kdkab', $user->kdkab)
                ->pluck('userid')
                ->toArray();
            $data = $data->whereIn('userid', $p_userid);
        }


        if (request('wajib_absen')) {
            $data->where('wajib_absen', request('wajib_absen'));
        }

        if (request('aktif')) {
            $data->where('aktif', request('aktif'));
        }

        //dd($data->toSql());
        $data = $data->orderBy('fullname');
        return response()->json($data->get());
    }

    public function show(User $user)
    {
        $user = $user->load(['spot', 'role', 'kab', 'kec', 'desa']);
        return response()->json($user);
    }

    public function store(StoreSysUserRequest $request)
    {
        $user = User::create([
            'fullname' => $request->fullname,
            'nickname' => $request->nickname,
            'photo' => $request->file('photo') ? $request->file('photo')->store('user/photo', 'public') : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nik' => $request->nik,
            'telpno' => $request->telpno,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => Carbon::make($request->tgl_lahir),
            'alamat' => $request->alamat,
            'roleid' => $request->roleid,
            'spotid' => $request->spotid,
            'kdkab' => $request->kdkab ?? null,
            'kdkec' => $request->kdkec ?? null,
            'kddesa' => $request->kddesa ?? null,
            'wajib_absen' => $request->wajib_absen,
            'created_at' => Carbon::now(),
            'created_by' => $request->created_by,
        ]);

        event(new Registered($user));

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $user]);
    }

    public function update(User $user, UpdateSysUserRequest $request)
    {
        $user->update([
            'fullname' => $request->fullname,
            'nickname' => $request->nickname,
            'photo' => $request->avatar_remove === "0" ? null : ($request->file('photo') ? $request->file('photo')->store("user/photo", "public") : $user->photo),
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'nik' => $request->nik,
            'telpno' => $request->telpno,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'roleid' => $request->roleid,
            'spotid' => $request->spotid,
            'kdkab' => $request->kdkab ?? null,
            'kdkec' => $request->kdkec ?? null,
            'kddesa' => $request->kddesa ?? null,
            'wajib_absen' => $request->wajib_absen,
            'modified_at' => Carbon::now(),
            'modified_by' => $request->modified_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $user]);
    }

    public function updateProfile(User $user, UpdateProfilRequest $request)
    {
        $user->update([
            'fullname' => $request->fullname,
            'nickname' => $request->nickname,
            'photo' => $request->avatar_remove === "0" ? null : ($request->file('photo') ? $request->file('photo')->store("user/photo", "public") : $user->photo),
            'email' => $request->email,
            'nik' => $request->nik,
            'telpno' => $request->telpno,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'modified_at' => Carbon::now(),
            'modified_by' => $request->modified_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $user]);
    }

    public function updatePassword(User $user, Request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Password lama tidak sesuai');
                    }
                }
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'modified_at' => Carbon::now(),
            'modified_by' => $request->modified_by,
        ]);

        return response()->json(['message' => 'Data berhasil tersimpan', 'data' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Data berhasil terhapus', 'data' => null]);
    }
}
