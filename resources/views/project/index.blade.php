@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Проекты</h3>
                    <div class="row">
                        @foreach ($projects as $project)
                            <div class="col-md-4 gx-2">
                                <div class="card child h-75" data-project-id="{{ $project->id }}">
                                    <div class="card-img-container">
                                        <a href="{{ $project->url }}">
                                            <?php
                                            $images = json_decode($project->images, 1);
                                            if (count($images)) {
                                                $imageLink = $images[0]['path'];
                                                $imageLink = asset("images/$imageLink");
                                                echo "<img class='card-img-top' src='$imageLink' alt='$project->title'>";
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="card-body child ">
                                        <a href="{{ $project->url }}" target="_blank">
                                            <h5 class="card-title">{{ $project->title }}</h5>
                                        </a>
                                        <p class="card-text text-truncate-custom">{{ $project->description }}</p>
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
        const cards = document.querySelectorAll('.card[data-project-id]');

        // loop through each card and add a click event listener
        cards.forEach(card => {
            card.addEventListener('click', function() {
                const projectId = this.dataset.projectId;
                window.location.href = `/projects/${projectId}`;
            });
        });
    </script>
@endsection
