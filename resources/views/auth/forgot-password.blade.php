<x-guest-layout>

    <div class="relative overflow-hidden">
        <!-- Gradients -->
        <div aria-hidden="true" class="flex absolute -top-96 start-1/2 transform -translate-x-1/2">
            <div
                class="bg-gradient-to-r from-violet-300/50 to-purple-100 blur-3xl w-[25rem] h-[44rem] rotate-[-60deg] transform -translate-x-[10rem] dark:from-violet-900/50 dark:to-purple-900">
            </div>
            <div
                class="bg-gradient-to-tl from-blue-50 via-blue-100 to-blue-50 blur-3xl w-[90rem] h-[50rem] rounded-fulls origin-top-left -rotate-12 -translate-x-[15rem] dark:from-indigo-900/70 dark:via-indigo-900/70 dark:to-blue-900/70">
            </div>
        </div>
        <!-- End Gradients -->

        <div class="relative z-10">
            <div class="flex items-center justify-center min-h-screen w-full px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
                <div
                    class="mt-7 w-full max-w-md bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="p-4 sm:p-7">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Lupa password?</h1>
                            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                Ingat password kamu?
                                <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                    href="{{ route('login') }}">
                                    Masuk disini
                                </a>
                            </p>
                        </div>

                        <div class="mt-5">
                            <!-- Form -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="grid gap-y-4">
                                    <!-- Form Group -->
                                    <div>
                                        <x-input-label for="email" :value="__('Alamat Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <!-- End Form Group -->

                                    <x-primary-button>
                                        {{ __('Reset password') }}
                                    </x-primary-button>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>