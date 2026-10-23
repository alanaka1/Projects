@if(in_array(app()->getLocale(), ['en', 'tr'], true))
<!-- LTR -->
<html lang="{{ app()->getLocale() }}" dir="ltr" data-bs-theme="light">
@elseif(in_array(app()->getLocale(), ['ar'], true))
<!-- RTL -->
<html lang="{{ app()->getLocale() }}" dir="rtl" data-bs-theme="light">
@else
<html lang="{{ app()->getLocale() }}" dir="ltr" data-bs-theme="light">
@endif