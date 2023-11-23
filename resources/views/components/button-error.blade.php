<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 bg-red-500 text-white border border-transparent rounded-md font-semibold tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 hover:bg-white hover:text-red-500 hover:border-red-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
