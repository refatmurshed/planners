<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">

        <div class="mx-auto w-full max-w-6xl px-4 space-y-6">

            <!-- PROFILE INFO -->
            <div class="bg-white shadow-md rounded-xl p-6">

                <div class="border-b pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Profile Information
                    </h3>
                    <p class="text-sm text-gray-500">
                        Update your account’s profile information.
                    </p>
                </div>

                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>

            </div>

            <!-- PASSWORD -->
            <div class="bg-white shadow-md rounded-xl p-6">

                <div class="border-b pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Update Password
                    </h3>
                    <p class="text-sm text-gray-500">
                        Ensure your account is using a strong password.
                    </p>
                </div>

                <div>
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            <!-- DELETE ACCOUNT -->
            <div class="bg-white shadow-md rounded-xl p-6 border border-red-100">

                <div class="border-b pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-red-600">
                        Delete Account
                    </h3>
                    <p class="text-sm text-gray-500">
                        Once deleted, all data will be permanently removed.
                    </p>
                </div>

                <div>
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>
    </div>

</x-app-layout>