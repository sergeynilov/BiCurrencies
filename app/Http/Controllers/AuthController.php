<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredStep1;
use App\Mail\UserRegistered;
use App\Models\ContactUs;
use App\Models\Settings;
use App\Models\CMSItem;
use App\Models\User;
use App\Models\UserCurrencySubscription;
use App\Library\CheckValueType;

//use Carbon\Carbon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Exception;
use Auth;
use DB;

use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\UserRegisterConfirmationCodeRequest;
use App\Http\Requests\UploadUserRegisterAvatarRequest;
use App\Http\Requests\RegisterRequest;

//use App\Notifications\ContactUsCreatedNotification;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    // Route::get('/register_wizard', [AuthController::class, 'register_wizard'])->name('register_wizard');
    public function register_wizard()
    {
        return Inertia::render('Auth/RegisterWizard',
            ['user_register_wizard_step' => 1]
        );
    }

    public function register_step_1(RegisterStep1Request $request)
    {
        \Log::info('-1 AuthController register_step_1 $request->all()::' . print_r($request->all(), true));

        $newUser = null;
        try {
            DB::beginTransaction();
            $confirmation_code = Str::random(8);

            $newUser = app(CreateNewUser::class)->create([
                'name'              => workTextString($request->name),
                'email'             => $request->email,
                'status'            => 'A',
                'password'          => $request->password,
                'password_2'        => $request->password_2,
                'confirmation_code' => $confirmation_code,
            ], true, []);


            \Log::info('-1 $newUser::class ::' . print_r(json_encode($newUser::class), true));
            \Log::info(varDump($newUser, ' -1 $newUser::'));
            if (empty($newUser) or $newUser::class == 'Illuminate\Support\MessageBag') {
                \Log::info(varDump($newUser->getMessages(), ' -1 $newUser->getMessages()::'));
                foreach ($newUser->getMessages() as $next_field_name => $nextErrorMessage) {
                    if ( ! empty($nextErrorMessage[0])) {
                        \Log::info(varDump($nextErrorMessage[0], ' -1 $nextErrorMessage[0]::'));
//                        $this->addError($next_field_name, $nextErrorMessage[0]);
                    }
                }
            }
            $site_mame = config('app.name');
            \Mail::to($request->email)->send(new UserRegisteredStep1(
                $site_mame,
                $newUser,
                $confirmation_code));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            \Log::info('-1 $contactUs store $e->getMessage() ::' . print_r($e->getMessage(), true));
            return back()->withErrors(['message' => $e->getMessage()]);
            /* catch(Excpetion) {
   return redirect()->back()->withErrors([
      'create' => 'ups, there was an error'
   ]) */
        }

        //Route::get('/register_wizard_step_2', [AuthController::class, 'register_wizard_step_2'])->name('register_wizard_step_2');
        //         const new_registered_user_id = ref(props.new_registered_user_id)
        //        const new_registered_user_email = ref(props.new_registered_user_email)
        //Route::get('/register_wizard_step_2/{user_id}', [AuthController::class, 'register_wizard_step_2'])->name('register_wizard_step_2');
        return redirect(route('register_wizard_step_2', $newUser->id))
            ->with('flash','You have registered successfully. Check your email with confirmation code')
            ->with('flash_type', 'error');

        /*        return Inertia::render('Auth/RegisterWizard',
                    [
                        'user_register_wizard_step'=>2,
                        'new_user_id'=>$newUser->id,
                        'new_user_email'=>$newUser->email,
                    ]
                );*/
    } // public function register_step_1(RegisterStep1Request $request)

    public function register_wizard_step_2($user_id)
    {
        $user = User
            ::getById($user_id)
            ->first();

        \Log::info(varDump($user, ' -2 register_wizard_step_2 $user::'));

        return Inertia::render('Auth/RegisterWizard',
            [
                'user_register_wizard_step' => 2,
                'new_registered_user_id'    => $user->id,
                'new_registered_user_email' => $user->email
            ]
        );
    }


    public function register_step_confirmation_code(UserRegisterConfirmationCodeRequest $request)
    {
        \Log::info('-1 AuthController register_step_confirmation_code $request->all()::' . print_r($request->all(),
                true));
        $user_email = $request->user_email;
        $user_id    = (int)$request->user_id;


//        $confirmation_code_expire_hours = config('app.confirmation_code_expire_hours', 24);
//        \Log::info(varDump($confirmation_code_expire_hours, ' -1 confirmation_code_expire_hours::'));
        //              'confirmation_code' => 'required|min:8|max:8| ' . 'check_valid_confirmation_code:' . $request->confirmation_code . ','
        //                                   . $request->user_email . ',' . $request->user_id
        $user                    = User
            ::getByEmail($user_email)
            ->getById($user_id)
            ->first();
        $user->status            = 'A';
        $user->confirmation_code = null;
        $user->save();

        return redirect(route('register_wizard_step_3', $user->id))->with('flash',
            'Your account was activated successfully. You can add more information to your account!')
            ->with('flash_type', 'success');


//        return Inertia::render('Frontend/Home/Home',
//            ['user'=> $user]
//        );
        /*        return Inertia::render('Auth/RegisterWizard',
                    [
                        'user_register_wizard_step'=> 3,
                        'new_user_id'=>$user->id,
                        'new_user_email'=>$user->email,
                    ]
                );*/
    }


    public function register_wizard_step_3($user_id)
    {
        $user = User
            ::getById($user_id)
            ->first();

        \Log::info(varDump($user, ' -2 register_wizard_step_3 $user::'));

        return Inertia::render('Auth/RegisterWizard',
            [
                'user_register_wizard_step' => 3,
                'new_registered_user_id'    => $user->id,
                'new_registered_user_email' => $user->email
            ]
        );
    }

    public function register_step_upload_avatar(UploadUserRegisterAvatarRequest $request)
    {
        \Log::info('-1 register_step_upload_avatar $request->all()::' . print_r($request->all(), true));

        $user = User::find($request->user_id);
        /*        if ($user === null) {
        //            return Inertia::render('Frontend/Home/Home', [
        //                'user' => null,
        //                'message'  => 'User # "' . $request->user_id . '" not found for avatar uploading!',
        //            ]);

                    return response()->json([
                        'message'  => 'User # "' . $request->user_id . '" not found for avatar uploading!',
                        'user' => null
                    ], HTTP_RESPONSE_NOT_FOUND);
                }*/

        $userImageUploadedFile = $request->file('image');
        \Log::info(varDump($userImageUploadedFile->getPathName(),
            ' -1 $userImageUploadedFile->getPathName()::'));

        $uploadedAvatar = null;
        try {
            DB::beginTransaction();

            if ( ! empty($userImageUploadedFile)) {
                $image_filename = checkValidFilename($request->image_filename, 255, true);
                $uploadedAvatar = $user
                    ->addMediaFromRequest('image')
                    ->usingFileName($image_filename)
                    ->toMediaCollection(config('app.media_app_name'));

                $user->updated_at = Carbon::now(config('app.timezone'));
                $user->save();
            } // if ( ! empty($userImageUploadedFile)) {

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return Inertia::render('Auth/RegisterWizard',
            [
                'user_register_wizard_step' => 3,
                'new_user_id'               => $user->id,
                'new_user_email'            => $user->email,
            ]
        );
    } // public function register_step_upload_avatar(CreateCustomerRequest $request)

    public function register_wizard_step_4($user_id)
    {
        $user = User
            ::getById($user_id)
            ->first();

        \Log::info(varDump($user, ' -4 register_wizard_step_4 $user::'));

        return Inertia::render('Auth/RegisterWizard',
            [
                'user_register_wizard_step' => 4,
                                'new_registered_user_id'    => $user->id,
                                'new_registered_user_email' => $user->email
            ]
        );
    }

    public function save_user_register_currency_subscriptions(Request $request)
    {
//        \Log::info('-1 save_user_register_currency_subscriptions $request->all()::' . print_r($request->all(), true));
        $user = User::find($request->user_id);
        if ($user === null) {
            return response()->json([
                'message' => 'User # "' . $request->user_id . '" not found for currency subscriptions saving!',
                'user'    => null
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        $rows_added = 0;
        try {
            DB::beginTransaction();
            $selectedCurrencies = $request->selectedCurrencies ?? [];
//            \Log::info(  varDump($selectedCurrencies, ' -1 $selectedCurrencies::') );

            foreach ($selectedCurrencies as $next_selected_currency_id) {
                UserCurrencySubscription::create([
                    'currency_id' => $next_selected_currency_id,
                    'user_id'     => $request->user_id
                ]);
                $rows_added++;
            }

            DB::commit();
        } catch (Exception $e) {//
            DB::rollBack();

            return response()->json(['message' => $e->getMessage(), 'category' => null],
                HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return Inertia::render('Auth/RegisterWizard',
            [
                'user_register_wizard_step' => 4,
                'new_user_id'               => $user->id,
                'new_user_email'            => $user->email,
            ]
        );
    } // public function save_user_register_currency_subscriptions(Request $request)


    public function reset_user_register($user_id=null) {
        \Log::info(  varDump($user_id, ' -1 reset_user_register $user_id::') );
        $user = User::find($user_id);
        if( !empty($user) ) {
            $user->delete();
        }
        return redirect(route('home'));
    }

}
