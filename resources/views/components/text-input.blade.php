@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-warkop-red focus:ring-warkop-red/20 rounded-md shadow-sm']) }}>
