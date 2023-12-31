<?php 

namespace App\Traits;

use App\Models\QuestionLike;
use App\Models\QuestionSave;
use Illuminate\Support\Facades\Auth;

trait Question 
{
    public function getLikeDetail ($question_id) {
          // check is_like
        $q_like = QuestionLike::where('question_id',$question_id)
                                            ->where('user_id',Auth::user()->id)
                                            ->first();
                                        
            if($q_like){
                $is_like = 'true';
            }else{
                $is_like = 'false';
            }

            // like count
            $like_count = QuestionLike::where('question_id',$question_id)->count();
            $data['like_count'] = $like_count;
            $data['is_like'] = $is_like;
            return $data;
    }

      // isSave
    public function isSave ($q_id) {
        $s = QuestionSave::where('question_id',$q_id)->where('user_id',Auth::user()->id)->first();

        if($s){
            return true;
        }
        return false;
}
}