@props(['name' => null, 'path' => null, 'class' => 'w-4 h-4'])

@if ($path)
    {!! \App\Services\IconRegistry::render($path, $class) !!}
@elseif($name)
    {!! \App\Services\IconRegistry::render($name, $class) !!}
@else
    {!! \App\Services\IconRegistry::render('solid:globe', $class) !!}
@endif
