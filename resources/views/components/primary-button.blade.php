<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-warkop-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-warkop-red-dark focus:bg-warkop-red-dark active:bg-warkop-red-dark focus:outline-none focus:ring-2 focus:ring-warkop-red/20 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
