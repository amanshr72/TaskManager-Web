<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex">
            <!-- Email Address -->
            <div class="mr-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
            <!-- Phone Number -->
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input type="text" id="phone" name="phone" :value="old('phone')" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>

        <!-- Role -->
        <div class="mr-4">
            <?php $userType = App\Models\UserType::orderBy('userType')->get(); ?>
            <x-input-label for="role" :value="__('User Type')" />
            <select id="role" class="border-gray-300 focus:border-indigo-500 p-2.5 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="role">
                <option value="" disabled selected>Select User Type</option>
                @foreach ($userType as $role)
                    <option value="{{ $role->userType }}">{{ $role->userType }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        
        <div class="flex">
            <!-- Password -->
            <div class="mr-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create an account</button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            Already have an account? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Login here</a>
        </p>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var phoneInput = document.getElementById('phone');
    
            phoneInput.addEventListener('input', function () {
                var phoneNumber = this.value.replace(/\D/g, '');
                if (phoneNumber.length > 10) {
                    phoneNumber = phoneNumber.slice(0, 10);
                }
                this.value = phoneNumber;
            });
        });
    </script>
    
</x-guest-layout>
