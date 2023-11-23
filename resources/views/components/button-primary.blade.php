<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 bg-[#ff3850] text-white border border-transparent rounded-md font-semibold tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff3850] hover:bg-white hover:text-[#ff3850] hover:border-[#ff3850] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
