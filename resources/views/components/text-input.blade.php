@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue_green-500 focus:ring-blue_green-500 rounded-md shadow-sm']) }}>
