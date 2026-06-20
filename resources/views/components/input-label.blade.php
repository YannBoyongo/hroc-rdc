@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-deep_twilight-500']) }}>
    {{ $value ?? $slot }}
</label>
