@if (count($errors) > 0)
    <div class="form-group form-inline">
        @if (hasEmailUniqueError($errors))
            <span class="color-red">※ メールアドレスが既に登録されています。</span>
        @else
            <span class="color-red">※ 必須項目が入力されていません。</span>
        @endif
    </div>
@endif