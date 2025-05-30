<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register Your Account</h2>
    </div>

    @if(session()->has('success_registered'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
        <p class="font-bold">Success!</p>
        <p>{{ session('success_registered') }}</p>
    </div>
    @endif

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" wire:submit.prevent="register">
            <!-- Name Input -->
            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <div class="mt-2">
                    <input wire:model="name" id="name" placeholder="Enter your name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <!-- End Name Input -->

            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                <div class="mt-2">
                    <input wire:model="username" id="username" placeholder="Enter your username" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    @error('username') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <!-- End Username Input -->

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input wire:model="email" type="email" name="email" id="email" placeholder="Enter your email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <!-- End Email Input -->

            <!-- Password Input -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input wire:model="password" type="password" name="password" id="password" placeholder="Enter your password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
            </div>
            <!-- End Password Input -->

            <!-- Confirm Password Input -->
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Confirm Password</label>
                <div class="mt-2">
                    <input wire:model="password_confirmation" type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>
            <!-- End Confirm Password Input -->

            <div>
                <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Already registered?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in to your account</a>
        </p>
    </div>
</div>