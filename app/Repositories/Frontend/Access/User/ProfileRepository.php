<?php

namespace App\Repositories\Frontend\Access\User;

use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Image;
use File;
/**
 * Class ProfileRepository.
 */
class ProfileRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;


    /**
     * @param array input
     * 
     * @return $profile
     */

    public function store($input, $model = null)
    {
        $data = $this->generateStub($input, $model);
        DB::beginTransaction();
        try {
            $process = $model ? 'update' : 'create';
            $user = access()->user();
            if($model){
                $model->update($data);
                $profile = $model;
            }else{
                $profile = $user->profile()->create($data);
            }  
            if(array_key_exists('image', $input) && $input['image']){
                $this->storeImage($process, $input['image'], $profile);
            }
            DB::commit();
            return $profile;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $this->exceptions();
        }
    }

    public function storeImage($process, $file, $profile)
    {
        /** Initialise Data
         * $file - Image 
         * $name - Generated Name
         * $width - 
        */
        $name   = 'profile_' . $profile->user_id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $width  = config('access.profile.image.width');
        $height = config('accces.profile.image.height');

        if(!file_exists('images'        )){ $folder = File::makeDirectory('images', 755); }
        if(!file_exists('images/profiles' )){ $folder = File::makeDirectory('images/profiles', 755); }
        $full_path = 'images/profiles/' . $name;
        
        $upload = Image::make($file->getRealPath())->resize(200, 200)->save($full_path);
        if($process == 'update' && file_exists($profile->avatar)){ File::delete($profile->avatar); }
        $profile->avatar = $full_path;
        return $profile->save();
    }

    /**
     * @param $input
     * @param $model
     * @return array $data
     */

    public function generateStub($request, $model=null)
    {
        $data['first_name'      ] = $request['first_name'];
        $data['last_name'       ] = $request['last_name' ];
        $data['address'         ] = $request['address'   ];
        $data['contact_number'  ] = $request['contact_number'];
        return $data;
    }
}
