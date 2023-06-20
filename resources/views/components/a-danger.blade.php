<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-danger-800 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-danger-700 active:bg-danger-900 focus:outline-none focus:border-danger-900 focus:ring ring-danger-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
