@extends('layouts.main')
@section('content')
    <h1>Редактировать проект</h1>
    <form action="{{ route('post.update', $post->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="inputTitle">Название</label>
            <input value="{{ $post->title }}" name="title" type="text" class="form-control" id="inputTitle">
            @error('title')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="inputDescription">Описание</label>
            <textarea name="description" type="text" class="form-control" id="inputDescription">{{ $post->description }}</textarea>
            @error('description')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="inputUrl">Ссылка на Гитхаб</label>
            <input value="{{ $post->url }}" name="url" type="text" class="form-control" id="inputUrl">
            @error('url')
                <small class="form-text
                text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="tagsSelect">Тэги</label>
            <select name="tags[]" multiple class="form-control multi-selector" id="tagsSelect">
                @foreach ($tags as $tag)
                    <option
                        @foreach ($post->tags as $postTag)
                    {{ $tag->id === $postTag->id ? 'selected' : '' }} @endforeach
                        value="{{ $tag->id }}">{{ $tag->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <input hidden type="text" name="images" value="{{ $post->images }}">
        <div id="previews" class="dropzone dropzone-existed mt-3"></div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Назад</a>
        </div>
    </form>
    <script>
        const images = []
        new Dropzone("div#previews", {
            url: "/upload",
            method: "post",
            withCredentials: true,
            parallelUploads: 10,
            uploadMultiple: false,
            maxFilesize: 10,
            paramName: "file",
            createImageThumbnails: true,
            maxThumbnailFilesize: 10,
            thumbnailWidth: 100,
            thumbnailHeight: 100,
            clickable: "#previews",
            ignoreHiddenFiles: true,
            acceptedFiles: ".png, .jpg, .jpeg",
            acceptedMimeTypes: null,
            autoProcessQueue: true,
            addRemoveLinks: true,
            previewsContainer: "#previews",
            headers: {
                'X-CSRF-Token': document.querySelector("meta[name=_token]").content
            },
            success: function(file, response) {
                const arr = JSON.parse(document.querySelector("input[name=images]").value)

                if (response.success) {
                    arr.push({
                        name: file.name,
                        size: file.size,
                        path: response.success,
                        uuid: file.upload.uuid
                    })
                }

                document.querySelector("input[name=images]").value = JSON.stringify(arr)
            },
            init: function() {
                var myDropzone = this;

                const images = JSON.parse(document.querySelector("input[name=images]").value)

                //Populate any existing thumbnails
                if (images) {
                    for (let i = 0; i < images.length; i++) {
                        const mockFile = {
                            name: images[i].name,
                            size: images[i].size,
                            type: 'image/jpeg',
                            status: Dropzone.ADDED,
                            url: `/images/${images[i].path}`
                        };

                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, `/images/${images[i].path}`);
                        myDropzone.emit("complete", mockFile);

                        myDropzone.files.push(mockFile);
                    }
                }

                this.on("removedfile", function(file) {
                    let arr = JSON.parse(document.querySelector("input[name=images]").value)
                    arr = arr.filter(image => {
                        if (file.upload) {
                            return image.uuid !== file.upload.uuid
                        } else {
                            const path = file.url.split('/')[2]
                            return path !== image.path
                        }
                    })
                    document.querySelector("input[name=images]").value = JSON.stringify(arr)
                });
            }
        })
    </script>
@endsection
