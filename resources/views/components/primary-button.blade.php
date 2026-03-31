<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-login']) }}>
    {{ $slot }}
</button>
