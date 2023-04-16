@extends('layouts.main')
@section('content')
    <h1>Создать проект</h1>
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="inputTitle">Название</label>
            <input value="{{ old('title') }}" name="title" type="text" class="form-control" id="inputTitle">
            @error('title')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="inputDescription">Описание</label>
            <textarea name="description" type="text" class="form-control" id="inputDescription"></textarea>
            @error('description')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="inputUrl">Ссылка на Гитхаб</label>
            <input value="{{ old('url') }}" name="url" type="text" class="form-control" id="inputUrl">
            @error('url')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="tagsSelect">Тэги</label>
            <select name="tags[]" multiple class="form-control multi-selector" id="tagsSelect">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                @endforeach
            </select>
        </div>
        <input hidden type="text" name="images" value="[]">
        <div id="previews" class="dropzone mt-3"></div>
        <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
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
            acceptedFiles: ".png, .jpg, .jpeg,",
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
                this.on("removedfile", function(file) {
                    let arr = JSON.parse(document.querySelector("input[name=images]").value)
                    arr = arr.filter(image => image.uuid !== file.upload.uuid)
                    document.querySelector("input[name=images]").value = JSON.stringify(arr)
                });
            }
        })
    </script>
@endsection
