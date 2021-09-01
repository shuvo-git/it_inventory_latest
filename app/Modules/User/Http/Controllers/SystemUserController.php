<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Log;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class SystemUserController extends Controller {

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('System User Management'))
            abort(403);
        $users = $this->__filter($request);
        $roles = Role::pluck('name', 'name');
        return view("User::system.index", compact('users', 'roles'));
    }

    private function __filter($request) {
        $user = User::query();
        $user->where('type', 'system');

        if ($request->filled('name')) {
            $user->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('mobile_no')) {
            $user->where('mobile_no', 'like', '%'. $request->mobile_no . '%');
        }
        if ($request->filled('email')) {
            $user->where('email','like', '%'. $request->email . '%');
        }

        return $user->orderBy('id', 'desc')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('System User Management'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3',
            'mobile_no' => 'required|string|min:11|max:14',
            'email' => 'sometimes|nullable|email',
            'password' => 'required|confirmed|min:5',
            'role' => 'required|exists:roles,name'
        ]);
        $validPhoneNumber = mobileNoValidate($request->mobile_no,'local');
        if (!$validPhoneNumber) {
            return redirect()->back()->withErrors('Invalid Mobile Number No')->withInput();
        }
        if (unique_mobile_no_check($request->mobile_no, 'system')) {
            return redirect()->back()->withErrors(__('validation.unique', ['attribute' => 'Mobile No']))->withInput();
        }

        if ($request->filled('email')) {
            if (unique_email_check($request->email, 'system')) {
                return redirect()->back()->withErrors(__('validation.unique', ['attribute' => 'Email']))->withInput();
            }
        }

        try {
            DB::begintransaction();

            $user = new User();
            $user->name = $request->name;
            $user->mobile_no = $request->mobile_no;
            $user->email = $request->email;
            $user->type = 'system';
            $user->password = Hash::make($request->password);
            $user->created_at = Carbon::now();
            $user->save();

            $user->assignRole($request->role);

            DB::commit();

            return redirect()->back()->with("success", "User Create Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('System User Management'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3',
            'mobile_no' => 'required|string|min:11|max:14',
            'email' => 'sometimes|nullable|email',
            'role' => 'required|exists:roles,name'
        ]);
        $validPhoneNumber = mobileNoValidate($request->mobile_no,'local');
        if (!$validPhoneNumber) {
            return redirect()->back()->withErrors('Invalid Mobile Number No')->withInput();
        }
        if (unique_mobile_no_check($request->mobile_no, 'system', $id)) {
            return redirect()->back()->withErrors(__('validation.unique', ['attribute' => 'Mobile No']))->withInput();
        }

        if ($request->filled('email')) {
            if (unique_email_check($request->email, 'system', $id)) {
                return redirect()->back()->withErrors(__('validation.unique', ['attribute' => 'Email']))->withInput();
            }
        }

        try {
            DB::begintransaction();
            $user = User::where('type', 'system')->findOrFail($id);
            $user->name = $request->name;
            $user->mobile_no = $request->mobile_no;
            $user->email = $request->email;
            $user->save();

            $user->syncRoles([$request->role]);
            DB::commit();

            return redirect()->back()->with("success", "User Successfully Updated");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function destroy($id) {
        if (!auth()->user()->can('System User Management'))
            abort(403);

        try {
            User::where('id', $id)->where('type', 'system')->delete();

            return redirect()->back()->with("success", "User Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->back()->with('success', "Password successfully changed");
        } else {
            return redirect()->back()->withErrors("Password did not match");
        }
        dd($request->all());
    }

}
