<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-md mx-auto p-8 bg-gray-800 rounded-md shadow-md form-container text-white"
            style="width: 700px; height: auto;">
            <p>Your payment was successful. Thank you for your purchase!</p>
            <x-primary-button class="bg-orange">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            </x-primary-button>
        </div>
    </div>
</x-app-layout>
