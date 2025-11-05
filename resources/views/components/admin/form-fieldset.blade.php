{{--
    Form Fieldset Component - Centralized Spacing Rules

    Default mb="mb-2" - Use for middle fieldsets within a card
    Use mb="mb-0" - For the last fieldset before buttons/actions
    Use mb="mb-4" - For extra spacing between major sections
    Use mb="mb-3" - For medium spacing between sections
--}}

@props(['legend', 'mb' => 'mb-2'])

<fieldset class="form-fieldset {{ $mb }}">
    <legend>{{ $legend }}</legend>
    {{ $slot }}
</fieldset>
