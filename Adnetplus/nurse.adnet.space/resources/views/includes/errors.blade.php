@if (count($errors) > 0)
    <div class="form-group form-inline">
        <span class="color-red">※ @lang('messages.app.required.error')</span>
    </div>
@endif