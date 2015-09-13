<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Profile\SaveRequest;
use App\Repositories\User\UserRepositoryInterface;
use Auth;
use Flash;

class ProfileController extends Controller {

    protected $userRepository;

    function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function show(){
        $user = Auth::user();
        return view('front.profile.show', compact('user'));
    }

    public function save(SaveRequest $request){
        if($this->userRepository->update(Auth::user(), $request->all())){
            Flash::message('Profile updated');
        } else {
            Flash::error('Save error');
        }

        return redirect()->back();
    }

}