<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex  items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition transform ease-in-out duration-150 hover:scale-110']) }}>
    {{ $slot }}
</button>
