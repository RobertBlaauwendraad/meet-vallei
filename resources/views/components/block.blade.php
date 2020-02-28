<section class="{{ isset($class) ? $class : 'py-2 py-lg-5' }} {{ isset($block) && isset($block['classes']) ? $block['classes'] : 'alignfull' }}"{!! isset($block) ? ' data-'.$block['id'] : '' !!}>
  {{ $slot }}
</section>
