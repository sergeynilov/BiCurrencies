<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CurrencyHistory;
use App\Models\Settings;
use App\Models\Currency;
use App\Library\CheckValueType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Inertia;
use Auth;
use DB;
use App\Http\Resources\CurrencyResource;


use App\Http\Requests\CurrencyRequest;

class TestController extends Controller  //    http://127.0.0.1:8000/current_rates
{
    public function __construct()
    {
//        $this->middleware(['currency:super-admin|admin|moderator']);
    }


    public function test()
    {
        \Log::info(varDump(-1, ' -1 TestController test::'));

        return Inertia::render('test', []);
    }

}
