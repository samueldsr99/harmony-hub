<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white border border-transparent rounded-md font-semibold tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
