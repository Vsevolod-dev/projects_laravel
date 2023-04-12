<?php


namespace App\Services\Post;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $images = [];

            if (isset($data['tags'])) {
                $tags = $data['tags'];
                $tagIds = $this->getTagIds($tags);
                unset($data['tags']);
            }

            if (isset($data['images'])) {
                $images = json_decode($data['images'], 1);
                unset($data['images']);
            }
            $data['user_id'] = auth()->user()->id;

            $post = Post::create($data);
            $post->tags()->attach($tagIds);
            $this->attachImages($post, $images);
    
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post;
    }

    public function update($post, $data)
    {
        try {
            DB::beginTransaction();

            $images = [];

            if (isset($data['tags'])) {
                $tags = $data['tags'];
                $tagIds = $this->getTagIdsWithUpdate($tags);
                unset($data['tags']);
            }

            if (isset($data['images'])) {
                $images = json_decode($data['images'], 1);
                unset($data['images']);
            }
            $data['user_id'] = auth()->user()->id;

            $post->update($data);
            // sync remove old tags and attach new tags
            $post->tags()->sync($tagIds);
            $this->updateImages($post, $images);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
        
        return $post->fresh();
    }

    // private function getCategoryId($category)
    // {
    //     $category = !isset($category['id']) ? Category::create($category) : Category::find($category['id']);
    //     return $category->id;
    // }

    // private function getCategoryIdWithUpdate($category)
    // {
    //     if (!isset($category['id'])) {
    //         $category = Category::create($category);
    //     } else {
    //         $currentCat = Category::find($category['id']);
    //         $currentCat->update($category);
    //         $category = $currentCat->fresh();
    //     }

    //     return $category->id;
    // }

    private function getTagIds($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            if (gettype($tag) === 'string') {
                $id = (int)$tag;
                $tag = [];
                $tag['id'] = $id;
            }
            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    private function getTagIdsWithUpdate($tags)
    {
        $tagIds = [];
        foreach ($tags as $tag) {
            if (gettype($tag) === 'string') {
                $id = (int)$tag;
                $tag = [];
                $tag['id'] = $id;
            }

            if (!isset($tag['id'])) {
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    public function attachImages($post, $images)
    {
        foreach ($images as $image) {
            $image['extension'] = explode('.', $image['name'])[1];
            $image['post_id'] = $post->id;
            if (isset($image['id'])) unset($image['id']);
            unset($image['uuid']);
            Image::create($image);
        }
    }

    public function updateImages($post, $newImages)
    {
        // delete old images
        $oldImages = $post->images;

        
        $newImagesPath = array_map(function($newImage) {
            return $newImage['path'];
        }, $newImages);

        // 1. if (old image) then don't attach it and don't delete it
        // 2. if (old image absent) then delete it
        // 3. if (new image don't match old image) then attah it
        foreach ($oldImages as $oldImage) {
            if (!in_array($oldImage->path, $newImagesPath)) {
                $oldImage->delete();
            } else {
                $newImages = array_filter($newImages, function ($newImage) use ($oldImage) {
                    return $newImage['path'] !== $oldImage->path;
                });
            }
        }

        // add new images
        $this->attachImages($post, $newImages);
    }
}
