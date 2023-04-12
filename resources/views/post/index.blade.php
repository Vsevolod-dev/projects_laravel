@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Проекты</h3>
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4 gx-2">
                                <div class="card child h-75" data-post-id="{{ $post->id }}">
                                    <div class="card-img-container">
                                        <a href="{{ $post->url }}">
                                            <?php
                                            $images = json_decode($post->images, 1);
                                            if (count($images)) {
                                                $imageLink = $images[0]['path'];
                                                $imageLink = asset("images/$imageLink");
                                                echo "<img class='card-img-top' src='$imageLink' alt='$post->title'>";
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="card-body child ">
                                        <a href="{{ $post->url }}" target="_blank">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                        </a>
                                        <p class="card-text text-truncate-custom">{{ $post->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // get all the cards on the page
        const cards = document.querySelectorAll('.card[data-post-id]');

        // loop through each card and add a click event listener
        cards.forEach(card => {
            card.addEventListener('click', function() {
                const postId = this.dataset.postId;
                window.location.href = `/posts/${postId}`;
            });
        });
    </script>
@endsection
