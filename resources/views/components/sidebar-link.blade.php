<li>
    <a {{ $attributes }}
        class="flex items-center gap-x-3.5 py-2 px-2.5 {{ $active ? 'bg-gray-100 hover:bg-gray-100 focus:bg-gray-100 dark:bg-neutral-700 dark:text-white' : ''}} text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none">
        {{ $slot }}
    </a>
</li>