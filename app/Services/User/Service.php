<?php


namespace App\Services\User;


use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class Service
{

    public function update(User $user, $data)
    {
        try {
            DB::beginTransaction();

            $user->update($data);

            // $images = [];

            // if (isset($data['tags'])) {
            //     $tags = $data['tags'];
            //     $tagIds = $this->getTagIdsWithUpdate($tags);
            //     unset($data['tags']);
            // }

            // if (isset($data['images'])) {
            //     $images = json_decode($data['images'], 1);
            //     unset($data['images']);
            // }
            // $data['user_id'] = auth()->user()->id;

            // $post->update($data);
            // // sync remove old tags and attach new tags
            // $post->tags()->sync($tagIds);
            // $this->updateImages($post, $images);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        
        // return $post->fresh();
    }
}
