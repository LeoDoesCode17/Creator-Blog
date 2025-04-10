<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form wire:submit.prevent="login" class="space-y-6">
      <label for="identifier" class="block text-sm/6 font-medium text-gray-900">Email or Username</label>
      <div class="mt-2">
        <input wire:model="identifier" name="identifier" id="identifier" placeholder="Enter your email or username" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        @error('identifier') <p class="text-red-500">{{ $message }}</p> @enderror
      </div>
      <div class="flex items-center justify-between">
        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        <div class="text-sm">
          <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
        </div>
      </div>
      <div class="mt-2">
        <input wire:model="password" type="password" name="password" id="password" placeholder="Enter your password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
        @error('password') <p class="text-red-500">{{ $message }}</p> @enderror
      </div>

      <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
      @error('auth') <p class="text-red-500">{{ $message }}</p> @enderror

    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Not register yet?
      <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Create your account</a>
    </p>
  </div>
</div>