<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use App\Library\CheckValueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Auth;
use DB;
use App\Http\Resources\UserResource;


use App\Http\Requests\UserRequest;

class UserController extends Controller  //    http://127.0.0.1:8000/admin/users
{
    public function __construct()
    {
//        $this->middleware(['user:super-admin|admin|moderator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }
        \Log::info(varDump(-1, ' -1 UserController ::'));

        return Inertia::render('Admins/Users/Index', []);
    }

    public function filter()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }
        $request                = request();
        $backend_items_per_page = Settings::getValue('backend_items_per_page', CheckValueType::cvtInteger, 20);
        \Log::info(varDump($backend_items_per_page, ' -1 filter $backend_items_per_page::'));

        $page            = $request->page ?? 1;
        $filter_name     = $request->filter_name ?? '';
        $filter_email     = $request->filter_email ?? '';
        $filter_status     = $request->filter_status ?? '';
        $order_by        = $request->order_by ?? 'name';
        $order_direction = $request->order_direction ?? 'desc';

        $users = User
            ::getByName($filter_name)
            ->getByEmail($filter_email)
            ->getByStatus($filter_status)
//            ->whereRaw(with(new User)->getTable().'.id  >= 30 ') // DEBUGGING

            ->orderBy($order_by, $order_direction)
            ->paginate($backend_items_per_page, array('*'), 'page', $page);

        \Log::info(varDump(UserResource::collection($users), ' -1 filter $users::'));

        return (UserResource::collection($users));
    } // public function filter()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }
        return Inertia::render('Admins/Users/Create', [
            'user' => new User,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }

        \Log::info('-1 store $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))->with([
                'flash', 'You have no access to store user'
            ]);
        }
        $user = null;
        try {
            DB::beginTransaction();

            $newUser = app(CreateNewUser::class)->create([
                'name'         => workTextString($request->name),
                'email'        => $request->email,
                'status'       => $request->status,
                'account_type' => $request->account_type,
                'first_name'   => workTextString($request->first_name),
                'last_name'    => workTextString($request->last_name),
                'phone'        => workTextString($request->phone),
                'website'      => workTextString($request->website),
                'notes'        => workTextString($request->notes),
                'activated_at' => ($request->status == 'A' ? Carbon::now(config('app.timezone')) : null),
                //'avatar' => 'shawn_hadray.jpg',
            ], false, [ 'user' /*PERMISSION_CUSTOMER*/ ]);


//            \Log::info(varDump($newUser::class, ' -1 $newUser::class::'));
            \Log::info(varDump($newUser, ' -1 $newUser::'));
            if(empty($newUser) or $newUser::class == 'Illuminate\Support\MessageBag') {
                return redirect(route('admin.dashboard.index'))
                    ->with( 'flash', 'warning_flash_type_Invalid validation');

//                $this->dispatchBrowserEvent('AdminPageMessageWarning', [
//                    'title'   => 'Admin Users Crud',
//                    'message' => 'Run time error : Invalid validation',
//                ]);
                DB::rollBack();
                return;
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UserController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }
        \Log::info('-1 store $user->id::' . print_r($user->id, true));


        return redirect(route('admin.users.edit', $user->id)   /*'/admin/users/' . $user->id . '/edit'*/)->with('flash',
            'New user was successfully added');


    } // public function store(UserRequest $request)

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $user_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }

        \Log::info(varDump($user_id, ' -1 edit $user_id::'));
        $user = User
            ::getById($user_id)
            ->first();

        if (empty($user)) {
            return redirect(route('admin.users.index') );
        }
        \Log::info(varDump($user, ' -12 edit $user::'));

        return Inertia::render('Admins/Users/Edit', [
            'user' => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, int $user_id)
    {
        \Log::info('-1 update $request->all()::' . print_r($request->all(), true));
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to user listing');
        }

        $user = User
            ::getById($user_id)
            ->first();


        try {
            DB::beginTransaction();

            $user->name       = $request->name;
            $user->email   = $request->email;
            $user->status  = $request->status;
            $user->updated_at = Carbon::now(config('app.timezone'));
            $user->save();

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            \Log::info('-1 UserController store $e->getMessage() ::' . print_r($e->getMessage(), true));

            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return redirect(route('admin.users.index'))->with('flash', 'User was successfully updated');
    }
    public function destroy(int $user_id)
    {
        if ( ! auth()->user()->can(ACCESS_APP_ADMIN_LABEL)) {
            return redirect(route('admin.dashboard.index'))
                ->with( 'flash', 'warning_flash_type_You have no access to destroy user');
        }

        $user = User::find($user_id+1000);
        if ($user == null) {
            \Log::info(varDump(-1000, ' -1000 destroy  $user_id::'));
            return redirect( route('admin.users.index') )->with('flash', 'warning_flash_type_User was not found !');

        }
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();

        } catch (QueryException $e) {
            DB::rollBack();
//            \Log::info('-1 UserController destroy $e->getMessage() ::' . print_r($e->getMessage(), true));
            return back()->withErrors(['message' => $e->getMessage()]);
        }

        return back();
    }
}
