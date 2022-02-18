<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResidentDetail;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use App\Models\Avatar;

class ResidentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residentDetails = [];
        $id = Auth::user()->id;
        if(Auth::user()->hasRole('RESIDENT')){
            $user = User::getResidentId($id);

            if($user != []){
                $user = DB::table('users')
                ->where('users.id','=',"$id")
                ->select(['users.id','users.email','users.name','users.lot as lot','users.id_address',])
                ->get();
    
            }
            $residentDetails =  ResidentDetail::getResidentDetailsById($id);
            $avatar = Avatar::getAvatarById($id);

            
            Log::info($residentDetails);
        return view('profile',['user' => $user, 'residentDetails' => $residentDetails,'avatar' => $avatar]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $residentDetails = [];
        $id = Auth::user()->id;
        if(Auth::user()->hasRole('RESIDENT')){
            $user = User::getResidentId($id);
            $residentDetails = ResidentDetail::getResidentDetailsById($id);
            $avatar = Avatar::getAvatarById($id);

        return view('residentDetails.create',['user' => $user, 'residentDetails' => $residentDetails,'avatar' => $avatar]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $request->validate([
            'pin' => 'numeric|required|confirmed'
        ]);
        $id = Auth::user()->id;
        
        try{
            $residentDetail = ResidentDetail::create([
                'usersResident_id' => $id,
                'pin' => Hash::make($request->input('pin')),
                'security_question_1' => $request->input('security_question_1'),
                'security_answer_1' =>  $request->input('security_answer_1'),
                'security_question_2' => $request->input('security_question_2'),
                'security_answer_2' => $request->input('security_answer_2'),
                'security_question_3' => $request->input('security_question_3'),
                'security_answer_3' => $request->input('security_answer_3'),
            ]);

            }catch(Exception $e){
                Log::error($e->getMessage());
            };
        
      //dd(file_get_contents($request->file('file')->path()));

            if($request->hasFile('file')){
                try{
                    $avatar = Avatar::create([
                    'user_id' => Auth::user()->id,
                    'avatar' => file_get_contents($request->file('file')->path()),
                    ]);

                }catch(Exception $e){
                    Log::error($e->getMessage());
                };
            }else{
                    $defaultAvatar =  Avatar::create([
                            'user_id' => Auth::user()->id,
                            'avatar' => file_get_contents('images/5.jpg'),
                    ]);
                }
        return redirect()->route('dashboard');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $id = Auth::user()->id;
        $check = ResidentDetail::getResidentDetailsById($id);
        Log::info($check);
        if(Hash::check($request->input('pin'),$check[0]->pin)){
            Log::info("Check success");
        
        if($check->isNotEmpty()){
            try{
                $residentDetail = DB::table('resident_details')
                            ->where('usersResident_id',$id)
                            ->update([
                                'security_question_1' => $request->input('security_question_1'),
                                'security_answer_1' =>  $request->input('security_answer_1'),
                                'security_question_2' => $request->input('security_question_2'),
                                'security_answer_2' => $request->input('security_answer_2'),
                                'security_question_3' => $request->input('security_question_3'),
                                'security_answer_3' => $request->input('security_answer_3'),
                                    ]);

            }catch(Exception $e){
                Log::error($e->getMessage());
            
            };
        }

        $avatar = Avatar::getAvatarById($id);
            if(  $avatar && $request->hasFile('file')){
                try{

                    $avatar = DB::table('avatars')
                                ->where('user_id',$id)
                                ->update(['avatar' => file_get_contents($request->file('file')->path())]);
                    /*$file = file_get_contents($request->file('file')->path());
                    DB::update("UPDATE avatars SET avatar = $file WHERE user_id = $id");*/
                }catch(Exception $e){
                    Log::error($e->getMessage());
                };

                Log::info('Image Updated successfully');

            }elseif($request->hasFile('file')){
                try{
                    $avatar = Avatar::create([
                    'user_id' => Auth::user()->id,
                    'avatar' => file_get_contents($request->file('file')->path()),
                    ]);

                    

                }catch(Exception $e){
                    Log::error($e->getMessage());
                };
                Log::info('Image Created successfully');
            }else{
                    log::info('No Image Inserted');
            }
        }
        return redirect()->route('profile');
    }

    public function pinChange(){
        
        if(Auth::user()->hasRole('RESIDENT')){
            $check = ResidentDetail::getResidentDetailsById(Auth::user()->id);

            if($check != []){
            return view('pinChange');
            }
        }
    }

    public function pinUpdate(Request $request){
        
        $request->validate([
            'pin' => 'numeric|required|confirmed'
        ]);
        Log::info($request->input('pin'));
        $check = ResidentDetail::getResidentDetailsById(Auth::user()->id);
        
        
        if(Hash::check($request->input('current_pin'),$check[0]->pin)){
            
        $residentpin = DB::table('resident_details')
                        ->where('usersResident_id',Auth::user()->id)
                        ->update([
                            'pin' => Hash::make($request->input('pin')),
                                ]);
                                Log::info('PIN UPDATED SUCCESSFULLY');
            return redirect()->route('dashboard')->with('status','PIN UPDATED SUCCESSFULLY');
        }else{
            return redirect()->route('pinchange')->with('status','INCORRECT PIN');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
