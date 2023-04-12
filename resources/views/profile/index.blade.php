@extends('layouts.main')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="row container">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <div class="col-sm-4 bg-c-lite-blue user-profile">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25">
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius"
                                    alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600">{{ $user->name }}</h6>
                            <p>{{ $user->job }}</p>
                            @if (auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="a-light" data-toggle="tooltip"
                                    data-placement="bottom" title="" data-original-title="twitter" data-abc="true">
                                    <i class=" mdi mdi-square-edit-outline"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card-block user-info d-flex justify-content-between flex-column">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Информация</h6>
                            <div class="row">
                                @if ($user->email)
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">{{ $user->email }}</h6>
                                    </div>
                                @endif
                                @if ($user->phone)
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Телефон</p>
                                        <h6 class="text-muted f-w-400">{{ $user->phone }}</h6>
                                    </div>
                                @endif
                            </div>
                            <ul class="social-link list-unstyled m-t-40 m-b-10">
                                @if ($user->github)
                                    <li>
                                        <a href="<?= (str_contains($user->instagram, 'http') ? '' : 'https://') . $user->instagram ?>"
                                            target="_blank">
                                            <i class="mdi mdi-github " aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($user->instagram)
                                    <li>
                                        <a href="<?= (str_contains($user->instagram, 'http') ? '' : 'https://') . $user->instagram ?>"
                                            target="_blank">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if ($user->telegram)
                                    <li>
                                        <a href="<?= (str_contains($user->telegram, 'http') ? '' : 'https://') . $user->telegram ?>"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 62" width="30px"
                                                height="38px">
                                                <path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z" />
                                                <path fill="#fff"
                                                    d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z" />
                                                <path fill="#b0bec5"
                                                    d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z" />
                                                <path fill="#cfd8dc"
                                                    d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z" />
                                            </svg>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            <div class="projects">
                                <a href="{{route('profile.user.index', $user->id)}}" class="btn btn-primary">Проекты</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
