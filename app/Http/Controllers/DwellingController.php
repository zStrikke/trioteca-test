<?php

namespace App\Http\Controllers;

use App\Enums\DwellingStatus;
use App\Http\Requests\StoreDwellingRequest;
use App\Http\Requests\UpdateDwellingRequest;
use App\Http\Requests\UpdateDwellingStatusRequest;
use App\Models\Dwelling;
use App\Models\User;
use App\Notifications\StatusChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DwellingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $dwellings = Dwelling::all();
        return view('management-dwelling', ['dwellings' => $dwellings]);
    }

    public function store(User $user, StoreDwellingRequest $request)
    {
        $user = $request->user();

        $user->dwellings()->create([
            'name' => $request->validated('name'),
            'contact' => $request->validated('contact'),
            'address' => $request->validated('address'),
            'price' => $request->validated('price'),
            'comments' => $request->validated('comments'),
            'status' => DwellingStatus::Requested
        ]);

        return redirect('/home')->with('status', __('Requested sended!'));
    }

    public function show(Dwelling $dwelling)
    {
        return $dwelling;
    }

    public function edit(Request $request)
    {
        return 'edit';
    }

    public function update(Request $request, Dwelling $dwelling)
    {
        return 'update';
    }

    public function updateStatus(UpdateDwellingStatusRequest $request, Dwelling $dwelling)
    {
        $newStatus = DwellingStatus::from($request->validated('status'));
        try {
            $dwelling->transitionStatus($newStatus);
            $request->user()->notify(new StatusChange($dwelling));

            return back()->with('status', __('Status Updated successfully!'));
        } catch (\LogicException $e) {
            report($e);
            return back()->withErrors([
                'invalidTransition' => __('Invalid Transition of the status')
            ]);
        }
    }


    public function delete()
    {
        return 'delete';
    }

    public function logs(Dwelling $dwelling)
    {
        $dwellingLogs = DB::table('logs')
                        ->where('dwelling_id', $dwelling->id)
                        ->get();
        return view('log')->with(compact('dwellingLogs'));
    }

}
