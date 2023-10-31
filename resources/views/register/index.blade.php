
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DASHBOARD</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    <link rel="stylesheet" href="css\register.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
   
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


     <!-- Custom styles for this page -->


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
  </head>
  <body>



  <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="flex justify-center self-center  z-10">
              <div class="p-12 bg-white mx-auto rounded-2xl w-600 ">
                  <div class="mb-4">
                    <h3 class="font-semibold text-2xl text-gray-800">DAFTAR </h3>
                    <p class="text-gray-500">Buat akun untuk melakukan transaksi.</p>
                  </div>
                  <div class="card-body">
                  <form action="/register" method="post" id="registrationForm">
                    @csrf
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide" for="no_lac">No Lac</label>
                                      @error('no_lac')
                                        <div class="invalid-feedback">
                                            {{-- invalid-feedback dari bootstrap --}}
                                            {{ $message }}
                                        </div>
                                      @enderror
                        <input type="text" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400
                        @error('no_lac') is-invalid
                        @enderror"  name="no_lac" id="no_lac" autofocus required value="{{ old('no_lac') }}">
                      </div>

                      <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide" for="no_polis">no_polis</label>
                                      @error('no_polis')
                                        <div class="invalid-feedback">
                                            {{-- invalid-feedback dari bootstrap --}}
                                            {{ $message }}
                                        </div>
                                      @enderror
                        <input type="text" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400
                        @error('no_polis') is-invalid
                        @enderror"  name="no_polis" id="no_polis" autofocus required value="{{ old('no_polis') }}">
                      </div>
                      <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide" for="username">Username</label>
                                      @error('username')
                                        <div class="invalid-feedback">
                                            {{-- invalid-feedback dari bootstrap --}}
                                            {{ $message }}
                                        </div>
                                      @enderror
                        <input type="text" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400
                        @error('username') is-invalid
                        @enderror"  name="username" id="username" autofocus required value="{{ old('username') }}">
                      </div>

                      <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide" for="email">Email</label>
                                      @error('email')
                                        <div class="invalid-feedback">
                                            {{-- invalid-feedback dari bootstrap --}}
                                            {{ $message }}
                                        </div>
                                      @enderror
                        <input type="email" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400
                        @error('email') is-invalid
                        @enderror"  name="email" id="email" autofocus required value="{{ old('email') }}">
                      </div>
                      <input type="hidden" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400
                        @error('email') is-invalid
                        @enderror"  name="is_admin" id="is_pembeli" autofocus required value="1">

                      <div class="space-y-2">
                      <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Password
                      </label>
                      <input class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400" type="password" placeholder="Enter your password" name="password" id="password">
                    </div>
                      {{-- <div class="flex items-center justify-between">
                      <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-800">
                          Remember me
                        </label>
                      </div>
                      <div class="text-sm">
                        <a href="#" class="text-green-400 hover:text-green-500">
                          Forgot your password?
                        </a>
                      </div>
                    </div> --}}
                    <div>
                      <button type="submit" class="w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                        Daftar
                      </button>
                    </div>
                    </div>
                    {{-- <div class="pt-5 text-center text-gray-400 text-xs">
                      <span>
                        Copyright © 2021-2022
                        <a href="https://codepen.io/uidesignhub" rel="" target="_blank" title="Ajimon" class="text-green hover:text-green-500 ">AJI</a></span>
                    </div> --}}
                  </form>
                  <div class="alert" id="registerSuccess"></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
  </div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

@yield('JS')
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const registerForm = document.getElementById("registrationForm");
            const registerSuccessAlert = document.getElementById("registerSuccess");

            registerForm.addEventListener("submit", function (event) {
                event.preventDefault();

                const registrationSuccessMessage = "Registrasi berhasil!"; 

                registerSuccessAlert.textContent = registrationSuccessMessage;
                registerSuccessAlert.style.display = "block";
                registerForm.reset();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script><script src="/js/dashboard.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

</body>
</html>




