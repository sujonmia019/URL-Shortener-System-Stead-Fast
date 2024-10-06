<div class="form-group">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $labelName }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control form-control-sm {{ $class ?? '' }}">{{ $value ?? '' }}</textarea>
    @if(!empty($optional)) <p class="mb-0 optional-text">{{ $optional }}</p> @endif
    @isset($name)
        @error($name)
            <span class="d-block text-danger">{{ $message }}</span>
        @enderror
    @endisset
</div>
