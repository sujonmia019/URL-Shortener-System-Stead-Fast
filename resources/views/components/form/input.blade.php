<div class="form-group">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $labelName }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" @if(!empty($value)) value="{{ $value }}" @endif class="form-control form-control-sm {{ $class ?? '' }}" @if(!empty($placeholder))placeholder="{{ $placeholder }}"@endif>
    @if(!empty($optional)) <p class="mb-0 optional-text">{{ $optional }}</p> @endif
    @isset($name)
        @error($name)
            <span class="d-block text-danger">{{ $message }}</span>
        @enderror
    @endisset
</div>
