<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title_dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/dialog.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/colorbox.css') }}">
    <script>
        function sendRequest(form, element, text) {
            // Получение данных из формы
            let formData = new FormData(form)

            if (text.text) {
                if (document.getElementById(text.text).value === '') {
                    alert('Пожалуйста, заполните поле')
                    throw new Error('Заполните поле')
                }
            }

            // Создание объекта XMLHttpRequest
            var xhr = new XMLHttpRequest()

            formData.append('recipient_id', text.recipient_id)

            // Настройка запроса
            xhr.open("POST", "/main/messages", true)

            xhr.setRequestHeader('X-CSRF-TOKEN', document.head.querySelector('meta[name="csrf-token"]')
                .content) // добавляем токен CSRF в заголовок запроса

            // Отправка данных формы
            xhr.send(formData)

            // Обработка события загрузки
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Обработка успешного ответа от сервера
                    let message = getMessages(element, xhr.responseText)
                    document.getElementById(element).innerHTML = message //заменяем форму на ответ сервера  
                        .then(function(response) {
                            console.log("Полученное сообщение: " + response);
                            document.getElementById(element).innerHTML = response //заменяем форму на ответ сервера  
                        })
                } else {
                    // Обработка ошибки AJAX-запроса
                    console.log(xhr.status + ": " + xhr.statusText)
                }
            };
        }

        function getMessages(element, message_id) {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/main/messages/" + message_id,
                    type: "PUT",
                    success: function(response) {
                        console.log(response);
                        resolve(response); // Разрешаем промис с полученным ответом
                    },
                    error: function(xhr) {
                        reject(xhr.statusText); // Отклоняем промис с сообщением об ошибке
                    }
                });
            });
        }
    </script>
    <style>
        .header-h3 h3 {
            padding-bottom: .125rem;
            border-top: .125rem solid #000;
            border-bottom: .125rem solid #000;
            font-size: 1.5rem;
            text-transform: uppercase;
            text-align: center;
        }

        .header-h3-left h3 {
            text-align: left;
        }

        .header-h3-right h3 {
            text-align: right;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Лого -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>

                        <!-- Навигационые ссылки -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        </div>


                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('news.index')" :active="request()->routeIs('news')">
                                {{ __('News') }}
                            </x-nav-link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('user.index')" :active="request()->routeIs('user')">
                                {{ __('Users') }}
                            </x-nav-link>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('messages.index')" :active="request()->routeIs('user')">
                                {{ __('Messages') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Настройки пользователя -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Аутентификация -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Дополнительное меню навигации -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Заголовок страницы -->
        @if (isset($categories))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <nav class="mt-2 menu-is-opening menu-open">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-newspaper"></i>
                                    <p>
                                        Категории
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach ($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{ route('news.show', $category['id']) }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ $category['title'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
        @endif

        <!-- Контент страницы -->
        <!-- Content Wrapper. Contains page content -->
        @if (isset($slot))
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        @endif
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
    </div>



    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
</body>

</html>
