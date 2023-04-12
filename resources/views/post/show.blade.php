@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="display-4 fw-bold">{{ $post->title }}</h2>
                    <h3 class="fw-normal">{{ $post->description }}</h3>

                    <a class="btn btn-primary mt-3" href="{{ $post->url }}" target="_blank">
                        Ссылка на Гитхаб
                    </a>

                    <div class="mt-4">
                        @foreach ($post->tags as $k => $tag)
                            <span class="tag">
                                <span>{{ $tag->title }}</span>
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <h3>Скриншоты</h3>
                        <div class="row">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($post->images as $image)
                                        <?php
                                        $imageUrl = asset("images/$image->path");
                                        echo "<div class='swiper-slide' onclick='openImg(\"$image->id\")'><img src='$imageUrl' alt='Image' /></div>";
                                        ?>
                                    @endforeach
                                </div>

                                <div class="swiper-pagination"></div>

                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>

                        <div class="mt-4" onclick="location.href='{{ route('profile.index', $user->id) }}'">
                            <h3>Автор</h3>
                            <div class="project__author">
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                    alt="User-Profile-Image">
                                {{ $user->name }}
                            </div>
                        </div>

                        @if (auth()->id() === $post->user_id)
                            <div class="mt-4 d-flex">
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success me-2">Редактировать</a>
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('post.index') }}" class="btn btn-primary">Назад</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal wrapper">
            <span class="close">&times;</span>
            <div class="d-flex align-items-center h-75">
                <div class="modal-button-prev"><</div>
                <img class="modal-content" id="img01">
                <div class="modal-button-next">></div>
            </div>
            <div id="caption"></div>
        </div>
    </div>
    <script>
        const swiper = new Swiper(".swiper", {
            loop: true,
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });

        let imagesInfo = '<?php echo $post->images; ?>';
        imagesInfo = JSON.parse(imagesInfo)

        const openImg = (id) => {
            const modal = document.getElementById("myModal");
            const modalImg = document.getElementById("img01");
            const captionText = document.getElementById("caption");

            const image = imagesInfo.find(image => image.id == id)
            let imageIndex = imagesInfo.findIndex(image => image.id == id)

            modal.style.display = "block";
            modalImg.src = `/images/${image['path']}`;

            const span = document.getElementsByClassName("close")[0];
            span.onclick = () => modal.style.display = "none";

            const prev = document.getElementsByClassName("modal-button-prev")[0];
            prev.onclick = () => {
                if (imageIndex - 1 < 0) imageIndex = imagesInfo.length
                openImg(imagesInfo[imageIndex - 1]['id'])
            }

            const next = document.getElementsByClassName("modal-button-next")[0];
            next.onclick = () => {
                if (imageIndex + 1 === imagesInfo.length) imageIndex = -1
                openImg(imagesInfo[imageIndex + 1]['id'])
            }
        }
    </script>
@endsection
