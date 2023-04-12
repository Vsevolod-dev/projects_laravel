@extends('layouts.main')
@section('content')
    <div class="row container d-flex justify-content-center">
        <div class="card user-card-full">
            <form class="row m-l-0 m-r-0" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('patch')
                <div class="col-sm-4 bg-c-lite-blue user-profile">
                    <div class="card-block text-center text-white">
                        <div class="m-b-25">
                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                alt="User-Profile-Image">
                        </div>
                        <div class="row">
                            <input type='text' class="f-w-400" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="row">
                            <input type='text' class="f-w-400" name="job" value="{{ $user->job }}">
                        </div>
                        <a class="a-light d-block" onclick="this.closest('form').submit();return false;">
                            <i class=" mdi mdi-content-save-check-outline"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card-block">
                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Информация</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Email</p>
                                <input class="text-muted f-w-400" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Телефон</p>
                                <input class="text-muted f-w-400" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <ul class="list-unstyled m-t-40 m-b-10 socials">
                            <li class="d-flex align-items-center">
                                <a href="{{ $user->github }}" data-original-title="github" class="disabled me-3">
                                    <i class="mdi mdi-github" aria-hidden="true"></i>
                                </a>
                                <input type="text" name="github" value="{{ $user->github }}">
                            </li>
                            <li class="d-flex align-items-center">
                                <a href="{{ $user->instagram }}" data-original-title="instagram" class="disabled me-3">
                                    <i class="mdi mdi-instagram" aria-hidden="true"></i>
                                </a>
                                <input type="text" name="instagram" value="{{ $user->instagram }}">
                            </li>
                            <li style="height: 48px" class="d-flex align-items-center">
                                <a href="{{ $user->telegram }}" data-original-title="telegram" class="disabled me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="30px"
                                        height="30px">
                                        <path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z" />
                                        <path fill="#fff"
                                            d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z" />
                                        <path fill="#b0bec5"
                                            d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z" />
                                        <path fill="#cfd8dc"
                                            d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z" />
                                    </svg>
                                </a>
                                <input type="text" name="telegram" value="{{ $user->telegram }}">
                            </li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
@endsection
